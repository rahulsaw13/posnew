<style>
	.print_receipt {
		margin-right: 84rem;
		position: absolute;
	}

	#receipt_items td {
		padding: 1px;
		/* border:1px dotted black; */
	}

	/* kya  */

	#receipt_wrapper #barcode {
		margin-top: 7px;
	}

	#receipt_wrapper #barcode img {
		height: 15px;
	}

	.tax_summary th {
		border: 1px dotted black;
	}

	.tax_summary td {
		border: 1px dotted black;
	}

	.tax_summary tr {
		border: 1px dotted black;
	}
</style>
<div class="print_receipt">
	<div id="receipt_wrapper" style="box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); padding: 2mm; margin: 0; width: 55mm; height:83mm; background: #FFF; font-size: <?php echo $this->config->item('receipt_font_size'); ?>px;">
		<center id="receipt_header">
			<?php
			if ($this->config->item('company_logo') != '') {
			?>
				<div id="company_name">
					<img id="image" style="height: 60px; width: 60px; background-size: 60px 60px;" src="<?php echo base_url('uploads/' . $this->config->item('company_logo')); ?>" alt="company_logo" />
				</div>
			<?php
			}
			?>

			<?php
			if ($this->config->item('receipt_show_company_name')) {
			?>
				<div id="company_name" style="font-size: 1em; color: #222;"><?php echo $this->config->item('company'); ?></div>
			<?php
			}
			?>

			<div id="company_address" style="font-size: 0.7em; color: #666;"><?php echo nl2br($this->config->item('address')); ?></div>
			<div style="font-size: 0.7em; color: #666;"><?php echo $this->config->item('phone'); ?></div>
			<?php
			if (!empty($this->config->item('gst_number'))) {
			?>
				<div id="gst_number" style="font-size: 0.7em; color: #666;"><?php echo $this->lang->line('sales_gst_number') . ": " . $this->config->item('gst_number'); ?></div>
			<?php
			}
			?>
			<div id="sale_receipt" style="font-size: 0.8em; color: #222;"><?php echo $this->lang->line('sales_receipt'); ?></div>
			<!-- <div id="sale_time" style="font-size: 0.7em; color: #666;"><?php echo $transaction_time ?></div> -->
		</center>

		<div id="receipt_general_info" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 4px; padding-top: 9px; padding-left: 15px;">
			<?php
			if (isset($customer)) {
			?>
				<div id="customer" style="font-size: 0.7em; color: #222;"><?php echo $this->lang->line('customers_customer') . ": " . $customer; ?></div>
			<?php
			}
			?>

			<div id="sale_id" style="font-size: 0.7em; color: #000;"><?php echo $this->lang->line('sales_id') . ": " . $sale_id; ?></div>
			<div class="sales_date" style="font-size: 0.7em; color: #222;"><?php echo "Date: " . date("Y.m.d"); ?></div>

			<?php
			if (!empty($invoice_number)) {
			?>
				<div id="invoice_number" style="font-size: 0.7em; color: #666;"><?php echo $this->lang->line('sales_invoice_number') . ": " . $invoice_number; ?></div>
			<?php
			}
			?>

			<div id="employee" style="font-size: 0.7em; color: #222;"><?php echo $this->lang->line('employees_employee') . ": " . $employee; ?></div>
			<div class="sales_time" style="font-size: 0.7em; color: #222;"><?php echo "Time: " . date("h:i:sa"); ?></div>

		</div>

		<table id="receipt_items" style="min-height: 65px; text-align: left; margin-bottom:1px;margin-top: 4px;">
			<tr style="padding: 5px; font-size: 0.5em; background: #EEE;">
				<th style="width:40%;"><?php echo $this->lang->line('sales_description_abbrv'); ?></th>
				<th style="width:20%;"><?php echo $this->lang->line('sales_price'); ?></th>
				<th style="width:20%;"><?php echo $this->lang->line('sales_quantity'); ?></th>
				<th style="width:20%;" class="total-value"><?php echo $this->lang->line('sales_total'); ?></th>
				<?php
				if ($this->config->item('receipt_show_tax_ind')) {
				?>
					<th style="width:20%;"></th>
				<?php
				}
				?>
			</tr>
			<?php
			foreach ($cart as $line => $item) {
				if ($item['print_option'] == PRINT_YES) {
			?>
					<tr style="padding: 2px; font-size: 0.5em;">
						<td><?php echo ucfirst($item['name'] . ' ' . $item['attribute_values']); ?></td>
						<td><?php echo to_currency($item['price']); ?></td>
						<td><?php echo to_quantity_decimals($item['quantity']); ?></td>
						<td class="total-value"><?php echo to_currency($item[($this->config->item('receipt_show_total_discount') ? 'total' : 'discounted_total')]); ?></td>
						<?php
						if ($this->config->item('receipt_show_tax_ind')) {
						?>
							<!-- <td><?php echo $item['taxed_flag'] ?></td> -->
						<?php
						}
						?>
					</tr>
					<tr style="padding: 2px; font-size: 0.5em;">
						<?php
						if ($this->config->item('receipt_show_description')) {
						?>
							<td colspan="2"><?php echo $item['description']; ?></td>
						<?php
						}

						if ($this->config->item('receipt_show_serialnumber')) {
						?>
							<td><?php echo $item['serialnumber']; ?></td>
						<?php
						}
						?>
					</tr>
					<?php
					if ($item['discount'] > 0) {
					?>
						<tr style="padding: 2px; font-size: 0.5em;">
							<?php
							if ($item['discount_type'] == FIXED) {
							?>
								<td colspan="3" class="discount" style="font-size: 0.8em; color: #222;"><?php echo to_currency($item['discount']) . " " . $this->lang->line("sales_discount") ?></td>
							<?php
							} elseif ($item['discount_type'] == PERCENT) {
							?>
								<td colspan="3" class="discount" style="font-size: 0.8em; color: #222;"><?php echo to_decimals($item['discount']) . " " . $this->lang->line("sales_discount_included") ?></td>
							<?php
							}
							?>
							<td class="total-value" style="font-size: 0.8em; color: #222;"><?php echo to_currency($item['discounted_total']); ?></td>
						</tr>
			<?php
					}
				}
			}
			?>

			<?php
			if ($this->config->item('receipt_show_total_discount') && $discount > 0) {
			?>
				<tr style="padding: 2px; font-size: 0.5em; background: #EEE;">
					<td colspan="3" style='text-align:right;border-top:2px solid #000000;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
					<td style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($prediscount_subtotal); ?></td>
				</tr>
				<tr style="padding: 2px; font-size: 0.5em; background: #EEE;">
					<td colspan="3" class="total-value"><?php echo $this->lang->line('sales_customer_discount'); ?>:</td>
					<td class="total-value"><?php echo to_currency($discount * -1); ?></td>
				</tr>
			<?php
			}
			?>

			<?php
			if ($this->config->item('receipt_show_taxes')) {
			?>
				<tr style="padding: 2px; font-size: 0.5em; background: #EEE;">
					<td colspan="3" style='text-align:right;border-top:2px solid #000000;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
					<td style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($subtotal); ?></td>
				</tr>
				<?php
				foreach ($taxes as $tax_group_index => $tax) {
				?>
					<tr style="padding: 2px; font-size: 0.5em; background: #EEE;">
						<td colspan="3" class="total-value"><?php echo (float)$tax['tax_rate'] . '% ' . $tax['tax_group']; ?>:</td>
						<td class="total-value"><?php echo to_currency_tax($tax['sale_tax_amount']); ?></td>
					</tr>
				<?php
				}
				?>
			<?php
			}
			?>

			<?php $border = (!$this->config->item('receipt_show_taxes') && !($this->config->item('receipt_show_total_discount') && $discount > 0)); ?>
			<tr style="padding: 2px; font-size: 0.5em; background: #EEE;">
				<td colspan="3" style="text-align:right;<?php echo $border ? 'border-top: 1px solid black;' : ''; ?>"><?php echo $this->lang->line('sales_total'); ?></td>
				<td style="text-align:right;<?php echo $border ? 'border-top: 1px solid black;' : ''; ?>"><?php echo to_currency($total); ?></td>
			</tr>

			<?php
			$only_sale_check = FALSE;
			$show_giftcard_remainder = FALSE;
			foreach ($payments as $payment_id => $payment) {
				$only_sale_check |= $payment['payment_type'] == $this->lang->line('sales_check');
				$splitpayment = explode(':', $payment['payment_type']);
				$show_giftcard_remainder |= $splitpayment[0] == $this->lang->line('sales_giftcard');
			?>
				<tr style="padding: 2px; font-size: 0.5em; background: #EEE;">
					<td colspan="3" style="text-align:right;"><?php echo $splitpayment[0]; ?> </td>
					<td class="total-value"><?php echo to_currency($payment['payment_amount'] * -1); ?></td>
				</tr>
			<?php
			}
			?>

			<!-- <tr>
			<td colspan="4">&nbsp;</td>
		</tr> -->

			<?php
			if (isset($cur_giftcard_value) && $show_giftcard_remainder) {
			?>
				<tr style="padding: 2px; font-size: 0.5em; background: #EEE;">
					<td colspan="3" style="text-align:right;"><?php echo $this->lang->line('sales_giftcard_balance'); ?></td>
					<td class="total-value"><?php echo to_currency($cur_giftcard_value); ?></td>
				</tr>
			<?php
			}
			?>
			<tr style="padding: 2px; font-size: 0.5em; background: #EEE;">
				<td colspan="3" style="text-align:right;"> <?php echo $this->lang->line($amount_change >= 0 ? ($only_sale_check ? 'sales_check_balance' : 'sales_change_due') : 'sales_amount_due'); ?> </td>
				<td class="total-value"><?php echo to_currency($amount_change); ?></td>
			</tr>
		</table>

		<h4 style="font-size: 7px; text-align:center; margin-top: 3.5px;margin-bottom: 3.5px;">Tax Summary</h4>

		<table class="tax_summary" style="border-collapse: collapse; padding-bottom:6px;">
			<tr style="padding: 5px; font-size: 0.5em; background: #EEE; ">
				<!-- <th style="width:40%;">HSN/SAC</th> -->
				<th style="width:40%;">TAX Value</th>
				<th style="width:40%;">CGST</th>
				<th style="width:40%; border-right:none;">SGST</th>
			</tr>
			<tr style="padding: 5px; font-size: 0.5em; background: #EEE;">
				<td><?php echo to_currency($total-$tax_total);?></td>
				<td><?php echo to_currency($tax_total/2);?></td>
				<td><?php echo to_currency($tax_total/2);?></td>
				<td style="border-right: none;">&nbsp;</td>
			</tr>
		</table>

		<!-- <div id="sale_return_policy">
		<?php echo nl2br($this->config->item('return_policy')); ?>
	</div> -->

		<h6 style="font-size: 7px; text-align:center; margin-top: 9.5px;
  margin-bottom: 0;">Thank you for shopping with us!</h6>

		<div id="barcode">
			<img src='data:image/png;base64,<?php echo $barcode; ?>' /><br>
			<div style="font-size: 7px;"><?php echo $sale_id; ?></div>
		</div>
	</div>
</div>