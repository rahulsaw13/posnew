<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Tabular views helper
 */

/*
Basic tabular headers function
*/
function transform_headers_readonly($array)
{
	$result = array();

	foreach($array as $key => $value)
	{
		$result[] = array('field' => $key, 'title' => $value, 'sortable' => $value != '', 'switchable' => !preg_match('(^$|&nbsp)', $value));
	}

	return json_encode($result);
}

/*
Basic tabular headers function
*/
function transform_headers($array, $readonly = FALSE, $editable = TRUE)
{
	$result = array();

	if(!$readonly)
	{
		$array = array_merge(array(array('checkbox' => 'select', 'sortable' => FALSE)), $array);
	}

	if($editable)
	{
		$array[] = array('edit' => '');
	}

	foreach($array as $element)
	{
		reset($element);
		$result[] = array('field' => key($element),
			'title' => current($element),
			'switchable' => isset($element['switchable']) ? $element['switchable'] : !preg_match('(^$|&nbsp)', current($element)),
			'escape' => !preg_match("/(edit|phone_number|email|messages|item_pic)/", key($element)) && !(isset($element['escape']) && !$element['escape']),
			'sortable' => isset($element['sortable']) ? $element['sortable'] : current($element) != '',
			'checkbox' => isset($element['checkbox']) ? $element['checkbox'] : FALSE,
			'class' => isset($element['checkbox']) || preg_match('(^$|&nbsp)', current($element)) ? 'print_hide' : '',
			'sorter' => isset($element['sorter']) ? $element ['sorter'] : '');
	}

	return json_encode($result);
}


/*
Get the header for the sales tabular view
*/
function get_sales_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('sale_id' => $CI->lang->line('common_id')),
		array('sale_time' => $CI->lang->line('sales_sale_time')),
		array('customer_name' => $CI->lang->line('customers_customer')),
		array('amount_due' => $CI->lang->line('sales_amount_due')),
		array('amount_tendered' => $CI->lang->line('sales_amount_tendered')),
		array('change_due' => $CI->lang->line('sales_change_due')),
		array('payment_type' => $CI->lang->line('sales_payment_type'))
	);

	if($CI->config->item('invoice_enable') == TRUE)
	{
		$headers[] = array('invoice_number' => $CI->lang->line('sales_invoice_number'));
		$headers[] = array('invoice' => '&nbsp', 'sortable' => FALSE, 'escape' => FALSE);
	}

	$headers[] = array('receipt' => '&nbsp', 'sortable' => FALSE, 'escape' => FALSE);

	return transform_headers($headers);
}

