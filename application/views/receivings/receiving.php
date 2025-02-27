<?php $this->load->view("partial/header"); ?>
<link rel="stylesheet" type="text/css" href="css/register_new_design.css" />
<link rel="stylesheet" type="text/css" href="css/receiving.css" />
<?php
if (isset($error))
{
	echo "<div class='alert alert-dismissible alert-danger'>".$error."</div>";
}

if (!empty($warning))
{
	echo "<div class='alert alert-dismissible alert-warning'>".$warning."</div>";
}

if (isset($success))
{
	echo "<div class='alert alert-dismissible alert-success'>".$success."</div>";
}
?>

<!-- style added by Rahul -->
<style>
	.readonly{
		color:Gray !important;
		cursor: pointer;
	}
	 .custom-warning{
		width: fit-content;
		position: absolute;
		z-index: 10;
		right: 15px;
	}
	.table-custom-height{
		min-height: 370px;
		height: 70%;
	}
	.qty-cell{
		display: flex; 
		height: 44px;
		padding-top: 6px !important;
	}
	.align-start{
		text-align: start !important;
	}
	.custom-input-height{
		height: 31px !important
	}
	.cursor-pointer:hover{
		cursor: pointer !important;
	}
</style>
<!-- Div added by rahul -->
<div class="container register-wrapper w-full">
	<div class="row m-0 p-0">
		<!--Code added by rahul  -->
		<?php $tabindex = 0;?>
		<div class="col-4 col-md-4 col-xl-4 col-lg-4">
			<?php echo form_open($controller_name."/change_mode", array('id'=>'mode_form', 'class'=>'form-horizontal panel panel-default receiving-container p0')); ?>
						<table class="min-w-100">
							<tr>
								<td>
									<h6 class="header-label item-name-label"><?php echo $this->lang->line('receivings_mode'); ?></h6>
									<?php echo form_dropdown('mode', $modes, $mode, array('onchange'=>"$('#mode_form').submit();", 'class'=>'selectpicker show-menu-arrow d-block header-dropdown-receive min-w-100', 'data-style'=>'btn btn-sm btn-default')); ?>
								</td>
							</tr>
						</table>
			<?php echo form_close(); ?>
			<div class="mt-15">
				<?php echo form_open($controller_name . "/add", array('id' => 'add_item_form', 'class' => 'form-horizontal panel panel-default', 'style' => 'background-color: transparent; border:none; box-shadow: none;align-content:center')); ?>	
					<div class="panel-body form-group p0">
							<table style="width:100%;">
								<tr>
									<td>
										<h6 class="header-label item-name-label">Item Name</h6>
										<?php echo form_input(array('name' => 'item', 'id' => 'item', 'class' => 'form-control input-sm', 'size' => '50', 'tabindex' => ++$tabindex)); ?>
										<span class="ui-helper-hidden-accessible" role="status">&nbsp</span>
									</td>
									<td class="vertical-bottom">
										<button id='new_item_button' class='btn btn-info btn-sm modal-dlg theme-color theme-transition-effect new-item-add'
											data-btn-submit='<?php echo $this->lang->line('common_submit') ?>'
											data-btn-new='<?php echo $this->lang->line('common_new') ?>'
											data-href='<?php echo site_url("items/view_modal"); ?>'
											title='<?php echo $this->lang->line('sales_new_item'); ?>'>
											<span class="glyphicon glyphicon-plus theme-transparent theme-transition-effect"></span>
										</button>
									</td>
								</tr>
							</table>
				</div>
				<?php echo form_close(); ?>
		    </div>
		</div>
		<div class="col-4 col-md-4 col-xl-4 col-lg-4 p0 ml-50">
			<div class="panel-body form-group p0 m-0">
					<?php
					if(isset($supplier))
					{
					?>
					<h6 class="header-label item-name-label">Supplier Details</h6>
					 <div class="supplier-container h-35">
						<div class="display">
							<div class="d-flex supplier-details-wrapper">
								<div class="header-label"><?php echo $this->lang->line("receivings_supplier"); ?></div>
								<div class="m-10"><?php echo $supplier; ?></div>
							</div>
							<?php
							if(!empty($supplier_email))
							{
							?>
								<div class="d-flex supplier-details-wrapper">
									<div class="header-label"><?php echo $this->lang->line("receivings_supplier_email"); ?></div>
									<div class="m-10"><?php echo $supplier_email; ?></div>
								</div>
							<?php
							}
							?>

							<?php
							if(!empty($supplier_address))
							{
							?>
								<div class="d-flex supplier-details-wrapper">
									<div class="header-label"><?php echo $this->lang->line("receivings_supplier_address"); ?></div>
									<div class="m-10"><?php echo $supplier_address; ?></div>
								</div>
							<?php
							}
							?>
							<?php
							if(!empty($supplier_location))
							{
							?>
								<div class="d-flex supplier-details-wrapper">
									<div class="header-label"><?php echo $this->lang->line("receivings_supplier_location"); ?></div>
									<div class="m-10"><?php echo $supplier_location; ?></div>
								</div>
							<?php
							}
							?>
						</div>
						<div>
							<button class="btn btn-danger btn-sm" id="remove_supplier_button" title="<?php echo $this->lang->line('common_remove').' '.$this->lang->line('suppliers_supplier')?>">
								<span class="glyphicon glyphicon-remove">
							</button>
						</div>
					 </div>
					<?php
					}
					else
					{
					?>
						<?php echo form_open($controller_name."/select_supplier", array('id'=>'select_supplier_form', 'class'=>'form-horizontal')); ?>
							<div id="select_customer">
							<table class="sales_table_100" style="width:100%; align-content:center">
								<tr>
									<td>
										<h6 class="header-label item-name-label"><?php echo $this->lang->line('receivings_select_supplier'); ?></h6>
										<?php echo form_input(array('name'=>'supplier', 'id'=>'supplier', 'class'=>'form-control input-sm', 'value'=>$this->lang->line('receivings_start_typing_supplier_name'))); ?>
									</td>
									<td class="vertical-bottom">
										<button id='new_supplier_button' class='btn btn-info btn-sm modal-dlg theme-color theme-transition-effect new-item-add' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url("suppliers/view_modal"); ?>'
												title='<?php echo $this->lang->line('receivings_new_supplier'); ?>'>
												<span class="glyphicon glyphicon-plus theme-transparent theme-transition-effect"></span>
										</button>
									</td>
								</tr>
							</table>
							</div>
						<?php echo form_close(); ?>
					<?php
					}
					?>		
			</div>
		</div>
		<div class="col-3 col-md-3 col-xl-3 col-lg-3 p0 ml-25">
			<div class="form-group form-group-sm">
				<h6 class="header-label item-name-label"><?php echo $this->lang->line('receivings_reference');?></h6>
				<?php echo form_input(array('name'=>'recv_reference', 'id'=>'recv_reference', 'class'=>'form-control input-sm', 'value'=>$reference, 'size'=>5));?>
			</div>
			<div class="mt-15">
				<div class="form-group form-group-sm">
					<h6 class="header-label item-name-label"><?php echo "Due Date"; ?></h6>
					<?php echo form_input(array(
						'name' => 'payment_due_date',
						'id' => 'payment_due_date',
						'type' => 'date',
						'class' => 'form-control form-control-sm',
						'data-width' => 'fit'
					)); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Receiving Items List -->
	<div class="custom-recieving-table">
		<table class="sales_table_100" id="register">
			<thead>
				<tr>
					<th style="width:7%" class="theme-color"><?php echo $this->lang->line('sales_item_number'); ?></th>
					<th style="width:17%" class="theme-color"><?php echo $this->lang->line('receivings_item_name'); ?></th>
					<th style="width:7%" class="theme-color"><?php echo $this->lang->line('sales_batch_number'); ?></th>
					<th style="width:10%" class="theme-color"><?php echo $this->lang->line('receivings_cost'); ?></th>
					<th style="width:10%" class="theme-color"><?php echo $this->lang->line('receivings_mrp'); ?></th>
					<th style="width:8%" class="theme-color"><?php echo $this->lang->line('receivings_quantity'); ?></th>
					<th style="width:10%" class="theme-color"><?php echo $this->lang->line('receivings_ship_pack'); ?></th>
					<th style="width:10%" class="theme-color"><?php echo $this->lang->line('receivings_discount'); ?></th>
					<th style="width:14%" class="theme-color"><?php echo $this->lang->line('receiving_Tax'); ?></th>
					<th style="width:10%" class="theme-color"><?php echo $this->lang->line('receivings_total'); ?></th>
					<th style="width:8%" class="theme-color" colspan="2">Actions</th>
				</tr>
			</thead>
			<tbody id="cart_contents">
				<?php
				if(count($cart) == 0)
				{
				?>
					<tr>
						<td colspan='12' class="p0 pt-2">
							<div class='alert alert-dismissible alert-info theme-color border-none'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
						</td>
					</tr>
				<?php
				}
				else
				{
					foreach(array_reverse($cart, TRUE) as $line=>$item)
					{
				?>
						<?php echo form_open($controller_name."/edit_item/$line", array('class'=>'form-horizontal', 'id'=>'cart_'.$line)); ?>
							<tr>
								<td><?php echo $item['item_number']; ?></td>
								<td style="align:center;">
									<?php echo $item['name'] . ' '. implode(' ', array($item['attribute_values'], $item['attribute_dtvalues'])); ?><br /> <?php echo '[' . to_quantity_decimals($item['in_stock']) . ' in ' . $item['stock_name'] . ']'; ?>
									<?php echo form_hidden('location', $item['item_location']); ?>
								</td>
								<td><?php echo form_input(array('name'=>'batch_number', 'id'=>'batch_number_'.$line, 'class'=>'form-control input-sm custom-input-height', 'value'=>$item['batch_number'],'onClick'=>'this.select();')); ?></td>
	
								<?php 
								if ($items_module_allowed && $mode !='requisition')
								{
								?>
									<td><?php echo form_input(array('name'=>'price', 'class'=>'form-control input-sm custom-input-height', 'value'=>to_currency_no_money($item['price']),'onClick'=>'this.select();'));?></td>
								<?php
								}
								else
								{
								?>
									<td>
										<?php echo $item['price']; ?>
										<?php echo form_hidden('price', to_currency_no_money($item['price'])); ?>
									</td>
								<?php
								}
								?>
								<td><?php echo form_input(array('name'=>'mrp', 'id'=>'mrp_'.$line, 'class'=>'form-control input-sm custom-input-height', 'value'=>to_currency_no_money($item['mrp']),'onClick'=>'this.select();')); ?></td>
								<td><?php echo form_input(array('name'=>'quantity', 'class'=>'form-control input-sm custom-input-height', 'value'=>to_quantity_decimals($item['quantity']),'onClick'=>'this.select();')); ?></td>
								<td><?php echo form_dropdown('receiving_quantity', $item['receiving_quantity_choices'], $item['receiving_quantity'], array('class'=>'form-control input-sm custom-input-height'));?></td>
	
								<?php       
								if ($items_module_allowed && $mode!='requisition')
								{
								?>
									<td>
									<div class="input-group">
										<?php echo form_input(array('name'=>'discount', 'class'=>'form-control input-sm custom-input-height', 'value'=>$item['discount_type'] ? to_currency_no_money($item['discount']) : to_decimals($item['discount']), 'onClick'=>'this.select();')); ?>
										<span class="input-group-btn custom-discount-toggle-container">
											<?php echo form_checkbox(array('id'=>'discount_toggle', 'name'=>'discount_toggle', 'value'=>1, 'data-toggle'=>"toggle",'data-size'=>'small', 'data-onstyle'=>'success', 'data-on'=>'<b>'.$this->config->item('currency_symbol').'</b>', 'data-off'=>'<b>%</b>', 'data-line'=>$line, 'checked'=>$item['discount_type'])); ?>
										</span>
									</div> 
								</td>
								<?php
								}
								else
								{
								?>
									<td><?php echo $item['discount'];?></td>
									<?php echo form_hidden('discount',$item['discount']); ?>
								<?php
								}
								?>
								<td>
								<?php echo ($item['total_tax_percent']*100).'%'?><br><?php echo to_currency(($item['discount_type'] == PERCENT) ? ($item['price']*$item['quantity']*$item['receiving_quantity'] - $item['price'] * $item['quantity'] * $item['receiving_quantity'] * $item['discount'] / 100)/(1+$item['total_tax_percent']) : ($item['price']*$item['quantity']*$item['receiving_quantity'] - $item['discount'])/(1+$item['total_tax_percent'])); ?></td>
								</td>
								<td>
								<?php echo to_currency(($item['discount_type'] == PERCENT) ? $item['price']*$item['quantity']*$item['receiving_quantity'] - $item['price'] * $item['quantity'] * $item['receiving_quantity'] * $item['discount'] / 100 : $item['price']*$item['quantity']*$item['receiving_quantity'] - $item['discount']); ?></td> 
								<td><a href="javascript:$('#<?php echo 'cart_'.$line ?>').submit();" title=<?php echo $this->lang->line('receivings_update')?> ><span class="glyphicon glyphicon-refresh cursor-pointer"></span></a></td>
								<td><span data-item-id="<?php echo $line;?>" class="delete_item_button"><span class="glyphicon glyphicon-trash cursor-pointer"></span></span></td>
							</tr>
						<?php echo form_close(); ?>
				<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>

	<div class="receiving-footer register-main-filter-conatiner mt-10">
		
				<?php
				// Show Complete sale button instead of Add Payment if there is no amount due left
				if(!$payments_cover_total)
				{
					if(count($cart) > 0)
					{
				?>
					<div class="filter-box-wrapper">
					<?php echo form_open($controller_name."/add_payment", array('id'=>'add_payment_form', 'class'=>'form-horizontal')); ?>
					<div class="col-md-12">
					  <div class="form-group form-group-sm">
						<table class="table table-stripped m-0">
							<tr>
								<td class="w-25 py-0">
									<h6 class="header-label item-name-label"><?php echo $this->lang->line('sales_payment'); ?></h6>
									<?php echo form_dropdown('payment_type', $payment_options, array(), array('id'=>'payment_types', 'class'=>'selectpicker show-menu-arrow header-dropdown d-block', 'data-style'=>'btn-default btn-sm')); ?>
								</td>
								<td class="w-25 py-0">
									<h6 class="header-label item-name-label"><?php echo $this->lang->line('sales_amount_tendered'); ?></h6>
									<?php echo form_input(array('name'=>'amount_tendered', 'value'=>to_currency_no_money($amount_due), 'class'=>'form-control input-sm', 'size'=>'5')); ?>
								</td>
								<?php echo form_close(); ?>
								<td class="w-25 py-0">
									<div class="comment-box-container pr-0">
										<div class="form-group form-group-sm align-center mt-15">
										<?php echo form_checkbox(array('name'=>'recv_print_after_sale', 'id'=>'recv_print_after_sale', 'class'=>'checkbox m-0', 'value'=>1, 'checked'=>$print_after_sale)); ?>
											<h6 class="header-label m-10 min-w-100"><?php echo $this->lang->line('receivings_print_after_sale'); ?></h6>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="py-0">
								<?php
									// Only show this part if there is at least one payment entered.
									if(count($payments) > 0)
									{
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
													foreach($payments as $payment_id => $payment)
													{
													?>
														<tr>
															<td><span data-payment-id="<?php echo $payment_id; ?>" class="delete_payment_button"><span class="glyphicon glyphicon-trash"></span></span></td>
															<td><?php echo $payment['payment_type']; ?></td>
															<td style="text-align: right;"><?php echo to_currency($payment['payment_amount']); ?></td>
														
														</tr>
													<?php
													if($payment['payment_type'] == $this->lang->line('sales_due'))
														{
															$due_payment = TRUE;
														}
													}
													?>
												</tbody>
											</table>
										<?php
									}
								?>
								<?php
									if(count($cart) > 0)
									{
									?>
										<div id="finish_sale" class="discount-box justify-content-space-between">
											<?php
											if($mode == 'requisition')
											{
											?>
												<?php echo form_open($controller_name."/requisition_complete", array('id'=>'finish_receiving_form', 'class'=>'form-horizontal')); ?>
													<div class="form-group form-group-sm">
														<div class="btn btn-sm btn-danger pull-left" id='cancel_receiving_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('receivings_cancel_receiving'); ?></div>
														
														<!-- <div class="btn btn-sm btn-success pull-right" id='finish_receiving_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('receivings_complete_receiving'); ?></div> -->
													</div>
												<?php echo form_close(); ?>
											<?php
											}
											else
											{
											?>
												<div class="d-flex gap-10 align-end">
													<?php echo form_open($controller_name."/set_total_discount", array('id'=>'set_total_discount', 'class'=>'form-horizontal')); ?>
													<table>
														<tr>
															<th>
																<h6 class="header-label item-name-label"><?php echo $this->lang->line('receivings_discount'); ?></h6>
																<div class="input-group">
																	<?php echo form_input(array('name'=>'total_discount', 'id'=>'total_discount', 'class'=>'form-control input-sm', 'value'=>$total_discount, 'onClick'=>'this.select();')); ?>
																	<span class="input-group-btn">
																		<?php echo form_checkbox(array('id'=>'total_discount_toggle', 'name'=>'total_discount_toggle', 'value'=>1, 'data-toggle'=>"toggle", 'data-size'=>'small', 'data-onstyle'=>'success', 'data-on'=>'<b>'.$this->config->item('currency_symbol').'</b>', 'data-off'=>'<b>%</b>', 'checked'=>$total_discount_type)); ?>
																	</span>
																</div>
															</th>
														</tr>
													</table>
													<?php echo form_close(); ?>
													<?php echo form_open($controller_name."/complete", array('id'=>'finish_receiving_form', 'class'=>'form-horizontal')); ?>
														<div class='btn btn-sm btn-danger pull-left' id='cancel_receiving_button'><span class="glyphicon glyphicon-remove"></span></div>
													<?php echo form_close(); ?>
												</div>
											<?php
											}
											?>
										</div>
									<?php
									}
								?>
								</td>
								<td class="py-0">
									<div class="pl-15r form-group form-group-sm">
										<h6 class="header-label item-name-label"><?php echo $this->lang->line('common_comments'); ?></h6>
										<?php echo form_textarea(array('name'=>'comment', 'id'=>'comment', 'class'=>'form-control input-sm resize-none text-area-height', 'value'=>$comment));?>
									</div>
								</td>
								<td class="py-0">
								    <div class="m-12">
									  <div class='btn btn-sm btn-success theme-color theme-transition-effect pull-left' id='add_payment_button' tabindex="<?php echo ++$tabindex; ?>"><span class="glyphicon glyphicon-credit-card">&nbsp</span><?php echo $this->lang->line('sales_add_payment'); ?></div>
									</div>
								</td>
							</tr>
						</table>
					  </div>
					</div>
					<?php
					}
				}
				else {
						$due_payment=FALSE;
						if(count($payments) > 0)
						{
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
									foreach($payments as $payment_id => $payment)
									{
									?>
										<tr>
											<td><span data-payment-id="<?php echo $payment_id; ?>" class="delete_payment_button"><span class="glyphicon glyphicon-trash"></span></span></td>
											<td><?php echo $payment['payment_type']; ?></td>
											<td style="text-align: right;"><?php echo to_currency($payment['payment_amount']); ?></td>
										
										</tr>
									<?php
									if($payment['payment_type'] == $this->lang->line('sales_due'))
										{
											$due_payment = TRUE;
										}
									}
									?>
								</tbody>
							</table>
						<?php
						}
							if(count($cart) > 0)
						{   
							if(!$due_payment || ($due_payment))
								{
								?>
								<div class='btn btn-sm btn-success pull-right' id='finish_receiving_button' tabindex="<?php echo ++$tabindex; ?>"><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div>
									<?php }
										?>
									<div id="finish_sale">
									<?php
									if($mode == 'requisition')
									{
									?>
									<?php echo form_open($controller_name."/requisition_complete", array('id'=>'finish_receiving_form', 'class'=>'form-horizontal')); ?>
										<div class="form-group form-group-sm">
											<div class="btn btn-sm btn-danger pull-left" id='cancel_receiving_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('receivings_cancel_receiving'); ?></div>
											
											<!-- <div class="btn btn-sm btn-success pull-right" id='finish_receiving_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('receivings_complete_receiving'); ?></div> -->
										</div>
									<?php echo form_close(); ?>
									<?php
									}
									else
									{
									?>
									<?php echo form_open($controller_name."/set_total_discount", array('id'=>'set_total_discount', 'class'=>'form-horizontal')); ?>
									<table>
										<tr>
											<th style="width: 55%;"><?php echo $this->lang->line('receivings_discount'); ?></th>
											<th style="width: 45%; text-align: right;">
												<div class="input-group">
													<?php echo form_input(array('name'=>'total_discount', 'id'=>'total_discount', 'class'=>'form-control input-sm', 'style'=>'margin-top: 8px', 'value'=>$total_discount, 'onClick'=>'this.select();')); ?>
													<span class="input-group-btn">
														<?php echo form_checkbox(array('id'=>'total_discount_toggle', 'name'=>'total_discount_toggle', 'value'=>1, 'data-toggle'=>"toggle", 'data-size'=>'small', 'data-onstyle'=>'success', 'data-on'=>'<b>'.$this->config->item('currency_symbol').'</b>', 'data-off'=>'<b>%</b>', 'checked'=>$total_discount_type)); ?>
													</span>
												</div>
											</th>
										</tr>
									</table>
									<?php echo form_close(); ?>
									<?php echo form_open($controller_name."/complete", array('id'=>'finish_receiving_form', 'class'=>'form-horizontal')); ?>
									<div class='btn btn-sm btn-danger pull-left' id='cancel_receiving_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('receivings_cancel_receiving') ?></div>
									
									<!-- <div class='btn btn-sm btn-success pull-right' id='finish_receiving_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('receivings_complete_receiving') ?></div> -->
								
									<?php echo form_close(); ?>
									<?php
									}
									?>
							    </div>
						<?php
						}
						?>
				<?php } ?>
		</div>
		<div class="register-invoice-details py-0">
				<div class="justify-content-space-between">
					<div class="receiving-invoice-label"> Quantity </div>
					<div class="receiving-invoice-qty"><?php echo $total_units; ?></div>
				</div>
				<div class="justify-content-space-between">
					<?php
						$discount = "";
						$discounted_total = $item['discounted_total'] ? $item['discounted_total'] : "";
						$final_total = $item['total'] ? $item['total'] : "";
						$discount = ((floor($final_total * 100) - floor($discounted_total * 100)) / 100);
					?>
					<div class="receiving-invoice-label"> Discount </div>
					<div class="receiving-invoice-qty"><?php echo to_currency($discount ? $discount : "0"); ?></div>
				</div>
				<div class="justify-content-space-between">
					<div class="receiving-invoice-label"> <?php echo $this->lang->line('receiving_Tax'); ?> </div>
					<div class="receiving-invoice-qty"><?php echo to_currency($total_taxable_amount); ?></div>
				</div>
				<div class="justify-content-space-between">
					<input type="hidden" name="total_amount" id="total_amount" value="<?php echo $total; ?>" />
					<div class="receiving-invoice-label"> <?php echo $this->lang->line('sales_total'); ?> </div>
					<div class="receiving-invoice-label color-theme"> <?php echo to_currency($total); ?> </div>
				</div>
		</div>
	</div>
</div>




<script type="text/javascript">
$(document).ready(function()
{
	const redirect = function() {
		window.location.href = "<?php echo site_url('receivings'); ?>";
	};

	$("#remove_supplier_button").click(function()
	{
		$.post("<?php echo site_url('receivings/remove_supplier'); ?>", redirect);
	});

	$('#add_payment_button').click(function() {
		$('#add_payment_form').submit();
	});

	//$('#payment_types').change(check_payment_type).ready(check_payment_type);

	$('#amount_tendered').keypress(function(event) {
		if(event.which == 13)
		{
			$('#add_payment_form').submit();
		}
	});


	$(".delete_payment_button").click(function() {
		const item_id = $(this).data('payment-id');
		const formatted_item_id = item_id.replace(' ', '_');
		$.post("<?php echo site_url('receivings/delete_payment/'); ?>" + formatted_item_id, redirect);
	});

	$(".delete_item_button").click(function() {
		const item_id = $(this).data('item-id');
		$.post("<?php echo site_url('receivings/delete_item/'); ?>" + item_id, redirect);
	});

	$("#item").autocomplete(
	{
		source: '<?php echo site_url($controller_name."/stock_item_search"); ?>',
		minChars:0,
		delay:10,
		autoFocus: false,
		select:	function (a, ui) {
			$(this).val(ui.item.value);
			$("#add_item_form").submit();
			return false;
		}
	});

	$('#item').focus();

	$('#item').keypress(function (e) {
		if (e.which == 13) {
			$('#add_item_form').submit();
			return false;
		}
	});

	$('#item').blur(function()
	{
		$(this).attr('value',"<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
	});

	$('#comment').keyup(function() 
	{
		$.post('<?php echo site_url($controller_name."/set_comment");?>', {comment: $('#comment').val()});
	});

	$('#recv_reference').keyup(function() 
	{
		$.post('<?php echo site_url($controller_name."/set_reference");?>', {recv_reference: $('#recv_reference').val()});
	});

	$("#recv_print_after_sale").change(function()
	{
		$.post('<?php echo site_url($controller_name."/set_print_after_sale");?>', {recv_print_after_sale: $(this).is(":checked")});
	});

	$('#item,#supplier').click(function()
	{
		$(this).attr('value','');
	});

	$("#supplier").autocomplete(
	{
		source: '<?php echo site_url("suppliers/suggest"); ?>',
		minChars:0,
		delay:10,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#select_supplier_form").submit();
		}
	});

	dialog_support.init("a.modal-dlg, button.modal-dlg");

	$('#supplier').blur(function()
	{
		$(this).attr('value',"<?php echo $this->lang->line('receivings_start_typing_supplier_name'); ?>");
	});

	$("#finish_receiving_button").click(function()
	{
		$('#finish_receiving_form').submit();
	});

	$("#cancel_receiving_button").click(function()
	{
		if (confirm('<?php echo $this->lang->line("receivings_confirm_cancel_receiving"); ?>'))
		{
			$('#finish_receiving_form').attr('action', '<?php echo site_url($controller_name."/cancel_receiving"); ?>');
			$('#finish_receiving_form').submit();
		}
	});

	$("#cart_contents input").keypress(function(event)
	{
		if (event.which == 13)
		{
			$(this).parents("tr").prevAll("form:first").submit();
		}
	});

	table_support.handle_submit = function(resource, response, stay_open)
	{
		if(response.success)
		{
			if (resource.match(/suppliers$/))
			{
				$("#supplier").val(response.id);
				$("#select_supplier_form").submit();
			}
			else
			{
				$("#item").val(response.id);
				if (stay_open)
				{
					$("#add_item_form").ajaxSubmit();
				}
				else
				{
					$("#add_item_form").submit();
				}
			}
		}
	}

	$('[name="price"],[name="mrp"], [name="batch_number"],[name="quantity"],[name="receiving_quantity"],[name="discount"],[name="description"],[name="serialnumber"]').change(function() {
		$(this).parents("tr").prevAll("form:first").submit()
	});

	$('[name="discount_toggle"]').change(function() {
		var input = $("<input>").attr("type", "hidden").attr("name", "discount_type").val(($(this).prop('checked'))?1:0);
		$('#cart_'+ $(this).attr('data-line')).append($(input));
		$('#cart_'+ $(this).attr('data-line')).submit();
	});

	let originalTotal = parseFloat($("#sale_totals tr:first-child td:nth-child(2)").text().replace(/[^0-9.-]+/g, "")) || 0;
	function updateTotals() {
		let total = originalTotal
		let discount = parseFloat($("#total_discount").val()) || 0;
		let discountType = $("#total_discount_toggle").prop("checked"); // false(0) if % discount, true(1) if fixed amount
		if (!discountType) { 
			total = total - (total * discount / 100);
		} else { 
			total = total - discount;
		}
		total = total < 0 ? 0 : total;
		$("#sale_totals tr:first-child td:nth-child(2)").text(total.toFixed(2));
	}
	// Attach event listeners to update totals when the discount value or type changes
	$("#total_discount, #total_discount_toggle").on('input change', updateTotals);
	// Initial call to set the totals correctly on page load
	updateTotals();

	});

</script>


<?php $this->load->view("partial/footer"); ?>
