<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Payments extends Secure_Controller
{
	public function __construct()
	{
		parent::__construct('payments');

		$this->load->helper('file');
		$this->load->library('payment_lib');
	}

	public function index()
	{
		$this->session->set_userdata('allow_temp_items', 1);
		$this->_reload();
	}

	public function change_mode()
	{
		$mode = $this->input->post('mode');
		$this->payment_lib->set_mode($mode);
		$this->payment_lib->empty_bill_payments();

		$this->_reload();
	}

	public function change_customer()
	{
		$customer = $this->input->post('customer');
		//$customer=$this->Customer->get_infos($customer_id)[$customer_id];
		$this->payment_lib->set_selected_customer($customer);
		$this->payment_lib->empty_bill_payments();

		$this->_reload();
	}


	public function change_supplier()
	{
		$supplier = $this->input->post('supplier');
		//$customer=$this->Customer->get_infos($customer_id)[$customer_id];
		$this->payment_lib->set_supplier($supplier);
		$this->payment_lib->empty_bill_payments();

		$this->_reload();
	}


	public function add_bill()
	{
		$bill_payment_d = $this->input->post('payment_id');
		//$customer=$this->Customer->get_infos($customer_id)[$customer_id];
		$mode= $this->payment_lib->get_mode();
		if($mode=="customer")
		{
		$bill_due_amount=$this->Payment->due_customer_amount($bill_payment_d);
		}
		if($mode=="supplier")
		{
		$bill_due_amount=$this->Payment->due_supplier_amount($bill_payment_d);
		}
		$payment_type=$this->lang->line('sales_cash');
        $bill_type=(($mode=="customer") ? 0 : 1);
		$this->payment_lib->add_payment($bill_payment_d,$bill_due_amount,$payment_type,0,$bill_type);

		$this->_reload();
	}
	public function update_bill()
	{
		$bill_id=$this->input->post('bill_no');
		$payment_type=$this->input->post('payment_type');
		$payment_amount=$this->input->post('payment_amount')?$this->input->post('payment_amount'):'0';
		$due_amount=$this->input->post('due_amount')?$this->input->post('due_amount'):'0';
		//$customer=$this->Customer->get_infos($customer_id)[$customer_id];
		if($payment_amount<=0)
		{
				// Set flash data for the error message
				$this->session->set_flashdata('error', 'Payment amount must be greater than 0.');
				
				// Redirect back or reload the page
				$this->_reload(); // Replace with the appropriate path
				return;
		}
		$mode= $this->payment_lib->get_mode();
		$bill_type=(($mode=="customer") ? 1 : 0);
		$this->payment_lib->add_payment($bill_id,$due_amount,$payment_type,$payment_amount,$bill_type);

		$this->_reload();
	}
    

	// Multiple Payments
	public function delete_payment($payment_id)
	{
		$this->payment_lib->delete_payment($payment_id);

		$this->_reload();
	}

	public function complete()
	{
		$data = $this->payment_lib->get_bill_payments();
		$this->Payment->update_bill_no($data);
		$this->payment_lib->clear_all();
		$this->_reload();

	}

	
	private function _reload($data = array())
	{

		$data['cart'] = $this->payment_lib->get_bill_payments();
		$data['modes'] = $this->payment_lib->get_register_mode_options();
		$data['mode'] = $this->payment_lib->get_mode();
		$data['customers'] = $this->Customer->get_infos($this->Payment->get_customer());
		$data['customer'] = $this->payment_lib->get_selected_customer();
		$data['payments'] = $this->payment_lib->get_bill_payments();
		$data['suppliers'] = $this->Supplier->get_infos($this->Payment->get_supplier());
		$data['supplier'] = $this->payment_lib->get_supplier();
		$data['payment_options'] = $this->Payment->get_payment_options();
		if($data['mode']=="customer")
		{
			$data['bills'] = $this->Payment->get_customer_bills($data['customer']);
		}
		else if($data['mode']=="supplier")
		{
			$data['bills'] = $this->Payment->get_supplier_bills($data['supplier']);
		}
		$data = $this->xss_clean($data);

		$this->load->view("payments/register", $data);
	}

	

	


	public function cancel()
	{
		$this->payment_lib->clear_all();
		$this->_reload();
	}

	

	
}
?>