/*
Get the html data row for the sales
*/
function get_sale_data_row($sale)
{
	$CI =& get_instance();

	$controller_name = $CI->uri->segment(1);

	$row = array (
		'sale_id' => $sale->sale_id,
		'sale_time' => to_datetime(strtotime($sale->sale_time)),
		'customer_name' => $sale->customer_name,
		'amount_due' => to_currency($sale->amount_due),
		'amount_tendered' => to_currency($sale->amount_tendered),
		'change_due' => to_currency($sale->change_due),
		'payment_type' => $sale->payment_type
	);

	if($CI->config->item('invoice_enable'))
	{
		$row['invoice_number'] = $sale->invoice_number;
		$row['invoice'] = empty($sale->invoice_number) ? '' : anchor($controller_name."/invoice/$sale->sale_id", '<span class="glyphicon glyphicon-list-alt"></span>',
			array('title'=>$CI->lang->line('sales_show_invoice'))
		);
	}

	$row['receipt'] = anchor($controller_name."/receipt/$sale->sale_id", '<span class="glyphicon glyphicon-usd"></span>',
		array('title' => $CI->lang->line('sales_show_receipt'))
	);
	$row['edit'] = anchor($controller_name."/edit/$sale->sale_id", '<span class="glyphicon glyphicon-edit"></span>',
		array('class' => 'modal-dlg print_hide', 'data-btn-delete' => $CI->lang->line('common_delete'), 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
	);

	return $row;
}

/*
Get the html data last row for the sales
*/
function get_sale_data_last_row($sales)
{
	$CI =& get_instance();

	$sum_amount_due = 0;
	$sum_amount_tendered = 0;
	$sum_change_due = 0;

	foreach($sales->result() as $key=>$sale)
	{
		$sum_amount_due += $sale->amount_due;
		$sum_amount_tendered += $sale->amount_tendered;
		$sum_change_due += $sale->change_due;
	}

	return array(
		'sale_id' => '-',
		'sale_time' => $CI->lang->line('sales_total'),
		'amount_due' => to_currency($sum_amount_due),
		'amount_tendered' => to_currency($sum_amount_tendered),
		'change_due' => to_currency($sum_change_due)
	);
}

/*
Get the sales payments summary
*/
function get_sales_manage_payments_summary($payments)
{
	$CI =& get_instance();

	$table = '<div id="report_summary">';
	$total = 0;

	foreach($payments as $key=>$payment)
	{
		$amount = $payment['payment_amount'];
		$total = bcadd($total, $amount);
		$table .= '<div class="summary_row">' . $payment['payment_type'] . ': ' . to_currency($amount) . '</div>';
	}
	$table .= '<div class="summary_row">' . $CI->lang->line('sales_total') . ': ' . to_currency($total) . '</div>';
	$table .= '</div>';

	return $table;
}


/*
Get the header for the people tabular view
*/
function get_people_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('people.person_id' => $CI->lang->line('common_id')),
		array('last_name' => $CI->lang->line('common_last_name')),
		array('first_name' => $CI->lang->line('common_first_name')),
		array('email' => $CI->lang->line('common_email')),
		array('no_of_days_worked' => $CI->lang->line('employee_no_of_days_worked')),
		array('advance_salary' => $CI->lang->line('employees_advance_salary')),
		array('monthly_salary' => $CI->lang->line('employees_monthly_salary')),
		array('daily_salary' => $CI->lang->line('employees_daily_salary')),
		array('phone_number' => $CI->lang->line('common_phone_number'))
	);

	if($CI->Employee->has_grant('messages', $CI->session->userdata('person_id')))
	{
		$headers[] = array('messages' => '', 'sortable' => FALSE);
	}

	return transform_headers($headers);
}


/*
Get the header for the referal tabular view
*/
function get_referral_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('referral_id' => $CI->lang->line('referrals_id')),

		array('name' => $CI->lang->line('referrals_name'),'escape' => FALSE),

		array('phone_no' => $CI->lang->line('referrals_phone_number')),
		array('address' => $CI->lang->line('referrals_address'))
	);

	return transform_headers($headers);
}

/*
Get the header for the referal detailed tabular view
*/
function get_referral_detailed_report_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('Bill_no' => $CI->lang->line('Bill_no')),
		array('Bill_amount' => $CI->lang->line('Bill_amount')),
		array('Commission' => $CI->lang->line('Commission')),

		array('commission_paid_status' => $CI->lang->line('commission_paid_status'))

	);

	return transform_headers($headers);
}

/*
Get the html data row for the person
*/
function get_person_data_row($person)
{
	$CI =& get_instance();
	$controller_name = strtolower(get_class($CI));

	return array (
		'people.person_id' => $person->person_id,
		'last_name' => $person->last_name,
		'first_name' => $person->first_name,
		'email' => empty($person->email) ? '' : mailto($person->email, $person->email),
		'no_of_days_worked' => $no_of_days_worked,
		'advance_salary' => $person->employee_advance_salary,
		'monthly_salary' => $person->employee_monthly_salary,
		'daily_salary' => $person->employee_daily_salary,
		'phone_number' => $person->phone_number,
		'messages' => empty($person->phone_number) ? '' : anchor("Messages/view/$person->person_id", '<span class="glyphicon glyphicon-phone"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line('messages_sms_send'))),
		'edit' => anchor($controller_name."/view/$person->person_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		)
	);
}


/*
Get the header for the customer tabular view
*/
function get_customer_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('people.person_id' => $CI->lang->line('common_id')),
		array('last_name' => $CI->lang->line('common_last_name')),
		array('first_name' => $CI->lang->line('common_first_name')),
		array('email' => $CI->lang->line('common_email')),
		array('phone_number' => $CI->lang->line('common_phone_number')),
		array('total' => $CI->lang->line('common_total_spent'), 'sortable' => FALSE),
		// array('category' => $CI->lang->line('customers_category')),
		// array('referred_by' => $CI->lang->line('customers_referred_by')),
		// array('location_link' => $CI->lang->line('customers_location_link'),'escape' => FALSE),
	);

	if($CI->Employee->has_grant('messages', $CI->session->userdata('person_id')))
	{
		$headers[] = array('messages' => '', 'sortable' => FALSE);
	}

	return transform_headers($headers);
}

