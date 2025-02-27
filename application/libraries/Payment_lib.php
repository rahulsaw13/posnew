<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sale library
 *
 * Library with utilities to manage sales
 */

class Payment_lib
{
	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('tax_lib');
		$this->CI->load->model('enums/Rounding_mode');
	}



	public function clear_all()
	{
	
	
		$this->delete_selected_customer();
		$this->delete_supplier();
		$this->empty_bill_payments();
		
	
	}
// for Payment register Mode
public function get_register_mode_options()
{
	$register_modes = array();
	$register_modes['customer'] = $this->CI->lang->line('payments_customer');
	$register_modes['supplier'] = $this->CI->lang->line('payments_supplier');
	return $register_modes;
}

public function get_mode()
	{
		if(!$this->CI->session->userdata('payment_mode'))                                                                                                                                                                                                                     
		{                                                                                                                                                                                                                                                                   
			$this->set_mode($this->CI->lang->line('payments_customer'));                                                                                                                                                                                                                            
		}      
		return $this->CI->session->userdata('payment_mode');
	}

	public function set_mode($mode)
	{
		$this->CI->session->set_userdata('payment_mode', $mode);
	}




	public function get_selected_customer()
	{
		if(!$this->CI->session->userdata('selected_customer'))                                                                                                                                                                                                                     
		{                                                                                                                                                                                                                                                                   
			$this->set_selected_customer('None');                                                                                                                                                                                                                            
		}      
		return $this->CI->session->userdata('selected_customer');
	}

	public function set_selected_customer($custoner)
	{
		$this->CI->session->set_userdata('selected_customer', $custoner);
	}

	public function delete_selected_customer()
	{
		$this->CI->session->unset_userdata('selected_customer');
	}

	
	public function get_supplier_options()
	{
		$register_modes = array();
		$register_modes['customer'] = $this->CI->lang->line('payments_customer');
		$register_modes['supplier'] = $this->CI->lang->line('payments_supplier');
		return $register_modes;
	}

	public function get_supplier()
	{
		if(!$this->CI->session->userdata('supplier'))                                                                                                                                                                                                                     
		{                                                                                                                                                                                                                                                                   
			$this->set_supplier('None');                                                                                                                                                                                                                            
		}      
		return $this->CI->session->userdata('supplier');
	}

	public function set_supplier($supplier)
	{
		$this->CI->session->set_userdata('supplier', $supplier);
	}

	public function delete_supplier()
	{
		$this->CI->session->unset_userdata('supplier');
	}

	
	// Multiple Payments
	public function get_bill_payments()
	{
		if(!$this->CI->session->userdata('bill_payments'))
		{
			$this->set_bill_payments(array());
		}

		return $this->CI->session->userdata('bill_payments');
	}

	// Multiple Payments
	public function set_bill_payments($payments_data)
	{
		$this->CI->session->set_userdata('bill_payments', $payments_data);
	}

	/**
	 * Adds a new payment to the payments array or updates an existing one.
	 * It will also disable cash_mode if an non-qualifying payment type is added.
	 * @param $payment_id
	 * @param $payment_amount
	 * @param int $cash_adjustment
	 */
	public function add_payment($payment_id,$due_amount,$payment_type, $payment_amount,$bill_type, $cash_adjustment = CASH_ADJUSTMENT_FALSE)
	{
		$payments = $this->get_bill_payments();
		if(isset($payments[$payment_id]))
		{
			//payment_method already exists, add to payment_amount
			$payments[$payment_id]['payment_amount'] = bcadd($payments[$payment_id]['payment_amount'], $payment_amount);
			$payments[$payment_id]['payment_type'] = $payment_type;
		}
		else
		{
			//add to existing array
			if($payment_id!="")
			{
			$payment = array($payment_id => array('bill_no'=>$payment_id,'payment_type' => $payment_type, 'payment_amount' => $payment_amount,
				'cash_adjustment' => $cash_adjustment,'due_amount'=>$due_amount,'bill_type'=>$bill_type));

			$payments += $payment;
			}
		}
		$this->set_bill_payments($payments);
	}

	// Multiple Payments
	public function edit_payment($payment_id, $payment_amount)
	{
		$payments = $this->get_bill_payments();
		if(isset($payments[$payment_id]))
		{
			$payments[$payment_id]['payment_type'] = $payment_id;
			$payments[$payment_id]['payment_amount'] = $payment_amount;
			$this->set_bill_payments($payments);

			return TRUE;
		}

		return FALSE;
	}
	

	/**
	 * Delete the selected payment from the payment array and if cash rounding is enabled
	 * and the payment type is one of the cash types then automatically delete the other
	 * @param $payment_id
	 */
	public function delete_payment($payment_id)
	{
		$payments = $this->get_bill_payments();
		
		unset($payments[$payment_id]);
		
		$this->set_bill_payments($payments);
	}

	// Multiple Payments
	public function empty_bill_payments()
	{
		$this->CI->session->unset_userdata('bill_payments');
	}



	public function get_customer()
	{
		if(!$this->CI->session->userdata('sales_customer'))
		{
			$this->set_customer(-1);
		}

		return $this->CI->session->userdata('sales_customer');
	}

	public function set_customer($customer_id)
	{
		$this->CI->session->set_userdata('sales_customer', $customer_id);
	}

	public function remove_customer()
	{
		$this->CI->session->unset_userdata('sales_customer');
	}

	

	
	
	

	
	

	


}

?>
