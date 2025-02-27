<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Base class for Referral classes
 */
class Referral extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	private $table = "referral";

	/*
	Perform a search on referral
	*/
	public function search($search, $filters, $rows = 0, $limit_from = 0, $sort = 'referral_id', $order = 'asc', $count_only = FALSE)
	{
		// get_found_rows case
		if($count_only === TRUE)
		{
			$this->db->select('COUNT(DISTINCT referral_id ) AS count');
		}
		else
		{
			$this->db->select('MAX(referral_id) AS referral_id');
			$this->db->select('MAX(name) AS name');
			$this->db->select('MAX(phone_no) AS phone_no');
			$this->db->select('MAX(address) AS address');
			
		
		}
        $this->db->where('deleted', 0);
		$this->db->from('referral AS referral');
		

		if(!empty($search))
		{
			if ($filters['search_custom'])
			{
				$this->db->having("name LIKE '%$search%'");
				$this->db->or_having("phone_no  LIKE '%$search%'");
				$this->db->or_having("address LIKE '%$search%'");
			}
			else
			{
				$this->db->group_start();
					$this->db->like('name', $search);
					$this->db->or_like('phone_no', $search);
					$this->db->or_like('address', $search);
				$this->db->group_end();
			}
		}


		

		// get_found_rows case
		if($count_only === TRUE)
		{
			return $this->db->get()->row()->count;
		}

		// avoid duplicated entries with same name because of inventory reporting multiple changes on the same item in the same date range
		$this->db->group_by('referral_id');

		// order by name of item by default
		$this->db->order_by($sort, $order);

		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();
	}

	public function get_referal_sales_Data($search, $filters, $rows = 0, $limit_from = 0, $sort = 'referral_id', $order = 'asc', $count_only = FALSE)
	{
		//Create our temp tables to work with the data in our report
		$dateString = "2024-11-01";
		$date = strtotime($dateString);

		// Now, you can format it as needed

		$this->db->from('referral_sales_commission');
		$this->db->where('referral_id', $search['referral_id']);
		$this->db->group_by('sale_id');

		$data = array();
		$query =$this->db->get();

		if ($query) {
			// If there are results, get the data
			$data = $query->result_array();
		} else {
			// If no results, set data to an empty array or handle it differently
			$data = [];
		}
        // echo $this->db->last_query(); 
		return $data;
	}



	public function get_all_referrals()
	{
		$this->db->select('referral_id, name');
		$this->db->where('deleted', 0);
		$this->db->from('referral');  
		$query = $this->db->get();
		return $query->result();  // Return the result
	}

	/*
	Get number of rows
	*/
	public function get_found_rows($search, $filters)
	{
		return $this->search($search, $filters, 0, 0, 'referral_id', 'asc', TRUE);
	}

	/*
	Gets information about a particular item
	*/
	public function get_info($referral_id)
	{
		$this->db->select('*');
		$this->db->where('referral_id', $referral_id);
		$this->db->where('deleted', 0);
		$this->db->group_by('referral_id');

		$query = $this->db->get($this->table);
		$q=$this->db->last_query();
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $item_id is NOT an item
			$item_obj = new stdClass();

			//Get all the fields from referral table
			foreach($this->db->list_fields('referral') as $field)
			{
				$item_obj->$field = '';
			}

			return $item_obj;
		}
	}


	/*
	Gets information about a particular sales of a referral person
	*/
	public function get_info_detailed_report($sail_id,$referral_id)
	{
		
		$this->db->from('referral_sales_commission');  // Start with the 'sales' table
		$this->db->where('referral_id', $referral_id);  // Condition for referral_id
		$this->db->where('sale_id', $sail_id);
		$query = $this->db->get();  // Execute the query
		// $query = $this->db->get($this->table);
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $item_id is NOT an item
			$item_obj = new stdClass();

			//Get all the fields from referral table
			foreach($this->db->list_fields('referral') as $field)
			{
				$item_obj->$field = '';
			}

			return $item_obj;
		}
	}

	/*
	Inserts or updates a referral
	*/
	public function save(&$data,$referral_id=FALSE)
	{
		if( !($referral_id) || !$this->exists($referral_id))
		{
			$success=$this->db->insert($this->table, $data);
			$referral_id = $this->db->insert_id();
			return $success;
		}

		$this->db->where('referral_id', $referral_id);

		$success=$this->db->update($this->table, $data);
		return $success;
	}

	/*
	Inserts or updates a referral paid status
	*/
	public function save_detailed_referral_report(&$data,$referral_id=FALSE)
	{
		$this->db->where('referral_id', $referral_id);
		$this->db->where('sale_id', $data['sale_id']);
        $update_data = array(
			'commission_paid_status' => $data['commission_paid_status']
		);
		$success=$this->db->update('referral_sales_commission',$update_data);
		$res= $this->db->last_query();
		return $success;
	}

	public function exists($referral_id)
	{
		$this->db->from($this->table);
		$this->db->where('referral_id', $referral_id);

		return ($this->db->get()->num_rows() == 1);
	}

	/*
	Deletes a list of items
	*/
	public function delete_list($referral_ids)
	{
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		// set to 0 quantities
		$this->Item_quantity->reset_quantity_list($referral_ids);
		$this->db->where_in('referral_id', $referral_ids);
		$success = $this->db->update($this->table, array('deleted'=>1));

		$this->db->trans_complete();

		$success &= $this->db->trans_status();

		return $success;
	}





}

?>