/*
Get the html data row for the customer
*/
function get_customer_data_row($person, $stats)
{
	$CI =& get_instance();

	$controller_name = strtolower(get_class($CI));

	return array (
		'people.person_id' => $person->person_id,
		'last_name' => $person->last_name,
		'first_name' => $person->first_name,
		'email' => empty($person->email) ? '' : mailto($person->email, $person->email),
		'phone_number' => $person->phone_number,
		'total' => to_currency($stats->total),
		// 'category' => $person->customer_category,
		// 'referred_by' => $person->referred_by,
		// 'location_link' => !empty($person->location) ? anchor($person->location, $CI->lang->line('click_here'), ['target' => '_blank']) : '',
		'messages' => empty($person->phone_number) ? '' : anchor("Messages/view/$person->person_id", '<span class="glyphicon glyphicon-phone"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line('messages_sms_send'))),
		'edit' => anchor($controller_name."/view/$person->person_id", '<span class="glyphicon glyphicon-edit"></span>',
			// array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
	));
}

/*
Get the header for the suppliers tabular view
*/
function get_suppliers_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('people.person_id' => $CI->lang->line('common_id')),
		array('company_name' => $CI->lang->line('suppliers_company_name')),
		array('agency_name' => $CI->lang->line('suppliers_agency_name')),
		array('category' => $CI->lang->line('suppliers_category')),
		array('last_name' => $CI->lang->line('common_last_name')),
		array('first_name' => $CI->lang->line('common_first_name')),
		array('email' => $CI->lang->line('common_email')),
		array('phone_number' => $CI->lang->line('common_phone_number'))
	);

	if($CI->Employee->has_grant('messages', $CI->session->userdata('person_id')))
	{
		$headers[] = array('messages' => '');
	}

	return transform_headers($headers);
}

/*
Get the html data row for the supplier
*/
function get_supplier_data_row($supplier)
{
	$CI =& get_instance();

	$controller_name = strtolower(get_class($CI));

	return array (
		'people.person_id' => $supplier->person_id,
		'company_name' => $supplier->company_name,
		'agency_name' => $supplier->agency_name,
		'category' => $supplier->category,
		'last_name' => $supplier->last_name,
		'first_name' => $supplier->first_name,
		'email' => empty($supplier->email) ? '' : mailto($supplier->email, $supplier->email),
		'phone_number' => $supplier->phone_number,
		'messages' => empty($supplier->phone_number) ? '' : anchor("Messages/view/$supplier->person_id", '<span class="glyphicon glyphicon-phone"></span>',
			array('class'=>"modal-dlg", 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line('messages_sms_send'))),
		'edit' => anchor($controller_name."/view/$supplier->person_id", '<span class="glyphicon glyphicon-edit"></span>',
			// array('class'=>"modal-dlg", 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
			));
}


/*
Get the header for the bankdetais tabular view
*/

function get_bankdetails_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('bank_id' => $CI->lang->line('bank_id')),
		array('created_at' => $CI->lang->line('created_at')),
		array('bank_account_holder_name' => $CI->lang->line('bank_account_holder_name')),
		array('bank_account_number' => $CI->lang->line('bank_account_number')),
		array('bank_ifsc' => $CI->lang->line('bank_ifsc')),
		array('bank_upi_id' => $CI->lang->line('bank_upi_id')),
		array('is_active' => $CI->lang->line('is_active')),
		array('is_primary' => $CI->lang->line('is_primary'))
	);

	// $headers[] = array('inventory' => '', 'escape' => FALSE);
	// $headers[] = array('stock' => '', 'escape' => FALSE);

	return transform_headers($headers);
}



