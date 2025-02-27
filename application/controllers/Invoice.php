<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");
class Invoice extends Secure_Controller
{
	public function __construct()
	{
		parent::__construct('sales');

        $this->load->helper('file');
		$this->load->library('sale_lib');
		$this->load->library('email_lib');
		$this->load->library('token_lib');
		$this->load->library('barcode_lib');
		$this->load->library('sms_lib');
	}

	public function index()
	{
		$this->session->set_userdata('allow_temp_items', 1);
		$this->invoice_print();
	}

    private function invoice_print($data = array())
	{
        $sale_id = $this->session->userdata('sale_id');
		if($sale_id == '')
		{
			$sale_id = -1;
			$this->session->set_userdata('sale_id', -1);
		}
		$cash_rounding = $this->sale_lib->reset_cash_rounding();
        
		// cash_rounding indicates only that the site is configured for cash rounding
		$data['cash_rounding'] = $cash_rounding;

		$data['cart'] = $this->sale_lib->get_cart();
		$customer_info = $this->_load_customer_data($this->sale_lib->get_customer(), $data, TRUE);

		$data['modes'] = $this->sale_lib->get_register_mode_options();
		$data['mode'] = $this->sale_lib->get_mode();
		$data['selected_table'] = $this->sale_lib->get_dinner_table();
		$data['empty_tables'] = $this->sale_lib->get_empty_tables($data['selected_table']);
		$data['stock_locations'] = $this->Stock_location->get_allowed_locations('sales');
		$data['stock_location'] = $this->sale_lib->get_sale_location();
		$data['tax_exclusive_subtotal'] = $this->sale_lib->get_subtotal(TRUE, TRUE);
		$tax_details = $this->tax_lib->get_taxes($data['cart']);
		$data['taxes'] = $tax_details[0];
		$data['discount'] = $this->sale_lib->get_discount();
		$data['payments'] = $this->sale_lib->get_payments();

		// Returns 'subtotal', 'total', 'cash_total', 'payment_total', 'amount_due', 'cash_amount_due', 'payments_cover_total'
		$totals = $this->sale_lib->get_totals($tax_details[0]);

		$data['item_count'] = $totals['item_count'];
		$data['total_units'] = $totals['total_units'];
		$data['subtotal'] = $totals['subtotal'];
		$data['total'] = $totals['total'];
		$data['payments_total'] = $totals['payment_total'];
		$data['payments_cover_total'] = $totals['payments_cover_total'];

		// cash_mode indicates whether this sale is going to be processed using cash_rounding
		$cash_mode = $this->session->userdata('cash_mode');
		$data['cash_mode'] = $cash_mode;
		$data['prediscount_subtotal'] = $totals['prediscount_subtotal'];
		$data['cash_total'] = $totals['cash_total'];
		$data['non_cash_total'] = $totals['total'];
		$data['cash_amount_due'] = $totals['cash_amount_due'];
		$data['non_cash_amount_due'] = $totals['amount_due'];

		$data['selected_payment_type'] = $this->sale_lib->get_payment_type();

		if($data['cash_mode'] && ($data['selected_payment_type'] == $this->lang->line('sales_cash') || $data['payments_total'] > 0))
		{
			$data['total'] = $totals['cash_total'];
			$data['amount_due'] = $totals['cash_amount_due'];
		}
		else
		{
			$data['total'] = $totals['total'];
			$data['amount_due'] = $totals['amount_due'];
		}

		$data['amount_change'] = $data['amount_due'] * -1;

		$data['comment'] = $this->sale_lib->get_comment();
		$data['email_receipt'] = $this->sale_lib->is_email_receipt();

		if($customer_info && $this->config->item('customer_reward_enable') == TRUE)
		{
			$data['payment_options'] = $this->Sale->get_payment_options(TRUE, TRUE);
		}
		else
		{
			$data['payment_options'] = $this->Sale->get_payment_options();
		}

		$data['items_module_allowed'] = $this->Employee->has_grant('items', $this->Employee->get_logged_in_employee_info()->person_id);
		$data['change_price'] = $this->Employee->has_grant('sales_change_price', $this->Employee->get_logged_in_employee_info()->person_id);

		$temp_invoice_number = $this->sale_lib->get_invoice_number();
		$invoice_format = $this->config->item('sales_invoice_format');

		if ($temp_invoice_number == NULL || $temp_invoice_number == '')
		{
			$temp_invoice_number = $this->token_lib->render($invoice_format, array(), FALSE);
		}

		$data['invoice_number'] = $temp_invoice_number;

		$data['print_after_sale'] = $this->sale_lib->is_print_after_sale();
		$data['price_work_orders'] = $this->sale_lib->is_price_work_orders();

		$data['pos_mode'] = $data['mode'] == 'sale' || $data['mode'] == 'return';

		$data['quote_number'] = $this->sale_lib->get_quote_number();
		$data['work_order_number'] = $this->sale_lib->get_work_order_number();

		if($this->sale_lib->get_mode() == 'sale_invoice')
		{
			$data['mode_label'] = $this->lang->line('sales_invoice');
			$data['customer_required'] = $this->lang->line('sales_customer_required');
		}
		elseif($this->sale_lib->get_mode() == 'sale_quote')
		{
			$data['mode_label'] = $this->lang->line('sales_quote');
			$data['customer_required'] = $this->lang->line('sales_customer_required');
		}
		elseif($this->sale_lib->get_mode() == 'sale_work_order')
		{
			$data['mode_label'] = $this->lang->line('sales_work_order');
			$data['customer_required'] = $this->lang->line('sales_customer_required');
		}
		elseif($this->sale_lib->get_mode() == 'return')
		{
			$data['mode_label'] = $this->lang->line('sales_return');
			$data['customer_required'] = $this->lang->line('sales_customer_optional');
		}
		else
		{
			$data['mode_label'] = $this->lang->line('sales_receipt');
			$data['customer_required'] = $this->lang->line('sales_customer_optional');
		}

		$data = $this->xss_clean($data);
		$items = $this->Sale->get_all();
		$grouped_data = [];
	
		// Reindex the array to ensure it's properly formatted as a JSON array
		$grouped_data = array_values($grouped_data);
		$data['grouped_data'] = $grouped_data;
		// echo"<pre/>"; print_r($data); exit;
		$this->load->view("sales/invoice_print", $data);
	}

