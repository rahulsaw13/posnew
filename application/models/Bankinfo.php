<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Appconfig class
 */

class Bankinfo extends CI_Model
{

    private $table = "bank_info";

	public function exists_account($data)
	{
		
		$this->db->from($this->table);
		$this->db->where('bank_account_number',$data);

		return ($this->db->get()->num_rows() == 1);
	}

	public function exists($bank_id)
	{
		$this->db->from($this->table);
		$this->db->where('bank_id', $bank_id);

		return ($this->db->get()->num_rows() == 1);
	}


	public function get_all()
	{
		$this->db->from($this->table);
		$this->db->order_by('is_primary', 'desc');

		return $this->db->get();
	}

	public function get($key, $default = '')
	{
		$query = $this->db->get_where($this->table, array('bank_id' => $key), 1);

		if($query->num_rows() == 1)
		{
			return $query->row()->value;
		}

		return $default;
	}

    /** 
     * Save a new bank account instance
     * @param  data = {"bank_account_holder_name", "bank_account_number", "bank_ifsc", "is_primary","upi_id"}
    */


	
	/*
	Inserts or updates a item
	*/
	public function save(&$data,$bank_id=FALSE)
	{
		if( !($bank_id) || !$this->exists($bank_id) || !$this->exists_account($data["bank_account_number"]))
		{
			$success=$this->db->insert($this->table, $data);
			$bank_id = $this->db->insert_id();
			if($data["is_primary"]==1)
			{
				$this->set_primary($bank_id);
			}
			return $success;
		}

		$this->db->where('bank_id', $bank_id);
		$this->db->where("bank_account_number", $data["bank_account_number"]);

		$success=$this->db->update($this->table, $data);
		if($data["is_primary"]==1)
			{
				if(!$data["is_active"])
				{
					$this->db->update($this->table, array('is_active'=>1));
				}
				$this->set_primary($bank_id);
			}
		return $success;
	}


	/*
	Deletes a list of items
	*/
	public function delete_list($bankdetail_ids)
	{
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		// set to 0 quantities
		$this->Item_quantity->reset_quantity_list($bankdetail_ids);
		$this->db->where_in('bank_id', $bankdetail_ids);
		$success = $this->db->update('bank_info', array('is_active'=>0));

		$this->db->trans_complete();

		$success &= $this->db->trans_status();

		return $success;
	}

	public function delete($key)
	{
		return $this->db->update($this->table, array('is_active' => 0))->where("bank_id", $key);
	}

	public function delete_all()
	{
		return $this->db->update($this->table, array('is_active' => 0));
	}

    public function set_primary($key) {
         if($this->db->update($this->table, array('is_primary' => 0))) {
			$this->db->where('bank_id', $key);
            $success=$this->db->update($this->table, array('is_primary' => 1));
			return $success;
        }
    }


	
	/*
	Perform a search on bank_info
	*/
	public function search($search, $filters, $rows = 0, $limit_from = 0, $sort = 'is_primary', $order = 'asc', $count_only = FALSE)
	{
		// get_found_rows case
		if($count_only === TRUE)
		{
			$this->db->select('COUNT(DISTINCT bank_id ) AS count');
		}
		else
		{
			$this->db->select('MAX(bank_id) AS bank_id');
			$this->db->select('MAX(bank_account_holder_name) AS bank_account_holder_name');
			$this->db->select('MAX(bank_account_number ) AS bank_account_number');
			$this->db->select('MAX(bank_ifsc) AS bank_ifsc');
			$this->db->select('MAX(is_primary) AS is_primary');
			$this->db->select('MAX(is_active) AS is_active');
			$this->db->select('MAX(created_at) AS created_at');
		
		}

		$this->db->from('bank_info AS bank_info');
		

		if(empty($this->config->item('date_or_time_format')))
		{
			$this->db->where('DATE_FORMAT(created_at, "%Y-%m-%d") BETWEEN ' . $this->db->escape($filters['start_date']) . ' AND ' . $this->db->escape($filters['end_date']));
		}
		else
		{
			$this->db->where('created_at BETWEEN ' . $this->db->escape(rawurldecode($filters['start_date'])) . ' AND ' . $this->db->escape(rawurldecode($filters['end_date'])));
		}

		if(!empty($search))
		{
			if ($filters['search_custom'])
			{
				$this->db->having("bank_account_holder_name LIKE '%$search%'");
				$this->db->or_having("bank_account_number  LIKE '%$search%'");
				$this->db->or_having("bank_ifsc LIKE '%$search%'");
			}
			else
			{
				$this->db->group_start();
					$this->db->like('bank_account_holder_name', $search);
					$this->db->or_like('bank_account_number', $search);
					$this->db->or_like('bank_id', $search);
					$this->db->or_like('bank_ifsc', $search);
				$this->db->group_end();
			}
		}


		//$this->db->where('bank_info.is_active', $filters['is_active']);

		if($filters['is_active'] != FALSE )
		{
			$this->db->where('is_active', 0);
		}
		else
		{
			$this->db->where('is_active', 1);
		}
		if($filters['is_primary'] != FALSE)
		{
			$this->db->where('is_primary', 1);
		}

		// get_found_rows case
		if($count_only === TRUE)
		{
			return $this->db->get()->row()->count;
		}

		// avoid duplicated entries with same name because of inventory reporting multiple changes on the same item in the same date range
		$this->db->group_by('bank_id');

		// order by name of item by default
		$this->db->order_by($sort, $order);

		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();
	}

	/*
	Get number of rows
	*/
	public function get_found_rows($search, $filters)
	{
		return $this->search($search, $filters, 0, 0, 'items.bank_account_holder_name', 'asc', TRUE);
	}


	/*
	Gets information about a particular item
	*/
	public function get_info($bank_id)
	{
		$this->db->select('*');
		$this->db->where('bank_id', $bank_id);
		$this->db->group_by('bank_id');

		$query = $this->db->get('bank_info');

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $item_id is NOT an item
			$item_obj = new stdClass();

			//Get all the fields from items table
			foreach($this->db->list_fields('bank_info') as $field)
			{
				$item_obj->$field = '';
			}

			return $item_obj;
		}
	}


}
?>