/*
Get the html data row for the item
*/
function get_referral_data_row($referral)
{  
	$CI =& get_instance();
	$controller_name = strtolower(get_class($CI));

	$columns = array (
		'referral_id' => $referral->referral_id,

		'name' => anchor("detailed_referral_report/$referral->referral_id", $referral->name),

		'phone_no' => $referral->phone_no,
		'address' => $referral->address,
	);

	$icons = array(
		'edit' => anchor($controller_name."/view/$referral->referral_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class' => 'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		)
	);

	return $columns+$icons;

}

/*
Get the html data row for the item
*/
function get_bankdetail_data_row($bankdetail)
{  
	$CI =& get_instance();
	$controller_name = strtolower(get_class($CI));

	$columns = array (
		'bank_id' => $bankdetail->bank_id,
		'bank_account_holder_name' => $bankdetail->bank_account_holder_name,
		'bank_account_number' => $bankdetail->bank_account_number,
		'bank_ifsc' => $bankdetail->bank_ifsc,
		'is_primary' => ($bankdetail->is_primary?"Y":"N"),
		'is_active' => ($bankdetail->is_active?"Y":"N"),
		'created_at' => $bankdetail->created_at
	);

	$icons = array(
		// 'inventory' => anchor($controller_name."/inventory/$item->item_id", '<span class="glyphicon glyphicon-pushpin"></span>',
		// 	array('class' => 'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_count'))
		// ),
		// 'stock' => anchor($controller_name."/count_details/$item->item_id", '<span class="glyphicon glyphicon-list-alt"></span>',
		// 	array('class' => 'modal-dlg', 'title' => $CI->lang->line($controller_name.'_details_count'))
		// ),
		'edit' => anchor($controller_name."/view/$bankdetail->bank_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class' => 'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		)
	);

	return $columns+$icons;

}

/*
Get the header for the items tabular view
*/
function get_items_manage_table_headers()
{
	$CI =& get_instance();

	$definition_names = $CI->Attribute->get_definitions_by_flags(Attribute::SHOW_IN_ITEMS);

	$headers = array(
		array('item_number' => $CI->lang->line('items_item_number')),
		array('items.item_id' => $CI->lang->line('common_id')),
		array('name' => $CI->lang->line('items_name'),'escape' => FALSE),
		array('batch_number' => $CI->lang->line('items_batch_number')),
		array('category' => $CI->lang->line('items_category')),
		array('company_name' => $CI->lang->line('suppliers_company_name')),
		array('cost_price' => $CI->lang->line('items_cost_price')),
		array('unit_price' => $CI->lang->line('items_unit_price')),
		// array('wholesale_price' => $CI->lang->line('items_wholesale_price')),
		array('quantity' => $CI->lang->line('items_quantity')),
		// array('commission_price' => $CI->lang->line('items_commission_price'))
	);

	if($CI->config->item('use_destination_based_tax') == '1')
	{
		$headers[] = array('tax_percents' => $CI->lang->line('items_tax_category'), 'sortable' => FALSE);
	}
	else
	{
		$headers[] = array('tax_percents' => $CI->lang->line('items_tax_percents'), 'sortable' => FALSE);

	}

	$headers[] = array('item_pic' => $CI->lang->line('items_image'), 'sortable' => FALSE);

	foreach($definition_names as $definition_id => $definition_name)
	{
		$headers[] = array($definition_id => $definition_name, 'sortable' => FALSE);
	}

	$headers[] = array('inventory' => '', 'escape' => FALSE);
	$headers[] = array('stock' => '', 'escape' => FALSE);

	return transform_headers($headers);
}

/*
Get the html data row for the item
*/
function get_item_data_row($item)
{  
	$CI =& get_instance();

	if($CI->config->item('use_destination_based_tax') == '1')
	{
		if($item->tax_category_id == NULL)
		{
			$tax_percents = '-';
		}
		else
		{
			$tax_category_info = $CI->Tax_category->get_info($item->tax_category_id);
			$tax_percents = $tax_category_info->tax_category;
		}
	}
	else
	{
		$item_tax_info = $CI->Item_taxes->get_info($item->item_id);
		$tax_percents = '';
		foreach($item_tax_info as $tax_info)
		{
			$tax_percents .= to_tax_decimals($tax_info['percent']) . '%, ';
		}
		// remove ', ' from last item
		$tax_percents = substr($tax_percents, 0, -2);
		$tax_percents = !$tax_percents ? '-' : $tax_percents;
	}

	$controller_name = strtolower(get_class($CI));

	$image = NULL;
	if($item->pic_filename != '')
	{
		$ext = pathinfo($item->pic_filename, PATHINFO_EXTENSION);
		if($ext == '')
		{
			// legacy
			$images = glob('./uploads/item_pics/' . $item->pic_filename . '.*');
		}
		else
		{
			// preferred
			$images = glob('./uploads/item_pics/' . $item->pic_filename);
		}

		if(sizeof($images) > 0)
		{
			$image .= '<a class="rollover" href="'. base_url($images[0]) .'"><img src="'.site_url('items/pic_thumb/' . pathinfo($images[0], PATHINFO_BASENAME)) . '"></a>';
		}
	}

	if($CI->config->item('multi_pack_enabled') == '1')
	{
		$item->name .= NAME_SEPARATOR . $item->pack_name;
	}

	$definition_names = $CI->Attribute->get_definitions_by_flags(Attribute::SHOW_IN_ITEMS);

	// Get the commission percentage and format the commission price
	$commissionPercentage = $item->commission_percentage;
	$commissionPrice = to_currency($item->commission_price);

	// Combine the commission percentage and formatted commission price
	$commissionDisplay = $commissionPercentage . '% (' . $commissionPrice. ')';
	$columns = array (
		'items.item_id' => $item->item_id,
		'item_number' => $item->item_number,
		'name' => anchor($controller_name."/$item->item_id", $item->name),
		'batch_number' => $item->batch_number,
		'category' => $item->category,
		'company_name' => $item->company_name,
		'cost_price' => to_currency($item->cost_price),
		'unit_price' => to_currency($item->unit_price),
		// 'wholesale_price' => to_currency($item->wholesale_price),
		'quantity' => to_quantity_decimals($item->quantity),
		// 'commission_price' => $commissionDisplay,
		'tax_percents' => !$tax_percents ? '-' : $tax_percents,
		'item_pic' => $image
	);

	$icons = array(
		'inventory' => anchor($controller_name."/inventory/$item->item_id", '<span class="glyphicon glyphicon-pushpin"></span>',
			array('class' => 'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_count'))
		),
		'stock' => anchor($controller_name."/count_details/$item->item_id", '<span class="glyphicon glyphicon-list-alt"></span>',
			array('class' => 'modal-dlg', 'title' => $CI->lang->line($controller_name.'_details_count'))
		),
		// 'edit' => anchor($controller_name."/view/$item->item_id", '<span class="glyphicon glyphicon-edit"></span>',
		// 	array('class' => 'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		// )
		'edit' => anchor($controller_name."/view/$item->item_id", '<span class="glyphicon glyphicon-edit"></span>',
			// array('class' => 'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title' => $CI->lang->line($controller_name.'_update'))
		)
	);

	return $columns + expand_attribute_values($definition_names, (array) $item) + $icons;

}


/*
Get the header for the giftcard tabular view
*/
function get_giftcards_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('giftcard_id' => $CI->lang->line('common_id')),
		array('last_name' => $CI->lang->line('common_last_name')),
		array('first_name' => $CI->lang->line('common_first_name')),
		array('giftcard_number' => $CI->lang->line('giftcards_giftcard_number')),
		array('value' => $CI->lang->line('giftcards_card_value'))
	);

	return transform_headers($headers);
}