    private function _load_customer_data($customer_id, &$data, $stats = FALSE)
	{
		$customer_info = '';

		if($customer_id != -1)
		{
			$customer_info = $this->Customer->get_info($customer_id);
			$data['customer_id'] = $customer_id;
			if(!empty($customer_info->company_name))
			{
				$data['customer'] = $customer_info->company_name;
			}
			else
			{
				$data['customer'] = $customer_info->first_name . ' ' . $customer_info->last_name;
			}
			$data['first_name'] = $customer_info->first_name;
			$data['last_name'] = $customer_info->last_name;
			$data['customer_email'] = $customer_info->email;
			$data['customer_address'] = $customer_info->address_1;
			$data['customer_phone_number'] = $customer_info->phone_number;
			if(!empty($customer_info->zip) || !empty($customer_info->city))
			{
				$data['customer_location'] = $customer_info->zip . ' ' . $customer_info->city . "\n" . $customer_info->state;
			}
			else
			{
				$data['customer_location'] = '';
			}
			$data['customer_account_number'] = $customer_info->account_number;
			$data['customer_discount'] = $customer_info->discount;
			$data['customer_discount_type'] = $customer_info->discount_type;
			$package_id = $this->Customer->get_info($customer_id)->package_id;
			if($package_id != NULL)
			{
				$package_name = $this->Customer_rewards->get_name($package_id);
				$points = $this->Customer->get_info($customer_id)->points;
				$data['customer_rewards']['package_id'] = $package_id;
				$data['customer_rewards']['points'] = empty($points) ? 0 : $points;
				$data['customer_rewards']['package_name'] = $package_name;
			}

			if($stats)
			{
				$cust_stats = $this->Customer->get_stats($customer_id);
				$data['customer_total'] = empty($cust_stats) ? 0 : $cust_stats->total;
			}

			$data['customer_info'] = implode("\n", array(
				$data['customer'],
				$data['customer_address'],
				$data['customer_location']
			));

			if($data['customer_account_number'])
			{
				$data['customer_info'] .= "\n" . $this->lang->line('sales_account_number') . ": " . $data['customer_account_number'];
			}
			if($customer_info->tax_id != '')
			{
				$data['customer_info'] .= "\n" . $this->lang->line('sales_tax_id') . ": " . $customer_info->tax_id;
			}
			$data['tax_id'] = $customer_info->tax_id;
		}

		return $customer_info;
	}
}