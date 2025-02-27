<?php header("Cache-Control: public, max-age=31536000, immutable");?>
<!-- Main code with the color -->
<?php $this->load->view("partial/header");?>
<!-- NEw design css KH -->
<link rel="stylesheet" type="text/css" href="css/register_new_design.css" />
<?php
   if (isset($error)) {
       echo "<div class='alert alert-dismissible alert-danger custom-warning'>" . $error . "</div>";
   }
   if (!empty($warning)) {
       echo "<div class='alert alert-dismissible alert-warning custom-warning'>" . $warning . "</div>";
   }
   if (isset($success)) {
       echo "<div class='alert alert-dismissible alert-success custom-warning'>" . $success . "</div>";
   }
?>

<div class="register-page">
	<div id="register_wrapper" class="register-wrapper" style="width: 100%;">
		<div class="new_cust_design">
			<?php $tabindex = 0;?>
			<?php echo form_open($controller_name . "/add", array('id' => 'add_item_form', 'class' => 'form-horizontal panel panel-default align-center', 'style' => 'background-color: transparent;border:none; box-shadow: none;')); ?>
				<div class="panel-body form-group p-0">
					<ul>
						<li class="m-0">
							<h6 class="header-label item-name-label">Item Name</h6>
							<?php echo form_input(array('name' => 'item', 'id' => 'item', 'class' => 'form-control input-sm', 'size' => '50', 'tabindex' => ++$tabindex)); ?>
							<span class="ui-helper-hidden-accessible" role="status"></span>
						</li>
					</ul>
				</div>
			<?php echo form_close(); ?>
			<?php echo form_open($controller_name . "/change_mode", array('id' => 'mode_form', 'class' => 'form-horizontal panel panel-default', 'style' => 'width: 100%;background-color: transparent;')); ?>
				<div class="panel-body p-0">
					<ul id="register-page-header">
						<li>
							<h6 class="header-label"><?php echo $this->lang->line('sales_mode'); ?></h6>
							<?php echo form_dropdown('mode', $modes, $mode, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow header-dropdown', 'data-style' => 'btn-default btn-sm')); ?>
						</li>
						<?php if ($this->config->item('dinner_table_enable') == true) { ?>
						<li>
							<h6 class="header-label"><?php echo $this->lang->line('sales_table'); ?></h6>
							<?php echo form_dropdown('dinner_table', $empty_tables, $selected_table, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow header-dropdown', 'data-style' => 'btn-default btn-sm')); ?>
						</li>
						<?php } if (count($stock_locations) > 1) { ?>
						<li>
							<h6 class="header-label"><?php echo $this->lang->line('sales_stock_location'); ?></h6>
							<?php echo form_dropdown('stock_location', $stock_locations, $stock_location, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow header-dropdown', 'data-style' => 'btn-default btn-sm')); ?>
						</li>
						<?php } ?>

						<li>
							<div class="form-group m-0 align-end gap-2" id="select_customer">
								<?php if (isset($customer)) {?>
									<button style="border: none; padding: 7px 9px;" data-href="<?php echo base_url() . 'customers/view_modal/' . $customer_id ?>" data-btn-submit="<?php echo $this->lang->line('common_submit'); ?>" title="<?php echo $customer; ?>" class='btn btn-info btn-sm modal-dlg theme-color theme-transition-effect' id="customer_detail" style="margin-right: 5px;"> <span class="glyphicon glyphicon-user theme-transparent theme-transition-effect"></span> </button>
								<?php }?>
								<div>
									<h6 class="header-label customer-dropdown-label"><?php echo $this->lang->line('sales_select_customer'); ?></h6>
									<?php echo form_input(array('name' => 'customer', 'id' => 'customer', 'class' => 'form-control input-sm', 'value' => $customer, 'placeholder' => $this->lang->line('sales_start_typing_customer_name'))); ?>
								</div>
								<?php if (isset($customer)) { ?>
									<button style="border: none; padding: 7px 9px;" class='btn btn-info btn-sm theme-color theme-transition-effect' id="remove_customer_button" title="Remove Customer" style="margin-left: 5px;"> <span class="glyphicon glyphicon-remove theme-transparent theme-transition-effect"></span> </button>
								<?php }?>
								<?php if (!isset($customer)) {?>
								<button class='btn btn-info btn-sm modal-dlg theme-color theme-transition-effect' style="border: none; padding: 7px 9px;" data-btn-submit="<?php echo $this->lang->line('common_submit') ?>" data-href="<?php echo site_url("customers/view_modal"); ?>" title="<?php echo $this->lang->line($controller_name . '_new_customer'); ?>"> 
									<span class="glyphicon glyphicon-plus theme-transparent theme-transition-effect"></span>
								</button>
								<?php }?>
							</div>
						</li>
						<?php if ($this->Employee->has_grant('reports_sales', $this->session->userdata('person_id'))) { ?>
						<li>
							<div class="m-0 align-end gap-2">
								<button class='btn btn-default btn-sm modal-dlg theme-color theme-transition-effect' style="border: none; padding: 7px 9px;" id='show_suspended_sales_button' data-href="<?php echo site_url($controller_name . "/suspended"); ?>"
								title="<?php echo $this->lang->line('sales_suspended_sales'); ?>">
									<span class="glyphicon glyphicon-align-justify theme-transparent theme-transition-effect">&nbsp</span><?php echo $this->lang->line('sales_suspended_sales'); ?>
								</button>
								<?php echo anchor($controller_name . "/manage", '<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'),
								array('class' => 'btn btn-primary btn-sm theme-color theme-transition-effect', 'id' => 'sales_takings_button', 'style' => 'border: none; padding: 7px 9px;', 'title' => $this->lang->line('sales_takings'))); ?>
							
								<button class='btn btn-default btn-sm modal-dlg theme-color theme-transition-effect' style="border: none; padding: 7px 9px;" id='show_keyboard_help' data-href="<?php echo site_url("$controller_name/sales_keyboard_help"); ?>" title="<?php echo $this->lang->line('sales_key_title'); ?>">
									<span class="glyphicon glyphicon-share-alt theme-transparent theme-transition-effect"></span>
								</button>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			<?php echo form_close(); ?>
		</div>
		<!-- Sale Items List -->
		<div class="table-custom-height">
			<table class="sales_table_100" id="register">
				<thead>
					<tr>
						<th style="width: 5%;" class="theme-color">#</th>
						<th style="width: 6%;" class="theme-color">Itemcode<?php //echo $this->lang->line('sales_item_number'); ?></th>
						<th style="width: 20%" class="theme-color">Product<?php //echo $this->lang->line('sales_item_name'); ?></th>
						<th style="width: 10%;" class="theme-color">QTY<?php //echo $this->lang->line('sales_quantity'); ?></th>
						<th style="width: 10%;" class="theme-color">MRP<?php //echo $this->lang->line('sales_price'); ?></th>
						<th style="width: 13%;" class="theme-color">Discount<?php //echo $this->lang->line('sales_discount'); ?></th>
						<th style="width: 7%;" class="theme-color">Unit Cost</th>
						<th style="width: 7%;" class="theme-color net-amount-width">Net Amount<?php //echo $this->lang->line('sales_total'); ?></th>
						<th style="width: 2%" class="theme-color"><?php echo $this->lang->line('common_delete'); ?></th>
					</tr>
				</thead>
				<tbody id="cart_contents">
					<?php if (count($cart) == 0) { ?>
					<tr>
						<td colspan='12' class="empty-table-padding" <?php echo $cell_style; ?>>
							<div class='alert alert-dismissible alert-info theme-color' style="border: none"><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
						</td>
					</tr>
					<?php } else {
						foreach (array_reverse($cart, true) as $line => $item) {
							// Check the condition to determine the row color - for loss in item
							$cell_style = '';
							if ($item['discounted_total'] - $item['cost_price'] < 0) {
								$cell_style = 'style="background-color: #f080807a;"';
							}
					?>
					<?php echo form_open($controller_name . "/edit_item/$line", array('class' => 'form-horizontal', 'id' => 'cart_' . $line)); ?>
					<tr>
						<td <?php echo $cell_style; ?>>
							<span class="glyphicon glyphicon-user"></span>
						</td>
						<?php if ($item['item_type'] == ITEM_TEMP) { ?>
						<td <?php echo $cell_style; ?>><?php echo form_input(array('name' => 'item_number', 'id' => 'item_number', 'class' => 'form-control input-sm', 'value' => $item['item_number'], 'tabindex' => ++$tabindex)); ?></td>
						<td <?php echo $cell_style; ?>style="align: center;">
						<?php echo form_input(array('name' => 'name', 'id' => 'name', 'class' => 'form-control input-sm', 'value' => $item['name'], 'tabindex' => ++$tabindex)); ?>
						</td>
						<?php } else { ?>
						<td <?php echo $cell_style; ?>><?php echo $item['item_number']; ?></td>
						<td <?php echo $cell_style; ?>style="align: center;">
						<?php echo $item['name'] . ' ' . implode(' ', array($item['attribute_values'], $item['attribute_dtvalues'])); ?>
						<br />
						<?php if ($item['stock_type'] == '0'): echo '[' . to_quantity_decimals($item['in_stock']) . ' in ' . $item['stock_name'] . ']';
							endif;?>
						</td>
						<?php } ?>
						<td class="qty-cell" <?php echo $cell_style; ?>>
							<button type="button" class='btn btn-default btn-sm theme-color table-qty-button' id='minus_order' onClick="change_qty(<?php echo $line; ?>,'minus')"> <span class="glyphicon glyphicon-minus theme-transparent"></span> </button>
						<?php
							if ($item['is_serialized']) {
									//echo to_quantity_decimals($item['quantity']);
									echo form_hidden('quantity', $item['quantity']);
									echo form_input(array('name' => 'quantity', 'id' => 'quantity_'.$line, 'class' => 'form-control input-sm custom-input-height', 'value' => (float) $item['quantity'], 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
								} else {
									echo form_input(array('name' => 'quantity', 'id' => 'quantity_'.$line, 'class' => 'form-control input-sm custom-input-height', 'value' => (float) $item['quantity'], 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
								}
							?>
							<button type="button" class='btn btn-default btn-sm theme-color table-qty-button' style="margin-left: 2px;" id='plus_order' onClick='change_qty(<?php echo $line; ?>,"plus");'> <span class="glyphicon glyphicon-plus theme-transparent"></span> </button>
						</td>
						<td <?php echo $cell_style; ?>>
						<?php
							if ($items_module_allowed && $change_price) {
									echo form_input(array('name' => 'price', 'class' => 'form-control input-sm custom-input-height', 'value' => to_currency_no_money($item['price']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
								} else {
									echo to_currency($item['price']);
									echo form_hidden('price', to_currency_no_money($item['price']));
								}
							?>
						</td>
						<td <?php echo $cell_style; ?>>
						<div class="input-group">
								<span class="input-group-btn custom-discount-toggle-container">
									<?php echo form_checkbox(array('id' => 'discount_toggle', 'name' => 'discount_toggle', 'value' => 1, 'data-toggle' => "toggle", 'data-size' => 'small', 'data-onstyle' => 'success', 'data-on' => '<b>' . $this->config->item('currency_symbol') . '</b>', 'data-off' => '<b>%</b>', 'data-line' => $line, 'checked' => $item['discount_type'])); ?>
								</span>
								<?php echo form_input(array('name' => 'discount', 'class' => 'form-control input-sm custom-input-height', 'value' => $item['discount_type'] ? to_currency_no_money($item['discount']) : to_decimals($item['discount']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?>
						</div>
						</td>
						<td <?php echo $cell_style; ?>>
						<?php
							if ($item['item_type'] == ITEM_AMOUNT_ENTRY) {
									echo form_input(array('name' => 'discounted_total', 'class' => 'form-control input-sm', 'value' => to_currency_no_money($item['discounted_total']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
								} else {
									echo to_currency($item['discounted_total']);
								}
							?>
						</td>
						<td <?php echo $cell_style; ?>>
						<span style="margin-right: 15px;"><?php echo $item['discounted_total']; ?></span>
						<?php
								echo form_hidden('location', $item['item_location']);
								echo form_input(array('type' => 'hidden', 'name' => 'item_id', 'value' => $item['item_id']));
								echo form_input(array('type' => 'hidden', 'name' => 'batch_number', 'value' => $item['batch_number'])); // Hidden input for batch_number
							?>
						</td>
						<td class="cursor-pointer" <?php echo $cell_style; ?>><span data-item-id="<?php echo $line; ?>" class="delete_item_button"><span class="glyphicon glyphicon-trash"></span></span></td>
					</tr>
					<!-- <tr>
					<?php if ($item['item_type'] == ITEM_TEMP) { ?>
						<td <?php echo $cell_style; ?>><?php echo form_input(array('type' => 'hidden', 'name' => 'item_id', 'value' => $item['item_id'])); ?></td>
						<td <?php echo $cell_style; ?>style="align: center;" colspan="6">
						<?php echo form_input(array('name' => 'item_description', 'id' => 'item_description', 'class' => 'form-control input-sm', 'value' => $item['description'], 'tabindex' => ++$tabindex)); ?>
						</td>
						<td <?php echo $cell_style; ?>> </td>
						<?php } else { ?>
						<td <?php echo $cell_style; ?>> </td>
						<?php if ($item['allow_alt_description']) { ?>
						<td <?php echo $cell_style; ?>style="color: #2F4F4F;"><?php echo $this->lang->line('sales_description_abbrv'); ?></td>
						<?php } ?>
						<td <?php echo $cell_style; ?>colspan='2' style="text-align: left;">
						<?php
							if ($item['allow_alt_description']) {
									echo form_input(array('name' => 'description', 'class' => 'form-control input-sm', 'value' => $item['description'], 'onClick' => 'this.select();'));
								} else {
									if ($item['description'] != '') {
										echo $item['description'];
										echo form_hidden('description', $item['description']);
									} else {
										echo $this->lang->line('sales_no_description');
										echo form_hidden('description', '');
									}
								}
							?>
						</td>
						<td <?php echo $cell_style; ?>>&nbsp;</td>
						<td <?php echo $cell_style; ?>style="color: #2F4F4F;">
						<?php
							if ($item['is_serialized']) {
									echo $this->lang->line('sales_serial');
								}
							?>
						</td>
						<td <?php echo $cell_style; ?>colspan='4' style="text-align: left;">
						<?php
							if ($item['is_serialized']) {
									echo form_input(array('name' => 'serialnumber', 'class' => 'form-control input-sm', 'value' => $item['serialnumber'], 'onClick' => 'this.select();'));
								} else {
									echo form_hidden('serialnumber', '');
								}
							?>
						</td>
						<?php } ?>
					</tr> -->
					<?php echo form_close(); ?>
					<?php } } ?>
				</tbody>
			</table>
		</div>
		<!-- hitesh -->
		<div class="footer-container">
			<div class="row footer-top">
				<div class="col-md-1 text-center footer-top-column">
					<div><?php echo $total_units; ?></div>
					<div style="font-weight: 800; font-size: 12px;"> Quantity </div>
				</div>
				<div class="col-md-1 text-center footer-top-column">
					<div><?php echo to_currency($subtotal); ?></div>
					<div style="font-weight: 800; font-size: 12px;">Price</div>
				</div>
				<div class="col-md-1 text-center footer-top-column">
					<?php
					$discount = "";
					$discounted_total = $item['discounted_total'] ? $item['discounted_total'] : "";
					$final_total = $item['total'] ? $item['total'] : "";
					$discount = ((floor($final_total * 100) - floor($discounted_total * 100)) / 100);
					?>
					<div><?php echo to_currency($discount ? $discount : "0"); ?></div>
					<div style="font-weight: 800; font-size: 12px;">Discount</div>
				</div>
				<div class="col-md-2 text-center footer-top-column" style="overflow-y: scroll;">
					<div>
					<?php foreach ($taxes as $tax_group_index => $tax) { ?>
					<div style="display: flex;">
						<div><?php echo (float) $tax['tax_rate'] . '% ' . $tax['tax_group']; ?></div>
						<div style="width:5px;"></div>
						<div class="margin-left: 4px;"><?php echo to_currency_tax($tax['sale_tax_amount']); ?></div>
					</div>
					<?php } ?>
					</div>
					<div style="font-weight: 800; font-size: 12px;">Tax</div>
				</div>
				<div class="col-md-2 theme-text-color footer-top-column" style="text-align: right">
					<input type="hidden" name="total_amount" id="total_amount" value="<?php echo $total; ?>" />
					<div class="footer-top-column-total"><?php echo to_currency($total); ?></div>
					<div class="footer-top-column-header"><?php echo $this->lang->line('sales_total'); ?></div>
				</div>

				<div class="col-md-5 comment-outer-container">
					<div class="no-gutter" id="footer-comment-container" style="width: 210px;">
						<div class="form-group form-group-sm">
						<div class="col-xs-12">
							<?php echo form_textarea(array('name' => 'comment', 'id' => 'comment', 'placeholder'=>'Comments here...', 'class' => 'form-control input-sm fix-commentbox-width comment-textarea', 'value' => $comment, 'rows' => '2')); ?>
						</div>
						</div>
					</div>
					<?php
						if (($mode == 'sale_invoice') && $this->config->item('invoice_enable') == true) {
						?>
					<div style="margin-left: 60px;">
						<div>
							<label for="sales_invoice_number" class="control-label checkbox footer-checkbox-label">
							<?php echo $this->lang->line('sales_invoice_enable'); ?>
							</label>
						</div>
						<div>
							<div class="input-group input-group-sm">
								<span class="input-group-addon input-sm">#</span>
								<?php echo form_input(array('name' => 'sales_invoice_number', 'id' => 'sales_invoice_number', 'class' => 'form-control input-sm', 'style' => 'width: 70px;', 'value' => $invoice_number)); ?>
							</div>
						</div>
						</div>
					<?php
						}
						?>
					<div style="margin-left: 30px;">
						<div>
						<div>
							<label for="sales_print_after_sale" class="control-label checkbox footer-checkbox-label">
							<?php echo form_checkbox(array('name' => 'sales_print_after_sale', 'id' => 'sales_print_after_sale', 'value' => 1, 'checked' => $print_after_sale)); ?>
							<?php echo $this->lang->line('sales_print_after_sale') ?>
							</label>
						</div>
						<?php
							if (!empty($customer_phone_number)) {
										?>
						<div>
							<label for="email_receipt" class="control-label checkbox footer-checkbox-label">
							<?php echo form_checkbox(array('name' => 'email_receipt', 'id' => 'email_receipt', 'value' => 1, 'checked' => $email_receipt)); ?>
							<?php echo $this->lang->line('sales_email_receipt'); ?>
							</label>
						</div>
						<?php
							}
									?>
						<?php
							if ($mode == 'sale_work_order') {
										?>
						<div>
							<label for="price_work_orders" class="control-label checkbox">
							<?php echo form_checkbox(array('name' => 'price_work_orders', 'id' => 'price_work_orders', 'value' => 1, 'checked' => $price_work_orders)); ?>
							<?php echo $this->lang->line('sales_include_prices'); ?>
							</label>
						</div>
						<?php
							}
									?>
						</div>
					</div>
					<div style="margin-left: 30px;">
						<button class="theme-color theme-transition-effect comment-box-button" type="button" onclick="window.location.href='<?php echo site_url('sales/print_token'); ?>'">
							<span class="glyphicon glyphicon-ok" style="padding-right:5px"></span>Quote
						</button>
						<button class="theme-color theme-transition-effect comment-box-button" type="button" onclick="window.location.href='<?php echo site_url('sales/print_token'); ?>'">
							<span class="glyphicon glyphicon-share" style="padding-right:5px"></span>Generate Token
						</button>
					</div>
				</div>

			</div>
			<div class="d-flex footer-bottom">
				<button onclick="selectPaymentMethod();" id='new_payment_button_cash' class='modal-payment text-center payment-buttons theme-color theme-transition-effect readonly' data-btn-normal="<?php echo $this->lang->line('common_submit') ?>" data-btn-cancel="<?php echo $this->lang->line('common_cancel') ?>" data-href="<?php echo site_url("items/view_payment"); ?>" data-value="cash" data-controller="<?php echo site_url($controller_name . '/complete'); ?>" title="Cash">
					<span class="glyphicon glyphicon-credit-card pr-5"></span>Cash
				</button>
				<button onclick="selectPaymentMethod();" id='new_payment_upi' class='modal-payment text-center payment-buttons theme-color theme-transition-effect readonly' data-btn-normal="<?php echo $this->lang->line('common_submit') ?>" data-btn-cancel="<?php echo $this->lang->line('common_cancel') ?>" data-href="<?php echo site_url("items/view_payment"); ?>" data-value="upi" data-controller="<?php echo site_url($controller_name . '/complete'); ?>" title="UPI">
					<span class="glyphicon glyphicon-credit-card pr-5"></span>UPI
				</button>
				<button onclick="selectPaymentMethod();" id='new_payment_button' class='modal-payment text-center payment-buttons theme-color theme-transition-effect readonly' data-btn-normal="<?php echo $this->lang->line('common_submit') ?>" data-btn-cancel="<?php echo $this->lang->line('common_cancel') ?>" data-href="<?php echo site_url("items/view_payment"); ?>" data-value="due" data-controller="<?php echo site_url($controller_name . '/complete'); ?>" title="Due">
					<span class="glyphicon glyphicon-credit-card pr-5"></span>Due
				</button>
				<button onclick="selectPaymentMethod();" id='multiple_payment_button' class='text-center payment-buttons theme-color theme-transition-effect readonly' data-btn-normal="<?php echo $this->lang->line('common_submit') ?>" data-btn-cancel="<?php echo $this->lang->line('common_cancel') ?>" data-href="<?php echo site_url("items/view_payment"); ?>" data-controller="<?php echo site_url($controller_name . '/complete'); ?>" data-value="multiple_payment" title="Multiple Payment">
					<span class="glyphicon glyphicon-credit-card pr-5"></span>Multiple Payment
				</button>
				<button onclick="selectPaymentMethod();" id='suspend_sale_button' class='text-center payment-buttons theme-color theme-transition-effect readonly' title="<?php echo $this->lang->line('sales_suspend_sale'); ?>">
					<span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspend_sale'); ?>
				</button>
			</div>
		</div>
		<!-- hitesh  -->			
	</div>

	<div id="items-image-wrapper" class="product_togle">
    <div id="items-image-selector">
        <ul>
            <!-- Static "All" category -->
            <li class="active category-item-class" id="item-all" onclick="selectCategory('item-all'); selectAllItem()">All</li>
            
            <!-- Dynamically generated categories -->
            <?php foreach ($grouped_data as $index => $group): ?>
                <?php 
                    // Create a unique ID for the category
                    $category_id = strtolower(str_replace(' ', '-', $group['category'])); 
                ?>
                <li 
                    id="item-<?php echo $category_id; ?>" 
                    class="category-item-class" 
                    onclick="selectCategory('item-<?php echo $category_id; ?>'); selectCategoryId(<?php echo $index; ?>)">
                    <?php echo htmlspecialchars($group['category']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="items-image-container-wrapper">
        <div id="selected-category" class="capitalize-text">All</div>
        <div id="items-image-container" class="items-image-container-class">
            <div class="item-image-box">        
            </div>
        </div>
    </div>
</div>
</div>

<!-- Overall Sale -->
<div id="overall_sale" class="panel panel-default hidden">
   <div class="panel-body">
      <?php echo form_open($controller_name . "/select_customer", array('id' => 'select_customer_form', 'class' => 'form-horizontal')); ?>
      <?php if (isset($customer)) { ?>
      <table class="sales_table_100">
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("sales_customer"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo anchor('customers/view/' . $customer_id, $customer, array('class' => 'modal-dlg', 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('customers_update'))); ?></th>
         </tr>
         <?php
            if (!empty($customer_email)) {
                    ?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("sales_customer_email"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo $customer_email; ?></th>
         </tr>
         <?php
            }
                ?>
         <?php
            if (!empty($customer_address)) {
                    ?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("sales_customer_address"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo $customer_address; ?></th>
         </tr>
         <?php
            }
                ?>
         <?php
            if (!empty($customer_location)) {
                    ?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("sales_customer_location"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo $customer_location; ?></th>
         </tr>
         <?php
            }
                ?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("sales_customer_discount"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo ($customer_discount_type == FIXED) ? to_currency($customer_discount) : $customer_discount . '%'; ?></th>
         </tr>
         <?php if ($this->config->item('customer_reward_enable') == true): ?>
         <?php
            if (!empty($customer_rewards)) {
                    ?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("rewards_package"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo $customer_rewards['package_name']; ?></th>
         </tr>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("customers_available_points"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo $customer_rewards['points']; ?></th>
         </tr>
         <?php
            }
                ?>
         <?php endif;?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("sales_customer_total"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo to_currency($customer_total); ?></th>
         </tr>
         <?php
            if (!empty($mailchimp_info)) {
                    ?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line("sales_customer_mailchimp_status"); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo $mailchimp_info['status']; ?></th>
         </tr>
         <?php
            }
                ?>
      </table>
      <button class="btn btn-danger btn-sm" id="remove_customer_button" title="<?php echo $this->lang->line('common_remove') . ' ' . $this->lang->line('customers_customer') ?>">
      <span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('common_remove') . ' ' . $this->lang->line('customers_customer') ?>
      </button>
      <?php
         } else {
             ?>
			<div class="form-group" id="select_customer">
				<label id="customer_label" for="customer" class="control-label" style="margin-bottom: 1em; margin-top: -1em;"><?php echo $this->lang->line('sales_select_customer') . ' ' . $customer_required; ?></label>
				<?php echo form_input(array('name' => 'customer', 'id' => 'customer', 'class' => 'form-control input-sm custom_select_customer', 'value' => $this->lang->line('sales_start_typing_customer_name'))); ?>
				<button class='btn btn-info btn-sm modal-dlg' data-btn-submit="<?php echo $this->lang->line('common_submit') ?>" data-href="<?php echo site_url("customers/view"); ?>"
					title="<?php echo $this->lang->line($controller_name . '_new_customer'); ?>">
				<span class="glyphicon glyphicon-user">&nbsp</span><?php echo $this->lang->line($controller_name . '_new_customer'); ?>
				</button>
				<button class='btn btn-default btn-sm modal-dlg' id='show_keyboard_help' data-href="<?php echo site_url("$controller_name/sales_keyboard_help"); ?>"
					title="<?php echo $this->lang->line('sales_key_title'); ?>">
				<span class="glyphicon glyphicon-share-alt">&nbsp</span><?php echo $this->lang->line('sales_key_help'); ?>
				</button>
			</div>
      <?php
         }
         ?>
      <?php echo form_close(); ?>
      <table class="sales_table_100" id="sale_totals">
         <?php if (count($cart) !== 0) {?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line('sales_total_mrp'); ?></th>
            <th style="width: 45%; text-align: right;">
               <?php
                  $total_mrp = 0; // Initialize total_mrp
                      foreach ($cart as $item) {
                          // Accumulate total MRP
                          $total_mrp += $item['price'] * $item['quantity'];
                      }
                      echo to_currency($total_mrp);
                      ?>
            </th>
         </tr>
         <?php }?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line('sales_quantity_of_items', $item_count); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo $total_units; ?></th>
         </tr>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line('sales_sub_total'); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo to_currency($subtotal); ?></th>
         </tr>
         <?php
            foreach ($taxes as $tax_group_index => $tax) {
                ?>
         <tr>
            <th style="width: 55%;"><?php echo (float) $tax['tax_rate'] . '% ' . $tax['tax_group']; ?></th>
            <th style="width: 45%; text-align: right;"><?php echo to_currency_tax($tax['sale_tax_amount']); ?></th>
         </tr>
         <?php
            }
            if (count($cart) !== 0) {
                ?>
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line('sales_total_discount'); ?></th>
            <th style="width: 45%; text-align: right;">
               <?php
                  $total_discount = 0; // Initialize total_discount
                      foreach ($cart as $item) {
                          // Calculate original total and disocunt
                          $original_total = $item['price'] * $item['quantity'];
                          $discount_amount = $original_total - $item['discounted_total'];
                          // Accumulate total discount
                          $total_discount += $discount_amount;
                      }
                      echo to_currency($total_discount);
                      ?>
            </th>
         </tr>
         <?php
            }?>
         <tr>
            <th style="width: 55%; font-size: 150%"><?php echo $this->lang->line('sales_total'); ?></th>
            <th style="width: 45%; font-size: 150%; text-align: right;"><span id="sale_total"><?php echo to_currency($total); ?></span></th>
         </tr>
      </table>
      <?php
         // Only show this part if there are Items already in the register
         if (count($cart) > 0) {
             ?>
      <table class="sales_table_100" id="payment_totals">
         <tr>
            <th style="width: 55%;"><?php echo $this->lang->line('sales_payments_total'); ?></th>
            <th style="width: 45%; text-align: right;"><?php echo to_currency($payments_total); ?></th>
         </tr>
         <tr>
            <th style="width: 55%; font-size: 120%"><?php echo $this->lang->line('sales_amount_due'); ?></th>
            <th style="width: 45%; font-size: 120%; text-align: right;"><span id="sale_amount_due"><?php echo to_currency($amount_due); ?></span></th>
         </tr>
      </table>
      <div id="payment_details">
         <?php
            // Show Complete sale button instead of Add Payment if there is no amount due left
                if ($payments_cover_total) {
                    ?>
         <?php echo form_open($controller_name . "/add_payment", array('id' => 'add_payment_form', 'class' => 'form-horizontal')); ?>
         <table class="sales_table_100">
            <tr>
               <td><?php echo $this->lang->line('sales_payment'); ?></td>
               <td>
                  <?php echo form_dropdown('payment_type', $payment_options, $selected_payment_type, array('id' => 'payment_types', 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'btn-default btn-sm', 'data-width' => 'fit', 'disabled' => 'disabled')); ?>
               </td>
            </tr>
            <tr>
               <td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>
               <td>
                  <?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'class' => 'form-control input-sm disabled', 'disabled' => 'disabled', 'value' => '0', 'size' => '5', 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?>
               </td>
            </tr>
         </table>
         <?php echo form_close(); ?>
         <?php
            // Only show this part if in sale or return mode
                    if ($pos_mode) {
                        $due_payment = false;
                        if (count($payments) > 0) {
                            foreach ($payments as $payment_id => $payment) {
                                if ($payment['payment_type'] == $this->lang->line('sales_due')) {
                                    $due_payment = true;
                                }
                            }
                        }
                        if (!$due_payment || ($due_payment && isset($customer))) {
                            ?>
         <div class='btn btn-sm btn-success pull-right' id='finish_sale_button' tabindex="<?php echo ++$tabindex; ?>"><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div>
         <?php
            }
                    }
                    ?>
         <?php
            } else {
                    ?>
         <?php echo form_open($controller_name . "/add_payment", array('id' => 'add_payment_form', 'class' => 'form-horizontal')); ?>
         <table class="sales_table_100">
            <tr>
               <td><?php echo $this->lang->line('sales_payment'); ?></td>
               <td>
                  <?php echo form_dropdown('payment_type', $payment_options, $selected_payment_type, array('id' => 'payment_types', 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'btn-default btn-sm', 'data-width' => 'fit')); ?>
               </td>
            </tr>
            <tr>
               <td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>
               <td>
                  <?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'class' => 'form-control input-sm non-giftcard-input', 'value' => to_currency_no_money($amount_due), 'size' => '5', 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?>
                  <?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'class' => 'form-control input-sm giftcard-input', 'disabled' => true, 'value' => to_currency_no_money($amount_due), 'size' => '5', 'tabindex' => ++$tabindex)); ?>
               </td>
            </tr>
         </table>
         <?php echo form_close(); ?>
         <div class='btn btn-sm btn-success pull-right' id='add_payment_button' tabindex="<?php echo ++$tabindex; ?>"><span class="glyphicon glyphicon-credit-card">&nbsp</span><?php echo $this->lang->line('sales_add_payment'); ?></div>
         <?php
            }
                ?>
         <?php
            // Only show this part if there is at least one payment entered.
                if (count($payments) > 0) {
                    ?>
         <table class="sales_table_100" id="register">
            <thead>
               <tr>
                  <th style="width: 10%;"><?php echo $this->lang->line('common_delete'); ?></th>
                  <th style="width: 60%;"><?php echo $this->lang->line('sales_payment_type'); ?></th>
                  <th style="width: 20%;"><?php echo $this->lang->line('sales_payment_amount'); ?></th>
               </tr>
            </thead>
            <tbody id="payment_contents">
               <?php
                  foreach ($payments as $payment_id => $payment) {
                              ?>
               <tr>
                  <td><span data-payment-id="<?php echo $payment_id; ?>" class="delete_payment_button"><span class="glyphicon glyphicon-trash"></span></span></td>
                  <td><?php echo $payment['payment_type']; ?></td>
                  <td style="text-align: right;"><?php echo to_currency($payment['payment_amount']); ?></td>
               </tr>
               <?php
                  }
                          ?>
            </tbody>
         </table>
         <?php
            }
                ?>
      </div>

      <?php echo form_open($controller_name . "/cancel", array('id' => 'buttons_form')); ?>
      <div class="form-group" id="buttons_sale">
         <div class='btn btn-sm btn-default pull-left' id='suspend_sale_button'><span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspend_sale'); ?></div>
         <?php
            // Only show this part if the payment covers the total
                if (!$pos_mode && isset($customer)) {
                    ?>
         <div class='btn btn-sm btn-success' id='finish_invoice_quote_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $mode_label; ?></div>
         <?php
            }
                ?>
         <div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>
      </div>
      <?php echo form_close(); ?>
      <?php
         // Only show this part if the payment cover the total
             if ($payments_cover_total || !$pos_mode) {
                 ?>
      <div class="container-fluid">
         <div class="no-gutter row">
            <div class="form-group form-group-sm">
               <div class="col-xs-12">
                  <?php echo form_label($this->lang->line('common_comments'), 'comments', array('class' => 'control-label', 'id' => 'comment_label', 'for' => 'comment')); ?>
                  <?php echo form_textarea(array('name' => 'comment', 'id' => 'comment', 'class' => 'form-control input-sm', 'value' => $comment, 'rows' => '2')); ?>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="form-group form-group-sm  m-0">
               <div class="col-xs-6">
                  <label for="sales_print_after_sale" class="control-label checkbox">
                  <?php echo form_checkbox(array('name' => 'sales_print_after_sale', 'id' => 'sales_print_after_sale', 'value' => 1, 'checked' => $print_after_sale)); ?>
                  <?php echo $this->lang->line('sales_print_after_sale') ?>
                  </label>
               </div>
               <?php
                  if (!empty($customer_phone_number)) {
                              ?>
               <div class="col-xs-6">
                  <label for="email_receipt" class="control-label checkbox">
                  <?php echo form_checkbox(array('name' => 'email_receipt', 'id' => 'email_receipt', 'value' => 1, 'checked' => $email_receipt)); ?>
                  <?php echo $this->lang->line('sales_email_receipt'); ?>
                  </label>
               </div>
               <?php
                  }
                          ?>
               <?php
                  if ($mode == 'sale_work_order') {
                              ?>
               <div class="col-xs-6">
                  <label for="price_work_orders" class="control-label checkbox">
                  <?php echo form_checkbox(array('name' => 'price_work_orders', 'id' => 'price_work_orders', 'value' => 1, 'checked' => $price_work_orders)); ?>
                  <?php echo $this->lang->line('sales_include_prices'); ?>
                  </label>
               </div>
               <?php
                  }
                          ?>
            </div>
         </div>
         <?php
            if (($mode == 'sale_invoice') && $this->config->item('invoice_enable') == true) {
                        ?>
         <div class="row">
            <div class="form-group form-group-sm">
               <div class="col-xs-6">
                  <label for="sales_invoice_number" class="control-label checkbox">
                  <?php echo $this->lang->line('sales_invoice_enable'); ?>
                  </label>
               </div>
               <div class="col-xs-6">
                  <div class="input-group input-group-sm">
                     <span class="input-group-addon input-sm">#</span>
                     <?php echo form_input(array('name' => 'sales_invoice_number', 'id' => 'sales_invoice_number', 'class' => 'form-control input-sm', 'value' => $invoice_number)); ?>
                  </div>
               </div>
            </div>
         </div>
         <?php
            }
          ?>
      </div>
      <?php
         }
             ?>
      <!-- Adding token button to generate the token -->
      <button type="button" onclick="window.location.href='<?php echo site_url('sales/print_token'); ?>'" class="btn btn-primary">
      Generate Token
      </button>
      <?php
         }
         ?>
   </div>
</div>

<!-- Modal added by kevin-->
<div class="modal fade" id="multiplePaymentDetail" tabindex="-1" role="dialog" aria-labelledby="multiplePaymentDetail" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered multiple-payment-modal" role="document">
    <div class="modal-content">
      <div class="modal-header multiple-payment-header">
        <h5 class="modal-title multiple-payment-modal-title" id="multiplePaymentDetailTitle">Payment List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<table class="sales_table_100 mt-25" id="register">
			<thead>
				<tr>
					<th style="width: 40%;" class="payment-list-table-header"><?php echo $this->lang->line('sales_payment_type'); ?></th>
					<th style="width: 56%;" class="payment-list-table-header"><?php echo $this->lang->line('sales_payment_amount'); ?></th>
					<th style="width: 4%;"  class="payment-list-table-header"></th>
				</tr>
			</thead>
			<tbody id="payment_contents">
				<?php foreach ($payments as $payment_id => $payment) {?>
					<tr>
						<input type="hidden" name="payment_list_id" id="payment_list_id" value="<?php echo $payment_id; ?>" />
						<td class="payment-list-table-content"><?php echo $payment['payment_type']; ?></td>
						<td class="payment-list-table-content"><?php echo to_currency($payment['payment_amount']); ?></td>
						<td class="payment-list-table-content"><span data-payment-id="<?php echo $payment_id; ?>" class="delete_payment_button text-danger cursor-pointer"><span class="glyphicon glyphicon-remove"></span></span></td>
					</tr>
				<?php }?>
			</tbody>
			<span class="payment-warning"><strong>Note: If you pay remaining payment please choose below mentioned option.</strong></span>
		</table>
		<div style="display: flex; gap: 1%;">
			<button class="cancel w-100 payment-list-cancel-button" data-dismiss="modal">Cancel</button>
			<?php if ($amount_due != "0.0000") {?>
			<button class="submit payment-list-submit-button" id="add_payment">Add More Payment</button>
			<?php } else {?>
				<button class="submit payment-list-submit-button" id="confirm_payment" onclick="return BootstrapDialog.closeAll();">Confirm Payment</button>
			<?php }?>
		</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="multiplePayment" tabindex="-1" role="dialog" aria-labelledby="multiplePayment" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered multiple-payment-final-modal" role="document">
    <div class="modal-content w-full">
      <div class="modal-header multiple-payment-header">
        <h5 class="modal-title multiple-payment-modal-title" id="multiplePaymentDetailTitle">Multiple Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<!-- <table class="sales_table_100 mt-25" id="register">
			<thead>
				<tr>
					<th style="width: 40%;" class="payment-list-table-header"><?php echo $this->lang->line('sales_payment_type'); ?></th>
					<th style="width: 56%;" class="payment-list-table-header"><?php echo $this->lang->line('sales_payment_amount'); ?></th>
					<th style="width: 4%;" class="payment-list-table-header"></th>
				</tr>
			</thead>
			<tbody id="payment_contents">
				<?php foreach ($payments as $payment_id => $payment) {?>
					<tr>
						<input type="hidden" name="payment_list_id" id="payment_list_id" value="<?php echo $payment_id; ?>" />
						<td class="payment-list-table-content"><?php echo $payment['payment_type']; ?></td>
						<td class="payment-list-table-content"><?php echo to_currency($payment['payment_amount']); ?></td>
						<td class="payment-list-table-content"><span data-payment-id="<?php echo $payment_id; ?>" class="delete_payment_button text-danger"><span class="glyphicon glyphicon-remove"></span></span></td>
					</tr>
				<?php }?>
			</tbody>
			<span class="payment-warning"><strong>Note: If you pay remaining payment please choose below mentioned option.</strong></span>
		</table> -->
		<!-- <div style="margin-top: 10px;">
			<div class="display due-amount multiple-payment-modal-payment-container">
				<label for="type_payment" class="multiple-payment-modal-container-label">Payment Type</label>
				<select name="type_payment" id="multiple_payment_type" class="multiple-payment-dropdown">
					<option value="Cash">Cash</option>
					<option value="Debit Card">Debit Card</option>
					<option value="Credit Card">Credit Card</option>
					<option value="Check">Cheque</option>
				</select>
			</div>
			<div class="display change-amount multiple-payment-modal-amount-container mt-10">
				<label for="amount" class="multiple-payment-modal-container-label">Amount</label>
				<input type="text" name="amount" id="multiple_amount" class="payment-input" value="<?php echo to_currency_no_money($amount_due); ?>" style="font-weight:bold;" onkeypress="return isNumber(event)">
			</div>
		</div> -->
		<div>
			<tbody id="payment_contents">
				<?php 
				$paid_payment_list = [];
				foreach ($payments as $payment_id => $payment) {
					$paid_payment_list[$payment['payment_type']] = $payment['payment_amount'];
					// array_push($paid_payment_list,$payment['payment_type'] => $payment['payment_amount']);
					?>
					<!-- <tr>
						<input type="hidden" name="payment_list_id" id="payment_list_id" value="<?php echo $payment_id; ?>" />
						<td class="payment-list-table-content"><?php echo $payment['payment_type']; ?></td>
						<td class="payment-list-table-content"><?php echo to_currency($payment['payment_amount']); ?></td>
						<td class="payment-list-table-content"><span data-payment-id="<?php echo $payment_id; ?>" class="delete_payment_button text-danger"><span class="glyphicon glyphicon-remove"></span></span></td>
					</tr> -->
				<?php } ?>
			</tbody>	
			<div class="modal-row">
				<div class="display w-30 due-amount">
					<label for="dueAmount">Due Amount</label>
					<input type="text" id="multiple_dueAmount" name="dueAmount" onkeypress="return isNumber(event)" value="<?php echo number_format($total,2); ?>" readonly>
				</div>
				<div class="display w-30 tendered-amount">
					<label for="tendered">Tendered</label>
					<input type="text" id="multiple_tendered" name="tendered" onkeypress="return isNumber(event)" value="<?php echo number_format($amount_due,2); ?>" readonly>
				</div>
				<div class="display w-30 change-amount">
					<label for="change">Change</label>
					<input type="text" id="multiple_change" name="change" value="0.00" onkeypress="return isNumber(event)" readonly>
				</div>
			</div>
		</div>
		<div class="multiple-payment-new-container">
			<table>
				<thead>
					<tr>
						<th style="width: 30%;" class="payment-list-table-header">Payment Method</th>
						<th style="width: 30%;" class="payment-list-table-header text-center">Received Amount</th>
						<th style="width: 40%;" class="payment-list-table-header text-center">Payment Account</th>
					</tr>
				</thead>
				<tbody id="payment_contents">
					<tr>
						<td class="payment-list-table-content multiple-payment-method-label" id="multiple_payment_type_cash">Cash</td>
						<td class="payment-list-table-content">
							<input type="text" name="amount" data-payment_type="Cash" placeholder="0.00" id="multiple_amount_cash" class="multiple-payment-new-input" value="<?php echo $paid_payment_list['Cash'] ? number_format($paid_payment_list['Cash'],2) : ""; ?>" style="font-weight:bold;" onkeypress="return isNumber(event)" />
						</td>
						<td class="payment-list-table-content">
							
						</td>
					</tr>
					<tr>
						<td class="payment-list-table-content multiple-payment-method-label" id="multiple_payment_type_debit">Debit Card</td>
						<td class="payment-list-table-content">
							<input type="text" name="amount"  placeholder="0.00" data-payment_type="Debit Card" id="multiple_amount_debit" class="multiple-payment-new-input" value="<?php echo $paid_payment_list['Debit Card'] ? number_format($paid_payment_list['Debit Card'],2) : "";?>" style="font-weight:bold;" onkeypress="return isNumber(event)">
						</td>
						<td class="payment-list-table-content">
							<select name="type_payment" class="multiple-payment-new-dropdown cursor-pointer">
								<option value="HDFC BANK ZOHARI BRANCH">HDFC BANK ZOHARI BRANCH</option>
								<option value="HDFC BANK ZOHARI BRANCH1">HDFC BANK ZOHARI BRANCH1</option>
								<option value="HDFC BANK ZOHARI BRANCH12">HDFC BANK ZOHARI BRANCH12</option>
								<option value="HDFC BANK ZOHARI BRANCH3">HDFC BANK ZOHARI BRANCH3</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="payment-list-table-content multiple-payment-method-label" id="multiple_payment_type_credit">Credit Card</td>
						<td class="payment-list-table-content">
							<input type="text" name="amount"  placeholder="0.00" data-payment_type="Credit Card" id="multiple_amount_credit" class="multiple-payment-new-input" value="<?php echo $paid_payment_list['Credit Card'] ? number_format($paid_payment_list['Credit Card'],2) : "";?>" style="font-weight:bold;" onkeypress="return isNumber(event)">
						</td>
						<td class="payment-list-table-content">
							<select name="type_payment" class="multiple-payment-new-dropdown cursor-pointer">
								<option value="HDFC BANK ZOHARI BRANCH">HDFC BANK ZOHARI BRANCH</option>
								<option value="HDFC BANK ZOHARI BRANCH1">HDFC BANK ZOHARI BRANCH1</option>
								<option value="HDFC BANK ZOHARI BRANCH12">HDFC BANK ZOHARI BRANCH12</option>
								<option value="HDFC BANK ZOHARI BRANCH3">HDFC BANK ZOHARI BRANCH3</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<button class="multiple-payment-submit-button" id="confirm_multiple_payment" onclick="payment_success(<?php echo $amount_due; ?>);">Proceed To Pay <span class="glyphicon glyphicon-arrow-right pl-10"></span></button>
		</div>
		<!-- <div style="display: flex; gap: 1%;">
			<button class="cancel w-100 payment-list-cancel-button" data-dismiss="modal">Cancel</button>
			<?php if ($amount_due != "0.0000") {?>
			<button class="submit" id="add_payment" onclick="payment_success(<?php echo $amount_due; ?>);" style="margin-top:15px;padding: 8px;border: none; border-radius: 3px; cursor: pointer;font-size: 1.2em;font-weight: 600;width: 50%;background-color: #004AAD;color: white;" >Add More Payment</button>
			<?php } else {?>
				<button class="submit payment-list-submit-button" id="confirm_payment" onclick="return BootstrapDialog.closeAll();">Confirm Payment</button>
			<?php }?>
		</div> -->
      </div>
    </div>
  </div>
</div>
<!-- End Code -->

<div id="loader">
	<div class="spinner"></div>
</div>

<script type="text/javascript">
	var categoryId = 0;
    var itemsList = [];
	// Global variables to store cached data
	let cachedGroups = null;
	let cachedAllItems = null;
	let imageLoadQueue = [];
	let observer = null;
	
	// Initialize intersection observer for lazy loading
	function initializeObserver() {
		observer = new IntersectionObserver((entries, observer) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					const img = entry.target;
					if (img.dataset.src) {
						img.src = img.dataset.src;
						img.removeAttribute('data-src');
						observer.unobserve(img);
					}
				}
			});
		}, {
			root: null,
			rootMargin: '50px',
			threshold: 0.1
		});
	}

	// Create image placeholder
	function createImagePlaceholder() {
		return `data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 116 116'%3E%3Crect width='116' height='116' fill='%23f0f0f0'/%3E%3C/svg%3E`;
	}

	// Generate HTML for item
	function generateItemHTML(item, base_url) {
		return `
			<div class="item-image-box" onclick="selectItem('${item.item_id}')" data-id="${item.item_id}">
				<img 
					src="${createImagePlaceholder()}"
					data-src="${base_url}items/pic_thumb/${item.pic_filename}"
					alt="${item.name}"
					width="116"
					height="116"
					class="lazy-image"
					onerror="this.onerror=null; this.src='${createImagePlaceholder()}';"
				>
				<div class="item-name">${item.name}</div>
			</div>
		`;
	}

	// Initialize caching
	function initializeCache() {
		if (!cachedGroups) {
			cachedGroups = <?php echo json_encode($grouped_data); ?>;
		}
		if (!cachedAllItems) {
			cachedAllItems = <?php echo json_encode($all_items_data); ?>;
		}
		if (!observer) {
			initializeObserver();
		}
	}

	// Load images in batches
	function loadImagesBatch(container, items, base_url, batchSize = 12) {
		let html = '';
		const fragment = document.createDocumentFragment();
		
		items.forEach(item => {
			const div = document.createElement('div');
			div.innerHTML = generateItemHTML(item, base_url);
			fragment.appendChild(div.firstElementChild);
		});
		
		container.appendChild(fragment);

		// Observe all lazy images
		container.querySelectorAll('.lazy-image').forEach(img => {
			observer.observe(img);
		});
	}

	function selectCategory(item){
		document.getElementById("selected-category").innerHTML = item.replace("item-", "");;
		$(".category-item-class.active").removeClass("active");
		$(`#${item}`).addClass("active");
   	};

	// function selectCategoryId(id){
	// 	categoryId = id;
	// 	const group = <?php echo json_encode($grouped_data); ?>;
	// 	var itemsList = group.find((item, index)=> id === index)['items'];

	// 	// Clear existing items
	// 	$('#items-image-container').empty();

	// 	// Loop through the itemsList and append them to the div
	// 	itemsList.forEach(item => {
	// 		const base_url = '<?php echo site_url(); ?>';
	// 		const itemHTML = `
	// 			<div class="item-image-box" onclick="selectItem('${item.item_id}')">
	// 				<img src="${base_url}items/pic_thumb/${item.pic_filename}" alt="${item.name}" width="116px" height="116px" loading="lazy">
    //     			<div class="item-name">${item.name}</div>
	// 			</div>
	// 		`;
	// 		// Append each item to the item-image-box
	// 		$('#items-image-container').append(itemHTML);
	// 	});
	// };

	// function selectAllItem(){
	// 	let allItems = <?php echo json_encode($all_items_data); ?>;
	// 	$('#items-image-container').empty();
	// 	allItems.forEach(item => {
	// 		const base_url = '<?php echo site_url(); ?>';
	// 		const itemHTML = `
	// 			<div class="item-image-box" onclick="selectItem('${item.item_id}')">
	// 				 <img src="${base_url}items/pic_thumb/${item.pic_filename}" alt="${item.name}" width="116px" height="116px" loading="lazy">
    //     			<div class="item-name">${item.name}</div>
	// 			</div>
	// 		`;
	// 		$('#items-image-container').append(itemHTML);
	// 	});
	// };
	function selectCategoryId(id) {
		initializeCache();
		categoryId = id;
		
		const itemsList = cachedGroups.find((item, index) => id === index)?.items || [];
		const container = document.getElementById('items-image-container');
		
		// Clear existing items
		container.innerHTML = '';
		
		// Load images
		loadImagesBatch(container, itemsList, '<?php echo site_url(); ?>');
	}

	function selectAllItem() {
		initializeCache();
		const container = document.getElementById('items-image-container');
		
		// Clear existing items
		container.innerHTML = '';
		
		// Load images
		loadImagesBatch(container, cachedAllItems, '<?php echo site_url(); ?>');
	}

	function selectItem(name){
		$('#item').val(name);
		$('#add_item_form').submit();
	}

	// Add CSS for smooth loading experience
	const style = document.createElement('style');
	style.textContent = `
		.item-image-box {
			position: relative;
			overflow: hidden;
			background: #f0f0f0;
			border-radius: 8px;
		}
		.lazy-image {
			transition: opacity 0.3s;
			opacity: 0;
		}
		.lazy-image.loaded {
			opacity: 1;
		}
		.item-image-box img {
			object-fit: cover;
		}
	`;
	document.head.appendChild(style);

	// Add event listener for image load
	document.addEventListener('DOMContentLoaded', () => {
		document.body.addEventListener('load', (e) => {
			if (e.target.tagName === 'IMG' && e.target.classList.contains('lazy-image')) {
				e.target.classList.add('loaded');
			}
		}, true);
	});
	function selectPaymentMethod(){
		if ($('.modal-payment').hasClass('readonly') || $('#multiple_payment_button').hasClass('readonly')) {
			return
		}
		else{
			const base_url = '<?php echo site_url(); ?>';
			const audio = new Audio(base_url+"/../public/uploads/click.wav");
			audio.play();
		} 
	}
	

   $(document).ready(function(){
	
	selectAllItem();
	
	setTimeout(() => {
		$('.custom-warning').css('display', 'none');
	}, 3000);
   	const redirect = function() {
   		window.location.href = "<?php echo site_url('sales'); ?>";
   	};
   	$("#remove_customer_button").click(function()
   	{
   		$.post("<?php echo site_url('sales/remove_customer'); ?>", redirect);
   	});
   	$(".delete_item_button").click(function()
   	{
   		const item_id = $(this).data('item-id');
   		$.post("<?php echo site_url('sales/delete_item/'); ?>" + item_id, redirect);
   	});
   	$(".delete_payment_button").click(function() {
   		let item_id = $(this).data('payment-id');
		item_id = item_id.replace(/ /g, '_');
   		$.post("<?php echo site_url('sales/delete_payment/'); ?>" + item_id, redirect);
   	});
   	$("input[name='item_number']").change(function() {
   		var item_id = $(this).parents('tr').find("input[name='item_id']").val();
   		var item_number = $(this).val();
   		$.ajax({
   			url: "<?php echo site_url('sales/change_item_number'); ?>",
   			method: 'post',
   			data: {
   				'item_id': item_id,
   				'item_number': item_number,
   			},
   			dataType: 'json'
   		});
   	});
   	$("input[name='name']").change(function() {
   		var item_id = $(this).parents('tr').find("input[name='item_id']").val();
   		var item_name = $(this).val();
   		$.ajax({
   			url: "<?php echo site_url('sales/change_item_name'); ?>",
   			method: 'post',
   			data: {
   				'item_id': item_id,
   				'item_name': item_name,
   			},
   			dataType: 'json'
   		});
   	});
   	$("input[name='item_description']").change(function() {
   		var item_id = $(this).parents('tr').find("input[name='item_id']").val();
   		var item_description = $(this).val();
   		$.ajax({
   			url: "<?php echo site_url('sales/change_item_description'); ?>",
   			method: 'post',
   			data: {
   				'item_id': item_id,
   				'item_description': item_description,
   			},
   			dataType: 'json'
   		});
   	});
   	$('#item').focus();
   	$('#item').blur(function() {
   		$(this).val("<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
   	});
   	// $('#item').autocomplete( {
   	// 	source: "<?php echo site_url($controller_name . '/item_search'); ?>",
   	// 	minChars: 0,
   	// 	autoFocus: false,
   	// 	delay: 500,
   	// 	select: function (a, ui) {
   	// 		$(this).val(ui.item.value);
   	// 		$('#add_item_form').submit();
   	// 		return false;
   	// 	}
   	// });
   	$('#item').autocomplete({
       source: function(request, response) {
           $.ajax({
               url: "<?php echo site_url($controller_name . '/item_search'); ?>",
               dataType: "json",
               data: {
                   term: request.term
               },
               success: function(data) {
                   response($.map(data, function(item) {
                       return {
                           label: item.label,  // Displayed in the dropdown
                           value: item.value,  // Value to be put in the input box
                           price: item.unit_price,      // Additional field: item quantity
                           batch_number: item.batch_number,  // Additional field: batch number
   						name: item.name,   // Additional field: name
   						qty: item.quantity   // Additional field: name
                       };
                   }));
               }
           });
       },
       minChars: 0,
       autoFocus: false,
       delay: 500,
       select: function(event, ui) {
           //$(this).val(ui.item.value);
		   console.log("feef")
			$(this).val('Batch: ' + ui.item.batch_number + ', id: ' + ui.item.value);
			$('#add_item_form').submit();
           return false;
       },
       // Customizing the display of the selected item
       focus: function(event, ui) {
           // Preventing default behavior to avoid replacing the input's value
           event.preventDefault();
           // Displaying the additional information
           $(this).val(ui.item.name + ' (price: ' + ui.item.price + ', Batch: ' + ui.item.batch_number + ', Qty: ' + ui.item.qty + ')');
       }
   });
   	$('#item').keypress(function (e) {
   		if(e.which == 13) {
   			$('#add_item_form').submit();
   			return false;
   		}
   	});
   	var clear_fields = function() {
   		if($(this).val().match("<?php echo $this->lang->line('sales_start_typing_item_name') . '|' . $this->lang->line('sales_start_typing_customer_name'); ?>"))
   		{
   			$(this).val('');
   		}
   	};
   	$('#item, #customer').click(clear_fields).dblclick(function(event) {
   		$(this).autocomplete('search');
   	});
   	$('#customer').blur(function() {
   		$(this).val("<?php echo $this->lang->line('sales_start_typing_customer_name'); ?>");
   	});
   	$('#customer').autocomplete( {
   		source: "<?php echo site_url('customers/suggest'); ?>",
   		minChars: 0,
   		delay: 10,
   		select: function (a, ui) {
   			$(this).val(ui.item.value);
			// Code added by kevin
			$('.custom_select_customer').val(ui.item.value);
			// End
   			$('#select_customer_form').submit();
   			return false;
   		}
   	});
   	$('#customer').keypress(function (e) {
   		if(e.which == 13) {
   			$('#select_customer_form').submit();
   			return false;
   		}
   	});
   	$('.giftcard-input').autocomplete( {
   		source: "<?php echo site_url('giftcards/suggest'); ?>",
   		minChars: 0,
   		delay: 10,
   		select: function (a, ui) {
   			$(this).val(ui.item.value);
   			$('#add_payment_form').submit();
   			return false;
   		}
   	});
   	$('#comment').keyup(function() {
   		$.post("<?php echo site_url($controller_name . '/set_comment'); ?>", {comment: $('#comment').val()});
   	});
   	<?php
      if ($this->config->item('invoice_enable') == true) {
          ?>
   		$('#sales_invoice_number').keyup(function() {
   			$.post("<?php echo site_url($controller_name . '/set_invoice_number'); ?>", {sales_invoice_number: $('#sales_invoice_number').val()});
   		});
   	<?php
      }
      ?>
   	$('#sales_print_after_sale').change(function() {
   		$.post("<?php echo site_url($controller_name . '/set_print_after_sale'); ?>", {sales_print_after_sale: $(this).is(':checked')});
   	});
   	$('#price_work_orders').change(function() {
   		$.post("<?php echo site_url($controller_name . '/set_price_work_orders'); ?>", {price_work_orders: $(this).is(':checked')});
   	});
   	$('#email_receipt').change(function() {
   		$.post("<?php echo site_url($controller_name . '/set_email_receipt'); ?>", {email_receipt: $(this).is(':checked')});
   	});
   	$('#finish_sale_button').click(function() {
   		$('#buttons_form').attr('action', "<?php echo site_url($controller_name . '/complete'); ?>");
   		$('#buttons_form').submit();
   	});
   	$('#finish_invoice_quote_button').click(function() {
   		$('#buttons_form').attr('action', "<?php echo site_url($controller_name . '/complete'); ?>");
   		$('#buttons_form').submit();
   	});
   	$('#suspend_sale_button').click(function() {
   		$('#buttons_form').attr('action', "<?php echo site_url($controller_name . '/suspend'); ?>");
   		$('#buttons_form').submit();
   	});
   	$('#cancel_sale_button').click(function() {
   		if(confirm("<?php echo $this->lang->line('sales_confirm_cancel_sale'); ?>"))
   		{
   			$('#buttons_form').attr('action', "<?php echo site_url($controller_name . '/cancel'); ?>");
   			$('#buttons_form').submit();
   		}
   	});
   	$('#add_payment_button').click(function() {
   		$('#add_payment_form').submit();
   	});
   	$('#payment_types').change(check_payment_type).ready(check_payment_type);
   	$('#cart_contents input').keypress(function(event) {
   		if(event.which == 13)
   		{
   			$(this).parents('tr').prevAll('form:first').submit();
   		}
   	});
   	$('#amount_tendered').keypress(function(event) {
   		if(event.which == 13)
   		{
   			$('#add_payment_form').submit();
   		}
   	});
   	$('#finish_sale_button').keypress(function(event) {
   		if(event.which == 13)
   		{
   			$('#finish_sale_form').submit();
   		}
   	});
   	dialog_support.init('a.modal-dlg, button.modal-dlg');
   	table_support.handle_submit = function(resource, response, stay_open) {
   		$.notify( { message: response.message }, { type: response.success ? 'success' : 'danger'} )
   		if(response.success)
   		{
   			if(resource.match(/customers$/))
   			{
   				$('#customer').val(response.id);
   				$('#select_customer_form').submit();
   			}
   			else
   			{
   				var $stock_location = $("select[name='stock_location']").val();
   				$('#item_location').val($stock_location);
   				$('#item').val(response.id);
   				if(stay_open)
   				{
   					$('#add_item_form').ajaxSubmit();
   				}
   				else
   				{
   					$('#add_item_form').submit();
   				}
   			}
   		}
   	}
   	$('[name="price"],[name="quantity"],[name="batch_number"],[name="discount"],[name="description"],[name="serialnumber"],[name="discounted_total"]').change(function() {
   		$(this).parents('tr').prevAll('form:first').submit()
   	});
   	$('[name="discount_toggle"]').change(function() {
   		var input = $('<input>').attr('type', 'hidden').attr('name', 'discount_type').val(($(this).prop('checked'))?1:0);
   		$('#cart_'+ $(this).attr('data-line')).append($(input));
   		$('#cart_'+ $(this).attr('data-line')).submit();
   	});
   });
   function check_payment_type()
   {
   	var cash_mode = <?php echo json_encode($cash_mode); ?>;
   	if($("#payment_types").val() == "<?php echo $this->lang->line('sales_giftcard'); ?>")
   	{
   		$("#sale_total").html("<?php echo to_currency($total); ?>");
   		$("#sale_amount_due").html("<?php echo to_currency($amount_due); ?>");
   		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_giftcard_number'); ?>");
   		$("#amount_tendered:enabled").val('').focus();
   		$(".giftcard-input").attr('disabled', false);
   		$(".non-giftcard-input").attr('disabled', true);
   		$(".giftcard-input:enabled").val('').focus();
   	}
   	else if(($("#payment_types").val() == "<?php echo $this->lang->line('sales_cash'); ?>" && cash_mode == '1'))
   	{
   		$("#sale_total").html("<?php echo to_currency($non_cash_total); ?>");
   		$("#sale_amount_due").html("<?php echo to_currency($cash_amount_due); ?>");
   		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
   		$("#amount_tendered:enabled").val("<?php echo to_currency_no_money($cash_amount_due); ?>");
   		$(".giftcard-input").attr('disabled', true);
   		$(".non-giftcard-input").attr('disabled', false);
   	}
   	else
   	{
   		$("#sale_total").html("<?php echo to_currency($non_cash_total); ?>");
   		$("#sale_amount_due").html("<?php echo to_currency($amount_due); ?>");
   		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
   		$("#amount_tendered:enabled").val("<?php echo to_currency_no_money($amount_due); ?>");
   		$(".giftcard-input").attr('disabled', true);
   		$(".non-giftcard-input").attr('disabled', false);
   	}
   }
   // Add Keyboard Shortcuts/Hotkeys to Sale Register
   document.body.onkeyup = function(e)
   {
   	switch(event.altKey && event.keyCode)
   	{
           case 49: // Alt + 1 Items Seach
   			$("#item").focus();
   			$("#item").select();
               break;
           case 50: // Alt + 2 Customers Search
   			$("#customer").focus();
   			$("#customer").select();
               break;
   		case 51: // Alt + 3 Suspend Current Sale
   			$("#suspend_sale_button").click();
   			break;
   		case 52: // Alt + 4 Check Suspended
   			$("#show_suspended_sales_button").click();
   			break;
           case 53: // Alt + 5 Edit Amount Tendered Value
   			$("#amount_tendered").focus();
   			$("#amount_tendered").select();
               break;
   		case 54: // Alt + 6 Add Payment
   			$("#add_payment_button").click();
   			break;
   		case 55: // Alt + 7 Add Payment and Complete Sales/Invoice
   			$("#add_payment_button").click();
   			window.location.href = "<?php echo site_url('sales/complete'); ?>";
   			break;
   		case 56: // Alt + 8 Finish Quote/Invoice without payment
   			$("#finish_invoice_quote_button").click();
   			break;
   		case 57: // Alt + 9 Open Shortcuts Help Modal
   			$("#show_keyboard_help").click();
   			break;
   	}
   	switch(event.keyCode)
   	{
   		case 27: // ESC Cancel Current Sale
   			$("#cancel_sale_button").click();
   			break;
       }
   }
</script>
<!-- This script created by kevin -->
<script>
	function isEmpty(val){
		return (val === undefined || val == null || val.length <= 0) ? true : false;
	}

	function change_qty(id,operation){
		var item_qty = $('#quantity_'+id).val();
		var changed_qty = operation == 'minus' ? Math.abs(parseInt(item_qty) == 0 ? 0 : parseInt(item_qty) - 1): Math.abs(parseInt(item_qty) + 1);
		$('#quantity_'+id).val(changed_qty);
		$('#cart_'+ id).submit();
	}
	
	var total_amount = Math.trunc($('#total_amount').val());
	$('#add_payment').click(function() {
		$('#multiplePayment').modal('show');
		$('#multiplePaymentDetail').modal('hide');
	});
	$('#confirm_payment').click(function() {
		$('#myModal').modal('hide');
		var controller = $('.modal-payment').data('controller');
		$('#buttons_form').attr('action',controller);
		$('#buttons_form').submit();
	});
	if(total_amount != "0"){
		var multiple_payment = $('#payment_list_id').val();
		var due_amount = Math.trunc("<?php echo $amount_due; ?>");
		if(multiple_payment != null && multiple_payment != 'undefined'){
			if(due_amount != "0"){
				$('#multiplePaymentDetail').modal('show');
				dialog_support.init('a.modal-dlg, button.modal-dlg,button.modal-payment');
			} else {
				var controller = $('.modal-payment').data('controller');
				$('#buttons_form').attr('action',controller);
				$('#buttons_form').submit();
			}
		} else {
			dialog_support.init('a.modal-dlg, button.modal-dlg,button.modal-payment');
		}
		$('.modal-payment').removeClass('readonly');
		$('#multiple_payment_button').removeClass('readonly');
		$('#suspend_sale_button').removeClass('readonly');
	} else {
		dialog_support.init('a.modal-dlg, button.modal-dlg');
	}

	$('#add_payment').click(function() {
		$('#multiplePaymentDetail').modal('hide');
	});
	// multiple_payment_button
	$('#multiple_payment_button').click(function() {
		if ($('.modal-payment').hasClass('readonly') || $('#multiple_payment_button').hasClass('readonly')) {
			return false;
 		}
		else{
			$('#multiplePayment').modal('show');
			setTimeout(function() {
				$('#multiple_amount_cash').focus();
			}, 500);
		}
	});

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}

	var payment_type = '';

	$(document).ready(function () {
		multiple_tendered = $('#multiple_tendered').val()
		$("#multiple_amount_cash").change(function (event) {
			let amount = this.value.replace(/,/g, '');
			if(multiple_tendered > amount){
				$("#multiple_amount_debit").prop('disabled', true);
				$("#multiple_amount_debit").css({'background-color':'gray'});
				$("#multiple_amount_credit").css({'background-color':'gray'});
				$("#multiple_amount_credit").prop('disabled', true);
				payment_type = $(this).data("payment_type");
			} else {
				alert('Your entered amount is higher than the actual amount. Please enter the correct amount.');
			}
		});
		$("#multiple_amount_debit").change(function (event) {
			let amount = this.value.replace(/,/g, '');
			if(multiple_tendered > amount){
				$("#multiple_amount_cash").prop('disabled', true);
				$("#multiple_amount_cash").css({'background-color':'gray'});
				$("#multiple_amount_credit").prop('disabled', true);
				$("#multiple_amount_credit").css({'background-color':'gray'});
				payment_type = $(this).data("payment_type");
			} else {
				alert('Your entered amount is higher than the actual amount. Please enter the correct amount.');
			}	
		});
		$("#multiple_amount_credit").change(function (event) {
			let amount = this.value.replace(/,/g, '');
			if(multiple_tendered > amount){
				$("#multiple_amount_cash").prop('disabled', true);
				$("#multiple_amount_cash").css({'background-color':'gray'});
				$("#multiple_amount_debit").prop('disabled', true);
				$("#multiple_amount_debit").css({'background-color':'gray'});
				payment_type = $(this).data("payment_type");
			} else {
				alert('Your entered amount is higher than the actual amount. Please enter the correct amount.');
			}		
		});
    });



	function payment_success(amount_due = ''){
		payment_amount = '';
		
		if(isEmpty($('#multiple_amount_debit').val()) !== true && payment_type == "Debit Card"){
			payment_amount = $('#multiple_amount_debit').val();
		} 
		if(isEmpty($('#multiple_amount_credit').val()) !== true && payment_type == "Credit Card"){
			payment_amount = $('#multiple_amount_credit').val();
		} 
		if(isEmpty($('#multiple_amount_cash').val()) !== true && payment_type == "Cash") {
			payment_amount = $('#multiple_amount_cash').val();
		}
		console.log('payment_type',payment_type,'payment_amount',payment_amount);
		$('select[name="payment_type"]').val(payment_type);
		$('.selectpicker').selectpicker('refresh');
		$('#amount_tendered').val(payment_amount);
		$('#add_payment_form').submit();
	}

	$(document).on('change', '.multiple-payment-new-input', function() {
		let amount = this.value;
		let change = '';
		let tendered = $('#multiple_tendered').val();
		change = (tendered.replace(/,/g, '') - amount.replace(/,/g, ''));
		$('#multiple_change').val(change); 
	});

	
</script>
<?php $this->load->view("partial/footer");?>