/*
Get the html data row for the giftcard
*/
function get_giftcard_data_row($giftcard)
{
	$CI =& get_instance();

	$controller_name=strtolower(get_class($CI));

	return array (
		'giftcard_id' => $giftcard->giftcard_id,
		'last_name' => $giftcard->last_name,
		'first_name' => $giftcard->first_name,
		'giftcard_number' => $giftcard->giftcard_number,
		'value' => to_currency($giftcard->value),
		'edit' => anchor($controller_name."/view/$giftcard->giftcard_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		)
	);
}

/*
Get the header for the item kits tabular view
*/
function get_item_kits_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('item_kit_id' => $CI->lang->line('item_kits_kit')),
		array('item_kit_number' => $CI->lang->line('item_kits_item_kit_number')),
		array('name' => $CI->lang->line('item_kits_name')),
		array('description' => $CI->lang->line('item_kits_description')),
		array('total_cost_price' => $CI->lang->line('items_cost_price'), 'sortable' => FALSE),
		array('total_unit_price' => $CI->lang->line('items_unit_price'), 'sortable' => FALSE)
	);

	return transform_headers($headers);
}

/*
Get the html data row for the item kit
*/
function get_item_kit_data_row($item_kit)
{
	$CI =& get_instance();

	$controller_name = strtolower(get_class($CI));

	return array (
		'item_kit_id' => $item_kit->item_kit_id,
		'item_kit_number' => $item_kit->item_kit_number,
		'name' => $item_kit->name,
		'description' => $item_kit->description,
		'total_cost_price' => to_currency($item_kit->total_cost_price),
		'total_unit_price' => to_currency($item_kit->total_unit_price),
		'edit' => anchor($controller_name."/view/$item_kit->item_kit_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		)
	);
}

function parse_attribute_values($columns, $row) {
	$attribute_values = array();
	foreach($columns as $column) {
		if (array_key_exists($column, $row))
		{
			$attribute_value = explode('|', $row[$column]);
			$attribute_values = array_merge($attribute_values, $attribute_value);
		}
	}
	return $attribute_values;
}

function expand_attribute_values($definition_names, $row)
{
	$values = parse_attribute_values(array('attribute_values', 'attribute_dtvalues', 'attribute_dvalues'), $row);

	$indexed_values = array();
	foreach($values as $attribute_value)
	{
		$exploded_value = explode('_', $attribute_value);
		if(sizeof($exploded_value) > 1)
		{
			$indexed_values[$exploded_value[0]] = $exploded_value[1];
		}
	}

	$attribute_values = array();
	foreach($definition_names as $definition_id => $definition_name)
	{
		if(isset($indexed_values[$definition_id]))
		{
			$attribute_value = $indexed_values[$definition_id];
			$attribute_values["$definition_id"] = $attribute_value;
		}
	}

	return $attribute_values;
}

function get_attribute_definition_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('definition_id' => $CI->lang->line('attributes_definition_id')),
		array('definition_name' => $CI->lang->line('attributes_definition_name')),
		array('definition_type' => $CI->lang->line('attributes_definition_type')),
		array('definition_flags' => $CI->lang->line('attributes_definition_flags')),
		array('definition_group' => $CI->lang->line('attributes_definition_group')),
	);

	return transform_headers($headers);
}

