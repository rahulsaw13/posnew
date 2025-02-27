<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sale class
 */
class Payment extends CI_Model
{

	/**
	 * 	Update Bills
	 */
	public function add_payment_module($payments)
	{
		foreach ($payments as $key => $value) {
			$data = array(
				'sale_id'      =>  $value['bill_no'],       // Sale ID to be inserted
				'payment_type' => $value['payment_type'],  // Payment type to be inserted (e.g., 'Due', 'Paid')
				'due_amount'   => $value['due_amount'],    // Amount due (double)
				'paid_amount'  => $value['payment_amount'],   // Amount paid (double)
				'bill_type'    => $$value['bill_type']
			);
			
			// Insert query
			return $this->db->insert('payment_module', $data);
		}
		
	}
 
	/**
	 * 	Update Bills
	 */
	public function update_bill_no($payments)
	{
		foreach ($payments as $key => $value) {
			$cash_refund=bcsub($value['payment_amount'],$value['due_amount']);
			if($cash_refund<0){
				$cash_refund=0;
			}
			$data=array('payment_type' => $value['payment_type'],
			'payment_amount' => $value['payment_amount'],
			'cash_refund'=>$cash_refund);
			if($value['bill_type']==0)
			{
				$this->db->where('sale_id', $value['bill_no']);
				$this->db->where('payment_type',"Due");
				$success = $this->db->update('sales_payments',$data);
				if(bcsub($value['payment_amount'],$value['due_amount'])<0)
				{
					$sales_payments_data = array(
						'sale_id'		  => $value['bill_no'],
						'payment_type'	  => 'Due',
						'payment_amount'  => bcsub($value['due_amount'],$value['payment_amount']),
						'cash_refund'	  => 0,
						'cash_adjustment' => 0,
						'employee_id'	  => $this->get_employee($value['bill_no'])->person_id,
					);
					$success = $this->db->insert('sales_payments', $sales_payments_data);
				}
		  }
		  else
		  {
			$this->db->where('receiving_id', $value['bill_no']);
			$this->db->where('payment_type',"Due");
			$success = $this->db->update('recevings_payments',$data);
				if(bcsub($value['payment_amount'],$value['due_amount'])<0)
				{
					$receivings_payments_data = array(
						'receiving_id'		  => $value['bill_no'],
						'payment_type'	  => 'Due',
						'payment_amount'  => bcsub($value['due_amount'],$value['payment_amount']),
						'cash_refund'	  => 0,
						'cash_adjustment' => 0,
						'employee_id'	  => $this->get_employee($value['bill_no'])->person_id,
					);
					$success = $this->db->insert('receivings_payments', $receivings_payments_data);
				}
		  }
		}
		return $this->add_payment_module($payments);
		
	}

	/**
	 * Gets sale customer name
	 */
	public function get_customer()
	{
		$this->db->select('customer_id');
		$this->db->from('sales');
		$this->db->distinct();  // Add distinct to ensure unique customer_id values
		$this->db->where('customer_id !=', NULL);
		$res = $this->db->get()->result();  // Fetch results as an array of objects
		// $result=$this->Customer->get_infos($res);
		$customer_ids = array_map(function($row) {
			return (string) $row->customer_id;  // Convert to string if needed
		}, $res);		
		return $customer_ids;
	}

	/**
	 * Gets sale customer name
	 */
	public function get_supplier()
	{
		$this->db->select('supplier_id');
		$this->db->from('receivings');
		$this->db->distinct();  // Add distinct to ensure unique customer_id values
		$this->db->where('supplier_id !=', NULL);
		$res = $this->db->get()->result();  // Fetch results as an array of objects
		// $result=$this->Customer->get_infos($res);
		$supplier_ids = array_map(function($row) {
			return (string) $row->supplier_id;  // Convert to string if needed
		}, $res);		
		return $supplier_ids;
	}
	/**
	 * Gets bill due amount
	 */
	public function due_customer_amount($bill_payment_d)
	{
		$this->db->select("payment_amount");
		$this->db->from('sales_payments');
		$this->db->where('sale_id', $bill_payment_d);
		$this->db->where('payment_type', "Due");
		return $this->db->get()->result()[0]->payment_amount; // Fetch results as an array of objects
	}
	/**
	 * Gets bill due amount
	 */
	public function due_supplier_amount($bill_payment_d)
	{
		$this->db->select("payment_amount");
		$this->db->from('receivings_payments');
		$this->db->where('receiving_id', $bill_payment_d);
		$this->db->where('payment_type', "Due");
		return $this->db->get()->result()[0]->payment_amount; // Fetch results as an array of objects
	}
	/**
	 * Gets sale customer name
	 */
	public function get_customer_bills($customer_id)
	{
		$this->db->select("sales.sale_id");
		$this->db->from('sales');
		$this->db->join('sales_payments', 'sales_payments.sale_id = sales.sale_id', 'inner'); // Join with ospos_sales_payment table
		$this->db->distinct();  // Add distinct to ensure unique customer_id values
		$this->db->where('sales.customer_id', $customer_id);
		$this->db->where('sales_payments.payment_type', 'Due'); 
		$this->db->order_by('sales.sale_id', 'ASC');  // Sorting by sale_id in ascending order
		$res = $this->db->get();  // Fetch results as an array of objects
		// $result=$this->Customer->get_infos($res);
		// echo $this->db->last_query();
		$bills = array();
		foreach ($res->result() as $row) {
			$bills[$row->sale_id] = (string) "Bill-".$row->sale_id;
		}		
		return $bills;
	}


	/**
	 * Gets receiving customer name
	 */
	public function get_supplier_bills($supplier_id)
	{
		$this->db->select("receivings.receiving_id");
		$this->db->from('receivings');
		$this->db->join('receivings_payments', 'receivings_payments.receiving_id = receivings.receiving_id', 'inner'); // Join with ospos_sales_payment table
		$this->db->distinct();  // Add distinct to ensure unique customer_id values
		$this->db->where('receivings.supplier_id', $supplier_id);
		$this->db->where('receivings_payments.payment_type', 'Due'); 
		$this->db->order_by('receivings.receiving_id', 'ASC');  // Sorting by receiving_id in ascending order
		$res = $this->db->get();  // Fetch results as an array of objects
		// $result=$this->Customer->get_infos($res);
		//echo $this->db->last_query();
		$bills = array();
		foreach ($res->result() as $row) {
			$bills[$row->receiving_id] = (string) "Bill-".$row->receiving_id;
		}		
		return $bills;
	}

	
	/**
	 * Gets sale payment options
	 */
	public function get_payment_options()
	{
		$payments = get_payment_options();
		$payments = array_filter($payments, function($value) {
			return $value != "Due";  // Keep values less than or equal to 30
		});
		


		return $payments;
	}

	

	/**
	 * Gets sale employee name
	 */
	public function get_employee($sale_id)
	{
		$this->db->from('sales');
		$this->db->where('sale_id', $sale_id);

		return $this->Employee->get_info($this->db->get()->row()->employee_id);
	}

	
	
}
?>
