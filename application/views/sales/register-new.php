
<?php $this->load->view("partial/header");?>
<link rel="stylesheet" type="text/css" href="css/register-new.css" />

<div class="register-page">
	<div id="register_wrapper" class="register-wrapper" style="width: 100%;">
		<div class="new_cust_design">
			<div class="panel-body p-0">
				<ul id="register-page-header" class="header-ul">
					<li>
						<h6 class="header-label item-name-label">Item Name</h6>
							<input type="text" name="item" id="item" class="form-control input-sm" size="30">
						<span class="ui-helper-hidden-accessible" role="status"></span>
					</li>
					<li>
						<h6 class="header-label">Register Mode</h6>
						<div class="custom-dropdown-wrapper">
							<select class="custom-dropdown">
								<option value="">Select</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
					</li>
					<li>
						<h6 class="header-label">Table</h6>
						<div class="custom-dropdown-wrapper">
							<select class="custom-dropdown">
								<option value="">Select</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
					</li>
					<li>
						<h6 class="header-label">Stock Location</h6>
						<div class="custom-dropdown-wrapper">
							<select class="custom-dropdown">
								<option value="">Select</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
					</li>
					<li>
						<div class="form-group m-0 align-end gap-2" id="select_customer">
							<button style="border: none; padding: 7px 9px;" class='btn btn-info btn-sm modal-dlg header-ul-icon-button theme-color theme-transition-effect' id="customer_detail" style="margin-right: 5px;"> <span class="glyphicon glyphicon-user theme-transparent theme-transition-effect"></span> </button>
							<div>
								<h6 class="header-label customer-dropdown-label">Select Customer</h6>
								<input type="text" name="customer" id="customer" class="form-control input-sm" size="30">
							</div>
							<button style="border: none; padding: 7px 9px;" class='header-ul-icon-button btn btn-info btn-sm theme-color theme-transition-effect' id="remove_customer_button" title="Remove Customer" style="margin-left: 5px;"><span class="glyphicon glyphicon-remove theme-transparent theme-transition-effect"></span></button>

							<button class='btn btn-info btn-sm modal-dlg theme-color header-ul-icon-button theme-transition-effect' style="border: none; padding: 7px 9px;"> 
								<span class="glyphicon glyphicon-plus theme-transparent theme-transition-effect"></span>
							</button>
						</div>
					</li>
					<li>
						<div class="m-0 align-end gap-2">
							<button class='btn header-ul-icon-button btn-default btn-sm modal-dlg theme-color theme-transition-effect' style="border: none; padding: 7px 9px;" id='show_suspended_sales_button'>
								<span class="glyphicon glyphicon-align-justify theme-transparent theme-transition-effect">&nbsp</span>Suspended
							</button>
							<button class='btn header-ul-icon-button btn-default btn-sm modal-dlg theme-color theme-transition-effect' style="border: none; padding: 7px 9px;" id='show_keyboard_help'>
								<span class="glyphicon glyphicon-share-alt theme-transparent theme-transition-effect"></span>
							</button>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!-- Sale Items List -->
		<div class="table-custom-height">
			<table class="sales_table_100" id="register">
				<thead>
					<tr>
						<th style="width: 5%;" class="theme-color">#</th>
						<th style="width: 6%;" class="theme-color">Itemcode</th>
						<th style="width: 20%" class="theme-color">Product</th>
						<th style="width: 10%;" class="theme-color">QTY</th>
						<th style="width: 10%;" class="theme-color">MRP</th>
						<th style="width: 13%;" class="theme-color">Discount</th>
						<th style="width: 7%;" class="theme-color">Unit Cost</th>
						<th style="width: 7%;" class="theme-color net-amount-width">Net Amount</th>
						<th style="width: 2%" class="theme-color">Delete</th>
					</tr>
				</thead>
				<tbody id="cart_contents">
                    <tr>
						<td>
							<span class="glyphicon glyphicon-user"></span>
						</td>
						<td>9527</td>
                        <td>CG Bglore 1</td>
						<td class="qty-cell">
							<button type="button" class='btn btn-default btn-sm theme-color table-qty-button' id='minus_order'><span class="glyphicon glyphicon-minus theme-transparent"></span></button>

                            <input type="text" name="quantity" id="quantity_" class="form-control input-sm custom-input-height" value="10">

							<button type="button" class='btn btn-default btn-sm theme-color table-qty-button' style="margin-left: 2px;" id='plus_order'> <span class="glyphicon glyphicon-plus theme-transparent"></span></button>
						</td>
						<td>
                            <div class="justify-content-center">
								<input type="text" id="mrp_" class="form-control input-sm custom-input-height w-100" value="100">
							</div>
						</td>
						<td>
							<div class="justify-content-center">
								<div class="input-group">
									<div class="input-with-toggle">
										<div class="container-fluid m-0">
											<div class="checkbox d-flex m-0">
												<input data-toggle="toggle"  data-on="$" data-off="%" type="checkbox">
												<input type="text" id="mrp_"class="form-control input-sm custom-input-height w-100" value="100" name="discount">
											</div>
										</div>
										
									</div>
									
								</div>
							</div>
						</td>
						<td>
                            $100
						</td>
						<td>
                            $80
						</td>
						<td class="cursor-pointer">
							<span class="delete_item_button">
								<span class="glyphicon glyphicon-trash"></span>
							</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- hitesh -->
		<div class="footer-container">
			<div class="row footer-top">
				<div class="col-md-1 text-center footer-top-column">
					<div>11</div>
					<div style="font-weight: 800; font-size: 12px;">Quantity</div>
				</div>
				<div class="col-md-1 text-center footer-top-column">
					<div>Rs 1,20,100</div>
					<div style="font-weight: 800; font-size: 12px;">Price</div>
				</div>
				<div class="col-md-1 text-center footer-top-column">
					<div>Rs 20,100</div>
					<div style="font-weight: 800; font-size: 12px;">Discount</div>
				</div>
				<div class="col-md-2 text-center footer-top-column footer-tax-container">
					<div>2.5% CGST RS 48.78</div>
					<div>5% GST RS 7.62</div>
					<div>15% GST RS 1,512.52</div>
					<div>2.5% SGST RS 48.78</div>
					<div style="font-weight: 800; font-size: 12px;">Tax</div>
				</div>
				<div class="col-md-1 theme-text-color footer-top-column">
					<input type="hidden" name="total_amount" id="total_amount" />
					<div class="footer-top-column-total">Rs 1,00,100</div>
					<div class="footer-top-column-header"><?php echo $this->lang->line('sales_total'); ?></div>
				</div>

				<div class="col-md-6 comment-outer-container">
					<div class="no-gutter" id="footer-comment-container" style="width: 210px;">
						<div class="form-group form-group-sm">
							<div class="col-xs-12">
								<textarea name="comment" id="comment" placeholder="Comments here..." class="form-control input-sm fix-commentbox-width comment-textarea" rows="2"></textarea>
							</div>
						</div>
					</div>
					<div style="margin-left: 20px; margin-right: 10px;">
						<div>
							<label for="sales_invoice_number" class="control-label checkbox footer-checkbox-label m-0">
								<?php echo $this->lang->line('sales_invoice_enable'); ?>
							</label>
							<div class="input-group input-group-sm">
								<input type="text" name="sales_invoice_number" id="sales_invoice_number" class="form-control input-sm" style="width: 100px;">
							</div>
						</div>
					</div>
					<div style="margin-left: 30px;">
						<div>
						<div>
							<label for="sales_print_after_sale" class="control-label checkbox footer-checkbox-label m-0">
								<input type="checkbox" name="sales_print_after_sale" id="sales_print_after_sale" value="1">
								<?php echo $this->lang->line('sales_print_after_sale') ?>
							</label>
						</div>
						<div>
							<label for="email_receipt" class="control-label checkbox footer-checkbox-label m-0">
								<input type="checkbox" name="email_receipt" id="email_receipt" value="1">
								<?php echo $this->lang->line('sales_email_receipt'); ?>
							</label>
						</div>
						<div>
							<label for="price_work_orders" class="control-label checkbox footer-checkbox-label m-0">
								<input type="checkbox" name="price_work_orders" id="price_work_orders" value="1">
								<?php echo $this->lang->line('sales_include_prices'); ?>
							</label>
						</div>
						</div>
					</div>
					<div style="margin-left: 30px;">
						<button class="theme-color theme-transition-effect comment-box-button" type="button">
							<span class="glyphicon glyphicon-ok" style="padding-right:5px"></span>Quote
						</button>
						<button class="theme-color theme-transition-effect comment-box-button" type="button">
							<span class="glyphicon glyphicon-share" style="padding-right:5px"></span>Generate Token
						</button>
					</div>
				</div>

			</div>
			<div class="d-flex footer-bottom">
				<button onclick="selectPaymentMethod();" id='new_payment_button_cash' class='modal-payment text-center payment-buttons theme-color theme-transition-effect readonly' data-value="cash" data-controller="<?php echo site_url($controller_name . '/complete'); ?>" title="Cash">
					<span class="glyphicon glyphicon-credit-card pr-5"></span>Cash
				</button>
				<button onclick="selectPaymentMethod();" id='new_payment_upi' class='modal-payment text-center payment-buttons theme-color theme-transition-effect readonly' data-value="upi" data-controller="<?php echo site_url($controller_name . '/complete'); ?>" title="UPI">
					<span class="glyphicon glyphicon-credit-card pr-5"></span>UPI
				</button>
				<button onclick="selectPaymentMethod();" id='new_payment_button' class='modal-payment text-center payment-buttons theme-color theme-transition-effect readonly' data-value="due" data-controller="<?php echo site_url($controller_name . '/complete'); ?>" title="Due">
					<span class="glyphicon glyphicon-credit-card pr-5"></span>Due
				</button>
				<button onclick="selectPaymentMethod();" id='multiple_payment_button' class='text-center payment-buttons theme-color theme-transition-effect readonly' data-controller="<?php echo site_url($controller_name . '/complete'); ?>" data-value="multiple_payment" title="Multiple Payment">
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
				<li 
					id="item-" 
					class="category-item-class" 
					onclick="selectCategory('item-<?php echo $category_id; ?>'); selectCategoryId(<?php echo $index; ?>)">
					<?php echo htmlspecialchars($group['category']); ?>
				</li>
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