function get_attribute_definition_data_row($attribute)
{
	$CI =& get_instance();

	$controller_name = strtolower(get_class($CI));

	if(count($attribute->definition_flags) == 0)
	{
		$definition_flags = $CI->lang->line('common_none_selected_text');
	}
	else if($attribute->definition_type == GROUP)
	{
		$definition_flags = "-";
	}
	else
	{
		$definition_flags = implode(', ', $attribute->definition_flags);
	}

	return array (
		'definition_id' => $attribute->definition_id,
		'definition_name' => $attribute->definition_name,
		'definition_type' => $attribute->definition_type,
		'definition_group' => $attribute->definition_group,
		'definition_flags' => $definition_flags,
		'edit' => anchor("$controller_name/view/$attribute->definition_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		)
	);
}

/*
Get the header for the expense categories tabular view
*/
function get_expense_category_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('expense_category_id' => $CI->lang->line('expenses_categories_category_id')),
		array('category_name' => $CI->lang->line('expenses_categories_name')),
		array('category_description' => $CI->lang->line('expenses_categories_description'))
	);

	return transform_headers($headers);
}

/*
Gets the html data row for the expenses category
*/
function get_expense_category_data_row($expense_category)
{
	$CI =& get_instance();

	$controller_name = strtolower(get_class($CI));

	return array (
		'expense_category_id' => $expense_category->expense_category_id,
		'category_name' => $expense_category->category_name,
		'category_description' => $expense_category->category_description,
		'edit' => anchor($controller_name."/view/$expense_category->expense_category_id", '<span class="glyphicon glyphicon-edit"></span>',
			// array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		)
	);
}


/*
Get the header for the expenses tabular view
*/
function get_expenses_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('expense_id' => $CI->lang->line('expenses_expense_id')),
		array('date' => $CI->lang->line('expenses_date')),
		array('supplier_name' => $CI->lang->line('expenses_supplier_name')),
		array('supplier_tax_code' => $CI->lang->line('expenses_supplier_tax_code')),
		array('amount' => $CI->lang->line('expenses_amount')),
		array('tax_amount' => $CI->lang->line('expenses_tax_amount')),
		array('payment_type' => $CI->lang->line('expenses_payment')),
		array('category_name' => $CI->lang->line('expenses_categories_name')),
		array('description' => $CI->lang->line('expenses_description')),
		array('created_by' => $CI->lang->line('expenses_employee'))
	);

	return transform_headers($headers);
}

