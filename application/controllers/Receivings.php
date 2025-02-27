<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Receivings extends Secure_Controller
{
	public function __construct()
	{
		parent::__construct('receivings');

		$this->load->library('receiving_lib');
		$this->load->library('token_lib');
		$this->load->library('barcode_lib');
	}

	public function index()
	{
		$this->_reload();
	}

	// Multiple Payments
	public function add_payment()
	{
		$data = array();

		$payment_type = $this->input->post('payment_type');
		
		$this->form_validation->set_rules('amount_tendered', 'lang:sales_amount_tendered', 'trim|required|callback_numeric');
	

		if($this->form_validation->run() == FALSE)
		{
			
				$data['error'] = $this->lang->line('sales_must_enter_numeric');
		}
		else
		{
			if($payment_type === $this->lang->line('sales_cash'))
			{
				$amount_due = $this->receiving_lib->get_total();
				$sales_total = $this->receiving_lib->get_total();

				$amount_tendered = $this->input->post('amount_tendered');
				$this->receiving_lib->add_payment($payment_type, $amount_tendered);
				$cash_adjustment_amount = $amount_due - $sales_total;
				if($cash_adjustment_amount <> 0)
				{
					$this->session->set_userdata('cash_mode', CASH_MODE_FALSE);
					$this->receiving_lib->add_payment($this->lang->line('sales_cash_adjustment'), $cash_adjustment_amount, CASH_MODE_FALSE);
				}
			}
			else
			{
				$amount_tendered = $this->input->post('amount_tendered');
				$this->receiving_lib->add_payment($payment_type, $amount_tendered);
			}
		}

		$this->_reload($data);
	}

	// Multiple Payments
	public function delete_payment($payment_id)
	{
		$this->receiving_lib->delete_payment($payment_id);

		$this->_reload();
	}

	public function item_search()
	{
		$suggestions = $this->Item->get_search_suggestions($this->input->get('term'), array('search_custom' => FALSE, 'is_deleted' => FALSE), TRUE);
		$suggestions = array_merge($suggestions, $this->Item_kit->get_search_suggestions($this->input->get('term')));

		$suggestions = $this->xss_clean($suggestions);

		echo json_encode($suggestions);
	}

	public function stock_item_search()
	{
		$suggestions = $this->Item->get_stock_search_suggestions($this->input->get('term'), array('search_custom' => FALSE, 'is_deleted' => FALSE), TRUE);
		$suggestions = array_merge($suggestions, $this->Item_kit->get_search_suggestions($this->input->get('term')));

		$suggestions = $this->xss_clean($suggestions);

		echo json_encode($suggestions);
	}

	public function select_supplier()
	{
		$supplier_id = $this->input->post('supplier');
		if($this->Supplier->exists($supplier_id))
		{
			$this->receiving_lib->set_supplier($supplier_id);
		}

		$this->_reload();
	}

	public function change_mode()
	{
		$stock_destination = $this->input->post('stock_destination');
		$stock_source = $this->input->post('stock_source');

		if((!$stock_source || $stock_source == $this->receiving_lib->get_stock_source()) &&
			(!$stock_destination || $stock_destination == $this->receiving_lib->get_stock_destination()))
		{
			$this->receiving_lib->clear_reference();
			$mode = $this->input->post('mode');
			$this->receiving_lib->set_mode($mode);
		}
		elseif($this->Stock_location->is_allowed_location($stock_source, 'receivings'))
		{
			$this->receiving_lib->set_stock_source($stock_source);
			$this->receiving_lib->set_stock_destination($stock_destination);
		}

		$this->_reload();
	}
	
	public function set_comment()
	{
		$this->receiving_lib->set_comment($this->input->post('comment'));
	}

	public function set_print_after_sale()
	{
		$this->receiving_lib->set_print_after_sale($this->input->post('recv_print_after_sale'));
	}
	
	public function set_reference()
	{
		$this->receiving_lib->set_reference($this->input->post('recv_reference'));
	}
	
	public function add()
	{
		$data = array();

		$mode = $this->receiving_lib->get_mode();
		$item_id_or_number_or_item_kit_or_receipt = $this->input->post('item');
		$this->token_lib->parse_barcode($quantity, $price, $item_id_or_number_or_item_kit_or_receipt);
		$quantity = ($mode == 'receive' || $mode == 'requisition') ? $quantity : -$quantity;
		$item_location = $this->receiving_lib->get_stock_source();
		$discount = $this->config->item('default_receivings_discount');
		$discount_type = $this->config->item('default_receivings_discount_type');

		$item = $this->Item->get_info($item_id_or_number_or_item_kit_or_receipt);

		$item_tax_info = $this->Item_taxes->get_info($item->item_id);
		$tax_percents = 0.0;
		foreach($item_tax_info as $tax_info)
		{
			$tax_percents+= $tax_info['percent'];
		}
		$item->total_tax_percent = $tax_percents;
        $mrp = $item->unit_price;

		if($mode == 'return' && $this->Receiving->is_valid_receipt($item_id_or_number_or_item_kit_or_receipt))
		{
			$this->receiving_lib->return_entire_receiving($item_id_or_number_or_item_kit_or_receipt);
		}
		elseif($this->Item_kit->is_valid_item_kit($item_id_or_number_or_item_kit_or_receipt))
		{
			$this->receiving_lib->add_item_kit($item_id_or_number_or_item_kit_or_receipt, $item_location, $discount, $discount_type);
		}
		elseif(!$this->receiving_lib->add_item($item_id_or_number_or_item_kit_or_receipt, $quantity, $item_location, $discount,  $discount_type))
		{
			$data['error'] = $this->lang->line('receivings_unable_to_add_item');
		}

		$this->_reload($data);
	}

	public function edit_item($item_id)
	{
		$data = array();

		$this->form_validation->set_rules('price', 'lang:items_price', 'required|callback_numeric');
		$this->form_validation->set_rules('quantity', 'lang:items_quantity', 'required|callback_numeric');
		$this->form_validation->set_rules('discount', 'lang:items_discount', 'required|callback_numeric');

		$description = $this->input->post('description');
		$serialnumber = $this->input->post('serialnumber');
		$price = parse_decimals($this->input->post('price'));
		$mrp = parse_decimals($this->input->post('mrp'));
		$quantity = parse_quantity($this->input->post('quantity'));
		$discount_type = $this->input->post('discount_type');
		$discount = $discount_type ? parse_quantity($this->input->post('discount')) : parse_decimals($this->input->post('discount'));

		$batch_number = $this->input->post('batch_number');
        if ($batch_number !== NULL) {
            $data['batch_number'] = $batch_number;
        }

		$receiving_quantity = $this->input->post('receiving_quantity');

		if($this->form_validation->run() != FALSE)
		{
			$this->receiving_lib->edit_item($item_id,$mrp, $batch_number,$description, $serialnumber, $quantity, $discount, $discount_type, $price, $receiving_quantity);
		}
		else
		{
			$data['error']=$this->lang->line('receivings_error_editing_item');
		}

		$this->_reload($data);
	}

	// In Receiving.php controller
    public function update_batch_number($line_number)
    {
        if ($this->input->is_ajax_request()) {
            $batchNumber = $this->input->post('batch_number');
        
            // Assuming you load your model here
            $this->load->model('Receiving_model');
        
            // Call your model method to update the 'Batch #' field
            $success = $this->Receiving_model->update_batch_number($line_number, $batchNumber);
        
            // Prepare response
            $response = array('success' => $success);
            echo json_encode($response);
        } else {
           show_404(); // Optionally show 404 if not an AJAX request
        }
    }


	
	public function edit($receiving_id)
	{
		$data = array();

		$data['suppliers'] = array('' => 'No Supplier');
		foreach($this->Supplier->get_all()->result() as $supplier)
		{
			$data['suppliers'][$supplier->person_id] = $this->xss_clean($supplier->first_name . ' ' . $supplier->last_name);
		}
	
		$data['employees'] = array();
		foreach($this->Employee->get_all()->result() as $employee)
		{
			$data['employees'][$employee->person_id] = $this->xss_clean($employee->first_name . ' '. $employee->last_name);
		}
	
		$receiving_info = $this->xss_clean($this->Receiving->get_info($receiving_id)->row_array());
		$data['selected_supplier_name'] = !empty($receiving_info['supplier_id']) ? $receiving_info['company_name'] : '';
		$data['selected_supplier_id'] = $receiving_info['supplier_id'];
		$data['receiving_info'] = $receiving_info;
	    $data['payments'] = array();
		foreach($this->Receiving->get_receiving_payments($receiving_id)->result() as $payment)
		{
			foreach(get_object_vars($payment) as $property => $value)
			{
				$payment->$property = $this->xss_clean($value);
			}
			$data['payments'][] = $payment;
		}

		$data['payment_type_new'] = PAYMENT_TYPE_UNASSIGNED;

		// don't allow gift card to be a payment option in a sale transaction edit because it's a complex change
		$payment_options = $this->Receiving->get_payment_options(FALSE);

		if($this->receiving_lib->reset_cash_rounding())
		{
			$payment_options[$this->lang->line('sales_cash_adjustment')] = $this->lang->line('sales_cash_adjustment');
		}

		$data['payment_options'] = $this->xss_clean($payment_options);

		// Set up a slightly modified list of payment types for new payment entry
		$payment_options["--"] = $this->lang->line('common_none_selected_text');

		$data['new_payment_options'] = $this->xss_clean($payment_options);

		$this->load->view('receivings/form', $data);
	}

	public function delete_item($item_number)
	{
		$this->receiving_lib->delete_item($item_number);

		$this->_reload();
	}
	
	public function delete($receiving_id = -1, $update_inventory = TRUE) 
	{
		$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$receiving_ids = $receiving_id == -1 ? $this->input->post('ids') : array($receiving_id);
	
		if($this->Receiving->delete_list($receiving_ids, $employee_id, $update_inventory))
		{
			echo json_encode(array('success' => TRUE, 'message' => $this->lang->line('receivings_successfully_deleted') . ' ' .
							count($receiving_ids) . ' ' . $this->lang->line('receivings_one_or_multiple'), 'ids' => $receiving_ids));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('receivings_cannot_be_deleted')));
		}
	}

	public function remove_supplier()
	{
		$this->receiving_lib->clear_reference();
		$this->receiving_lib->remove_supplier();

		$this->_reload();
	}

	// public function complete()
	// {
	// 	$data = array();
		
	// 	$data['cart'] = $this->receiving_lib->get_cart();
	// 	$data['total'] = $this->receiving_lib->get_total();
	// 	$data['transaction_time'] = to_datetime(time());
	// 	$data['mode'] = $this->receiving_lib->get_mode();
	// 	$data['comment'] = $this->receiving_lib->get_comment();
	// 	$data['reference'] = $this->receiving_lib->get_reference();
	// 	$data['payment_type'] = $this->input->post('payment_type');
	// 	$data['show_stock_locations'] = $this->Stock_location->show_locations('receivings');
	// 	$data['stock_location'] = $this->receiving_lib->get_stock_source();
	// 	if($this->input->post('amount_tendered') != NULL)
	// 	{
	// 		$data['amount_tendered'] = $this->input->post('amount_tendered');
	// 		$data['amount_change'] = to_currency($data['amount_tendered'] - $data['total']);
	// 	}
		
	// 	$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
	// 	$employee_info = $this->Employee->get_info($employee_id);
	// 	$data['employee'] = $employee_info->first_name . ' ' . $employee_info->last_name;

	// 	$supplier_info = '';
	// 	$supplier_id = $this->receiving_lib->get_supplier();
	// 	if($supplier_id != -1)
	// 	{
	// 		$supplier_info = $this->Supplier->get_info($supplier_id);
	// 		$data['supplier'] = $supplier_info->company_name;
	// 		$data['first_name'] = $supplier_info->first_name;
	// 		$data['last_name'] = $supplier_info->last_name;
	// 		$data['supplier_email'] = $supplier_info->email;
	// 		$data['supplier_address'] = $supplier_info->address_1;
	// 		if(!empty($supplier_info->zip) or !empty($supplier_info->city))
	// 		{
	// 			$data['supplier_location'] = $supplier_info->zip . ' ' . $supplier_info->city;				
	// 		}
	// 		else
	// 		{
	// 			$data['supplier_location'] = '';
	// 		}
	// 	}

	// 	//SAVE receiving to database
	// 	$data['receiving_id'] = 'RECV ' . $this->Receiving->save($data['cart'], $supplier_id, $employee_id, $data['comment'], $data['reference'], $data['payment_type'], $data['stock_location']);

	// 	$data = $this->xss_clean($data);

	// 	if($data['receiving_id'] == 'RECV -1')
	// 	{
	// 		$data['error_message'] = $this->lang->line('receivings_transaction_failed');
	// 	}
	// 	else
	// 	{
	// 		$data['barcode'] = $this->barcode_lib->generate_receipt_barcode($data['receiving_id']);				
	// 	}

	// 	$data['print_after_sale'] = $this->receiving_lib->is_print_after_sale();

	// 	$this->load->view("receivings/receipt",$data);

	// 	$this->receiving_lib->clear_all();
	// }

	public function complete()
	{
		$data = array();
	
		$data['cart'] = $this->receiving_lib->get_cart();
		$data['total'] = $this->receiving_lib->get_total();
		$data['transaction_time'] = to_datetime(time());
		$data['mode'] = $this->receiving_lib->get_mode();
		$data['comment'] = $this->receiving_lib->get_comment();
		$data['reference'] = $this->receiving_lib->get_reference();
		$data['payment_type'] = $this->lang->line('sales_paid');
		$data['show_stock_locations'] = $this->Stock_location->show_locations('receivings');
		$data['stock_location'] = $this->receiving_lib->get_stock_source();
		$data["payment_due_date"] = $this->input->post('payment_due_date');
		$data['due_amount']= "";
		$data['payments'] = $this->receiving_lib->get_payments();
		$total_discount = $this->input->post('total_discount');
		$total_discount_type = $this->input->post('total_discount_toggle');
	
		if ($total_discount) {
			$this->receiving_lib->set_total_discount($total_discount);
			$this->receiving_lib->set_total_discount_type($total_discount_type);
		}
	
		// Recalculate total after applying the discount
		$data['total_discount'] = $this->receiving_lib->get_total_discount();
		$data['total_discount_type'] = $this->receiving_lib->get_total_discount_type();
		$data['total'] = $this->receiving_lib->get_total();
		$data['total_taxable_amount']= $this->receiving_lib->get_total_taxable_amount();
		//echo ("Rahulsaw".$data['total']);
		$data['payment_total']= $this->receiving_lib->get_payments_total();
		if($this->input->post('amount_tendered') != NULL)
		{
			$data['amount_tendered'] = $this->input->post('amount_tendered');
			$data['amount_change'] = to_currency($data['amount_tendered'] - $data['total']);
			$data['payment_type'] = $this->lang->line('sales_due');
			$data['due_amount']=to_currency($data['total']-$data['amount_tendered']);
		}
		else{
			$data['amount_change'] = ($data['payment_total'] - $data['total']);
		}


		if($data['amount_change'] > 0)
		{
			// Save cash refund to the cash payment transaction if found, if not then add as new Cash transaction

			if(array_key_exists($this->lang->line('sales_cash'), $data['payments']))
			{
				$data['payments'][$this->lang->line('sales_cash')]['cash_refund'] = $data['amount_change'];
			}
			else
			{
				$payment = array($this->lang->line('sales_cash') => array('payment_type' => $this->lang->line('sales_cash'), 'payment_amount' => 0, 'cash_refund' => $data['amount_change']));
				$data['payments'] += $payment;
			}
		}
	
		$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$employee_info = $this->Employee->get_info($employee_id);
		$data['employee'] = $employee_info->first_name . ' ' . $employee_info->last_name;
	
		$supplier_info = '';
		$supplier_id = $this->receiving_lib->get_supplier();
		if($supplier_id != -1)
		{
			$supplier_info = $this->Supplier->get_info($supplier_id);
			$data['supplier'] = $supplier_info->company_name;
			$data['first_name'] = $supplier_info->first_name;
			$data['last_name'] = $supplier_info->last_name;
			$data['supplier_email'] = $supplier_info->email;
			$data['supplier_address'] = $supplier_info->address_1;
			if(!empty($supplier_info->zip) or !empty($supplier_info->city))
			{
				$data['supplier_location'] = $supplier_info->zip . ' ' . $supplier_info->city;                
			}
			else
			{
				$data['supplier_location'] = '';
			}
		}
	
		
		$data['receiving_id'] = $this->config->item('recv_invoice_prefix') .' '. $this->Receiving->save($data['cart'], $supplier_id, $employee_id, $data['comment'], $data['reference'], $data['payments'],$data['payment_due_date'],$data['amount_change'],$data['due_amount'],$data['stock_location'],$data['total_discount'], 
		$data['total_discount_type']);
		
		$data = $this->xss_clean($data);
	
		if($data['receiving_id'] == $this->config->item('recv_invoice_prefix').' -1')
		{
			$data['error_message'] = $this->lang->line('receivings_transaction_failed');
		}
		else
		{
			$data['barcode'] = $this->barcode_lib->generate_receipt_barcode($data['receiving_id']);                
		}
	
		$data['print_after_sale'] = $this->receiving_lib->is_print_after_sale();
	
		$this->load->view("receivings/receipt",$data);
	
		$this->receiving_lib->clear_all();
	}
	
	public function requisition_complete()
	{
		if($this->receiving_lib->get_stock_source() != $this->receiving_lib->get_stock_destination()) 
		{
			foreach($this->receiving_lib->get_cart() as $item)
			{
				$this->receiving_lib->delete_item($item['line']);
				$this->receiving_lib->add_item($item['item_id'], $item['quantity'], $this->receiving_lib->get_stock_destination(), $item['discount_type']);
				$this->receiving_lib->add_item($item['item_id'], -$item['quantity'], $this->receiving_lib->get_stock_source(), $item['discount_type']);
			}
			
			$this->complete();
		}
		else 
		{
			$data['error'] = $this->lang->line('receivings_error_requisition');

			$this->_reload($data);	
		}
	}
	
	public function receipt($receiving_id)
	{
		$receiving_info = $this->Receiving->get_info($receiving_id)->row_array();
		$this->receiving_lib->copy_entire_receiving($receiving_id);
		$data['cart'] = $this->receiving_lib->get_cart();
		$data['total'] = $this->receiving_lib->get_total();
		$data['total_taxable_amount']= $this->receiving_lib->get_total_taxable_amount();
		$data['mode'] = $this->receiving_lib->get_mode();
		$data['transaction_time'] = to_datetime(strtotime($receiving_info['receiving_time']));
		$data['show_stock_locations'] = $this->Stock_location->show_locations('receivings');
		$data['payment_type'] = $receiving_info['payment_type'];
		$data['reference'] = $this->receiving_lib->get_reference();
		$data['receiving_id'] = $this->config->item('recv_invoice_prefix').' ' . $receiving_id;
		$data['barcode'] = $this->barcode_lib->generate_receipt_barcode($data['receiving_id']);
		$employee_info = $this->Employee->get_info($receiving_info['employee_id']);
		$data['employee'] = $employee_info->first_name . ' ' . $employee_info->last_name;

		$supplier_id = $this->receiving_lib->get_supplier();
		if($supplier_id != -1)
		{
			$supplier_info = $this->Supplier->get_info($supplier_id);
			$data['supplier'] = $supplier_info->company_name;
			$data['first_name'] = $supplier_info->first_name;
			$data['last_name'] = $supplier_info->last_name;
			$data['supplier_email'] = $supplier_info->email;
			$data['supplier_address'] = $supplier_info->address_1;
			if(!empty($supplier_info->zip) or !empty($supplier_info->city))
			{
				$data['supplier_location'] = $supplier_info->zip . ' ' . $supplier_info->city;				
			}
			else
			{
				$data['supplier_location'] = '';
			}
		}

		$data['print_after_sale'] = FALSE;

		$data = $this->xss_clean($data);
		
		$this->load->view("receivings/receipt", $data);

		$this->receiving_lib->clear_all();
	}
	
	public function set_total_discount()
	{
		$total_discount = $this->input->post('total_discount');
		$total_discount_type = $this->input->post('total_discount_toggle');
	
		if ($total_discount) {
			$this->receiving_lib->set_total_discount($total_discount);
			$this->receiving_lib->set_total_discount_type($total_discount_type);
		}
		$this->_reload();
	}

	private function _reload($data = array())
	{
		$data['cart'] = $this->receiving_lib->get_cart();
		$data['modes'] = array('receive' => $this->lang->line('receivings_receiving'), 'return' => $this->lang->line('receivings_return'));
		$data['mode'] = $this->receiving_lib->get_mode();
		$data['stock_locations'] = $this->Stock_location->get_allowed_locations('receivings');
		$data['show_stock_locations'] = count($data['stock_locations']) > 1;
		if($data['show_stock_locations']) 
		{
			$data['modes']['requisition'] = $this->lang->line('receivings_requisition');
			$data['stock_source'] = $this->receiving_lib->get_stock_source();
			$data['stock_destination'] = $this->receiving_lib->get_stock_destination();
		}
        $data['payments'] = $this->receiving_lib->get_payments();
		$data['total'] = $this->receiving_lib->get_total();
		$data['payment_total']=$this->receiving_lib->get_payments_total(); 
		$data['total_taxable_amount']= $this->receiving_lib->get_total_taxable_amount();
		$data['items_module_allowed'] = $this->Employee->has_grant('items', $this->Employee->get_logged_in_employee_info()->person_id);
		$data['comment'] = $this->receiving_lib->get_comment();
		$data['reference'] = $this->receiving_lib->get_reference();
		$data['payment_options'] = $this->Receiving->get_payment_options();
		$data['cash_mode'] = $this->session->userdata('cash_mode');
		$data['amount_due'] = bcsub($data['total'],$data['payment_total']);
		// 0 decimal -> 1 / 2 = 0.5, 1 decimals -> 0.1 / 2 = 0.05, 2 decimals -> 0.01 / 2 = 0.005
		$threshold = bcpow(10, -totals_decimals()) / 2;

			if($this->receiving_lib->get_mode() == 'return')
			{
				$data['payments_cover_total'] = $data['amount_due'] > -$threshold;
			}
			else
			{
				$data['payments_cover_total'] = $data['amount_due'] < $threshold;
			}
		

		// Include total discount and discount type in the data
		$data['total_discount'] = $this->receiving_lib->get_total_discount();
		$data['total_discount_type'] = $this->receiving_lib->get_total_discount_type();

		$supplier_id = $this->receiving_lib->get_supplier();
		$supplier_info = '';
		if($supplier_id != -1)
		{
			$supplier_info = $this->Supplier->get_info($supplier_id);
			$data['supplier'] = $supplier_info->company_name;
			$data['first_name'] = $supplier_info->first_name;
			$data['last_name'] = $supplier_info->last_name;
			$data['supplier_email'] = $supplier_info->email;
			$data['supplier_address'] = $supplier_info->address_1;
			if(!empty($supplier_info->zip) or !empty($supplier_info->city))
			{
				$data['supplier_location'] = $supplier_info->zip . ' ' . $supplier_info->city;				
			}
			else
			{
				$data['supplier_location'] = '';
			}
		}
		
		$data['print_after_sale'] = $this->receiving_lib->is_print_after_sale();

		$data = $this->xss_clean($data);

		$this->load->view("receivings/receiving", $data);
	}
	
	public function save($receiving_id = -1)
	{
		$newdate = $this->input->post('date');
		
		$date_formatter = date_create_from_format($this->config->item('dateformat') . ' ' . $this->config->item('timeformat'), $newdate);
		$receiving_time = $date_formatter->format('Y-m-d H:i:s');

		$receiving_data = array(
			'receiving_time' => $receiving_time,
			'supplier_id' => $this->input->post('supplier_id') ? $this->input->post('supplier_id') : NULL,
			'payment_type' => $this->input->post('payment_type'),
			'employee_id' => $this->input->post('employee_id'),
			'comment' => $this->input->post('comment'),
			'reference' => $this->input->post('reference') != '' ? $this->input->post('reference') : NULL 
		);
	// 	if($this->input->post('payment_type') == $this->lang->line('sales_paid'))
	// 	{
	// 	$receiving_data = array(
	// 		'receiving_time' => $receiving_time,
	// 		'supplier_id' => $this->input->post('supplier_id') ? $this->input->post('supplier_id') : NULL,
	// 		'payment_type' => $this->input->post('payment_type'),
	// 		'employee_id' => $this->input->post('employee_id'),
	// 		'comment' => $this->input->post('comment'),
	// 		'reference' => $this->input->post('reference') != '' ? $this->input->post('reference') : NULL,
	// 		'due_amount' => "" 
	// 	);
	//   }
	

	// Added for Receiving payment

	// In order to maintain tradition the only element that can change on prior payments is the payment type
	$payments = array();
	$amount_tendered = 0;
	$number_of_payments = $this->input->post('number_of_payments');
	for($i = 0; $i < $number_of_payments; ++$i)
	{
		$payment_id = $this->input->post('payment_id_' . $i);
		$payment_type = $this->input->post('payment_type_' . $i);
		$payment_amount = $this->input->post('payment_amount_' . $i);
		$refund_type = $this->input->post('refund_type_' . $i);
		$cash_refund = $this->input->post('refund_amount_' . $i);

		if($payment_type == $this->lang->line('sales_cash_adjustment'))
		{
			$cash_adjustment = CASH_ADJUSTMENT_TRUE;
		}
		else
		{
			$cash_adjustment = CASH_ADJUSTMENT_FALSE;
		}

		if(!$cash_adjustment)
		{
			$amount_tendered += $payment_amount - $cash_refund;
		}

		// if the refund is not cash ...
		if(empty(strstr($refund_type, $this->lang->line('sales_cash'))))
		{
			// ... and it's positive ...
			if($cash_refund > 0)
			{
				// ... change it to be a new negative payment (a "non-cash refund")
				$payment_type = $refund_type;
				$payment_amount = $payment_amount - $cash_refund;
				$cash_refund = 0.00;
			}
		}


		$payments[] = array('payment_id' => $payment_id, 'payment_type' => $payment_type, 'payment_amount' => $payment_amount, 'cash_refund' => $cash_refund, 'cash_adjustment' => $cash_adjustment);
	}

	$payment_id = -1;
	$payment_amount = $this->input->post('payment_amount_new');
	$payment_type = $this->input->post('payment_type_new');

	if($payment_type != PAYMENT_TYPE_UNASSIGNED && $payment_amount <> 0)
	{
		$cash_refund = 0;
		if($payment_type == $this->lang->line('sales_cash_adjustment'))
		{
			$cash_adjustment = CASH_ADJUSTMENT_TRUE;
		}
		else
		{
			$cash_adjustment = CASH_ADJUSTMENT_FALSE;
			$amount_tendered += $payment_amount;
			$receiving_info = $this->Receving->get_info($receiving_id)->row_array();

			if($amount_tendered > $receiving_info['amount_due'])
			{
				$cash_refund = $amount_tendered - $receiving_info['amount_due'];
			}
		}

		$payments[] = array('payment_id' => $payment_id, 'payment_type' => $payment_type, 'payment_amount' => $payment_amount, 'cash_refund' => $cash_refund, 'cash_adjustment' => $cash_adjustment);
	}
	// End of Addition for Receiving payment

		$this->Inventory->update($this->config->item('recv_invoice_prefix').' '.$receiving_id, ['trans_date' => $receiving_time]);
		if($this->Receiving->update($receiving_data, $receiving_id,$payments))
		{
			echo json_encode(array('success' => TRUE, 'message' => $this->lang->line('receivings_successfully_updated'), 'id' => $receiving_id));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('receivings_unsuccessfully_updated'), 'id' => $receiving_id));
		}
		
	}

	public function cancel_receiving()
	{
		$this->receiving_lib->clear_all();

		$this->_reload();
	}
	
}
?>