/*
Gets the html data row for the expenses
*/
function get_expenses_data_row($expense)
{
	$CI =& get_instance();

	$controller_name = strtolower(get_class($CI));

	return array (
		'expense_id' => $expense->expense_id,
		'date' => to_datetime(strtotime($expense->date)),
		'supplier_name' => $expense->supplier_name,
		'supplier_tax_code' => $expense->supplier_tax_code,
		'amount' => to_currency($expense->amount),
		'tax_amount' => to_currency($expense->tax_amount),
		'payment_type' => $expense->payment_type,
		'category_name' => $expense->category_name,
		'description' => $expense->description,
		'created_by' => $expense->first_name.' '. $expense->last_name,
		'edit' => anchor($controller_name."/view/$expense->expense_id", '<span class="glyphicon glyphicon-edit"></span>',
			array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		)
	);
}

/*
Get the html data last row for the expenses
*/
function get_expenses_data_last_row($expense)
{
	$CI =& get_instance();

	$table_data_rows = '';
	$sum_amount_expense = 0;
	$sum_tax_amount_expense = 0;

	foreach($expense->result() as $key=>$expense)
	{
		$sum_amount_expense += $expense->amount;
		$sum_tax_amount_expense += $expense->tax_amount;
	}

	return array(
		'expense_id' => '-',
		'date' => $CI->lang->line('sales_total'),
		'amount' => to_currency($sum_amount_expense),
		'tax_amount' => to_currency($sum_tax_amount_expense)
	);
}

/*
Get the expenses payments summary
*/
function get_expenses_manage_payments_summary($payments, $expenses)
{
	$CI =& get_instance();

	$table = '<div id="report_summary">';

	foreach($payments as $key=>$payment)
	{
		$amount = $payment['amount'];
		$table .= '<div class="summary_row">' . $payment['payment_type'] . ': ' . to_currency($amount) . '</div>';
	}

	$table .= '</div>';

	return $table;
}


/*
Get the header for the cashup tabular view
*/
function get_cashups_manage_table_headers()
{
	$CI =& get_instance();

	$headers = array(
		array('cashup_id' => $CI->lang->line('cashups_id')),
		array('open_date' => $CI->lang->line('cashups_opened_date')),
		array('open_employee_id' => $CI->lang->line('cashups_open_employee')),
		array('open_amount_cash' => $CI->lang->line('cashups_open_amount_cash')),
		array('transfer_amount_cash' => $CI->lang->line('cashups_transfer_amount_cash')),
		array('close_date' => $CI->lang->line('cashups_closed_date')),
		array('close_employee_id' => $CI->lang->line('cashups_close_employee')),
		array('closed_amount_cash' => $CI->lang->line('cashups_closed_amount_cash')),
		array('note' => $CI->lang->line('cashups_note')),
		array('closed_amount_due' => $CI->lang->line('cashups_closed_amount_due')),
		array('closed_amount_card' => $CI->lang->line('cashups_closed_amount_card')),
		array('closed_amount_check' => $CI->lang->line('cashups_closed_amount_check')),
		array('closed_amount_total' => $CI->lang->line('cashups_closed_amount_total'))
	);

	return transform_headers($headers);
}

/*
Gets the html data row for the cashups
*/
function get_cash_up_data_row($cash_up)
{
	$CI =& get_instance();

	$controller_name = strtolower(get_class($CI));

	return array (
		'cashup_id' => $cash_up->cashup_id,
		'open_date' => to_datetime(strtotime($cash_up->open_date)),
		'open_employee_id' => $cash_up->open_first_name . ' ' . $cash_up->open_last_name,
		'open_amount_cash' => to_currency($cash_up->open_amount_cash),
		'transfer_amount_cash' => to_currency($cash_up->transfer_amount_cash),
		'close_date' => to_datetime(strtotime($cash_up->close_date)),
		'close_employee_id' => $cash_up->close_first_name . ' ' . $cash_up->close_last_name,
		'closed_amount_cash' => to_currency($cash_up->closed_amount_cash),
		'note' => $cash_up->note ? $CI->lang->line('common_yes') : $CI->lang->line('common_no'),
		'closed_amount_due' => to_currency($cash_up->closed_amount_due),
		'closed_amount_card' => to_currency($cash_up->closed_amount_card),
		'closed_amount_check' => to_currency($cash_up->closed_amount_check),
		'closed_amount_total' => to_currency($cash_up->closed_amount_total),
		'edit' => anchor($controller_name."/view/$cash_up->cashup_id", '<span class="glyphicon glyphicon-edit"></span>',
			// array('class'=>'modal-dlg', 'data-btn-submit' => $CI->lang->line('common_submit'), 'title'=>$CI->lang->line($controller_name.'_update'))
		)
	);
}
?>
