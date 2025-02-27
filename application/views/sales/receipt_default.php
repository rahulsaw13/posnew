<style>
   /* @media print {
      html, body {
        height: 100%;
		margin-right: 84rem;
		position: absolute;
		top:0px;
      }
   }*/
   body {
      font-weight: 500;
      line-height: 15px;
   } 
   .print_receipt {
		margin-right: 84rem;
		position: absolute;
		top:0px;
	}
  
   .invoice-container {
   /* border: 1px solid #000; */
   padding: 10px;
   width: 80mm;
   }
   .title {
   text-align: center;
   font-size: 18px;
   margin:10px;
   text-transform: uppercase;
   }
   .address {
   text-align: center;
   margin-bottom: 20px;
   }
   .gst {
   text-align: center;
   margin-bottom: 10px;
   text-transform: uppercase;
   }
   .invoice-details {
   margin-top: 10px;
   }
   table th, table td {
   padding: 5px;	
   }
   .tax-summary {
   text-align: center;
   border-collapse: collapse;
   }
   .footer {
   text-align: center;
   border-top: dashed 1px black;
   margin-top: 15px;
   font-size: 0.7em;
   }
</style>
<div class="print_receipt">
<div id="receipt_wrapper" style="width:80mm;box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); padding: 0mm; margin: 2mm; background: #FFF;font-size: <?php echo $this->config->item('receipt_font_size')."px;"; ?>" >
   <div class="invoice-container" id="receipt_header">
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
				<div  class="title"><strong><?php echo $this->config->item('company'); ?></strong></div>
			<?php
			}
			?>
		<span style="text-transform: uppercase;"><strong><?php echo $this->lang->line('sales_invoice'); ?></strong></span>
		<div></br><?php echo nl2br($this->config->item('address')); ?></div>
		<div><?php echo $this->lang->line('config_email') . ": " .$this->config->item('email'); ?></div>
		<div style="padding-top:4px;"><?php echo $this->lang->line('sale_phone_no') . ": " .$this->config->item('phone'); ?></div>
     
			<?php
			if (!empty($this->config->item('gst_number'))) {
			?>
				<div class="gst"><strong><?php echo $this->lang->line('sales_gst_number') . ": " . $this->config->item('gst_number'); ?></strong></div>
			<?php
			}
			?>
		<div id="receipt_general_info" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2px; padding-top: 9px; padding-left: 10px;">
			<?php
			if (isset($customer)) {
			?>
			    <div id="customer" style="font-size: 0.8em; text-align:left;"><?php echo "Name" . ": " . $customer; ?></div>
			    
			<?php
			}
			?>
			<div class="sales_date" style="font-size: 0.8em; text-align:right;"><?php echo $this->lang->line('common_date') .": " .$transaction_date; ?></div>
            <?php
            	if (isset($customer_phone_number)) {
			?>
            <div id="cust_phone_no" style="font-size: 0.8em; text-align:left;"><?php echo "Mobile" .":" . $customer_phone_number; ?></div>
			<?php
			}
			?>
			<div class="sales_date" style="font-size: 0.8em; text-align:right;"><?php echo $this->lang->line('common_time') .": " .substr($transaction_time, 10); ?></div>
			<div id="sale_id" style="font-size: 0.8em; text-align:left;"><?php echo $this->lang->line('sales_invoice_number') . ": " . $sale_id; ?></div>
			

			<?php
			if (!empty($invoice_number)) {
			?>
				<div id="invoice_number" style="font-size: 0.8em; text-align:right;"><?php echo $this->lang->line('sales_invoice_number') . ": " . $invoice_number; ?></div>
			<?php
			}
			?>
			<!--<div id="employee" style="font-size: 0.8em; color: #222;">< ?php echo $this->lang->line('employees_employee') . ": " . $employee; ?></div>-->

		</div>
      <div>
         <table style="width: 100%">
            <tr style="border-bottom: dashed 1px black; border-top: dashed 1px black; font-size: 0.8em;">
               <td style="text-align: start;"><strong>Item</strong></td>
               <td><strong>Qty</strong></td>
               <td><strong><?php echo $this->lang->line('sales_mrp'); ?></strong></td>
			   <td><strong><?php echo $this->lang->line('sales_discount'); ?></strong></td>
               <td style="text-align: end;"><strong><?php echo $this->lang->line('sales_net_amount'); ?></strong></td>
            </tr>
			<?php
			$index=0;
			$disc_items=0;
			$total_saving=0;
			foreach ($cart as $line => $item) {
				if ($item['print_option'] == PRINT_YES) {
					$index+=$item['quantity']; 
					if($item['discounted_total']>0)
					{
						++$disc_items;
					}
					$total_saving+= $item['total']-$item['discounted_total'];
			?>
					<tr style="font-size: 0.8em;">
						<td style="text-align: start;"><?php echo ucfirst($item['name']); ?></td>
						<td style="text-align: center;"><?php echo to_quantity_decimals($item['quantity']); ?></td>
						<td><?php echo $item['price']; ?></td>
						<td><?php echo $item['total']-$item['discounted_total'];?></td>
					    <td class="total-value" style="text-align: end;"><?php echo round($item['discounted_total'], totals_decimals(), PHP_ROUND_HALF_UP); ?></td>
				</tr>

				<!-- <tr style="padding: 2px; font-size: 0.8em;">
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
					</tr> -->
			<?php
					        if ($item['discount'] > 0) {
					    ?>
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
						
			<?php
					}
				}
			}
			?>
			
            </tr>
            <tr style="border-top: dashed 1px black;text-align:justify;text-transform: uppercase; font-size: 0.8em;">
			<?php 
			  foreach(array_reverse($payments) as $payment_id=>$payment) {
				$only_sale_check |= $payment['payment_type'] == $this->lang->line('sales_check');
				$splitpayment = explode(':', $payment['payment_type']);
				$show_giftcard_remainder |= $splitpayment[0] == $this->lang->line('sales_giftcard');
				if ($splitpayment[0]=="Cash Adjustment")
			      $round_off= $payment['payment_amount'];
		     } ?>
               <td colspan="2" style="text-align: start;"><strong><?php echo $this->lang->line('sales_total'); ?></strong></td>
               <td  style="text-align: center;"><strong>:</strong></td>
               <td colspan="2" style="text-align: end;"><?php echo to_currency($total-  $round_off); ?></td>
            </tr>
            <?php
               $only_sale_check = FALSE;
               $show_giftcard_remainder = FALSE;
               foreach(array_reverse($payments) as $payment_id=>$payment) {
                  $only_sale_check |= $payment['payment_type'] == $this->lang->line('sales_check');
                  $splitpayment = explode(':', $payment['payment_type']);
                  $show_giftcard_remainder |= $splitpayment[0] == $this->lang->line('sales_giftcard');
            ?>
               <tr style="font-size: 0.8em;">
                  <td colspan="2" style="text-align: start;"><strong><?php echo ($splitpayment[0]=="Cash Adjustment"?"Round-off":$splitpayment[0]) ; ?></strong></td>
                  <td style="text-align: center;"><strong>:</strong></td>
                  <td colspan="2" style="text-align: end;"><?php echo to_currency( $payment['payment_amount'] * 1); ?></td>
               </tr>
            <?php } ?>
         </table>
         <table style="width: 100%;text-align:center;border-bottom: dashed 1px black; border-top: dashed 1px black;text-transform: uppercase;">
            <tr style=" font-size: 0.8em;">
               <td><strong>No of Qty:  <?php echo $index ?> | DISCOUNT ITEMS :  <?php echo $disc_items ?> | TENDERED : <?php echo to_currency($total);?> |  CHANGE : <?php echo to_currency($amount_change);?></strong></td>
            </tr>
            <tr>
               <td style=" font-size: 0.8em;"><strong>You Saved Rs : <?php echo to_currency($total_saving)?></td>
            </tr>
         </table>
      </div>
      <div>
         <div style="text-align:center;margin-top: 12px;font-size: 0.8em;"><strong>TAX SUMMARY</strong></div>
         <table style="width: 100%;border: 1px solid black; border-collapse: collapse;text-transform: uppercase; font-size: 0.8em;">
            <tr style="border: 1px solid black;">
               <th style="border: 1px solid black;text-align:center;">Taxable Value</th>
               <th style="border: 1px solid black;text-align:center;">CGST</th>
               <th style="border: 1px solid black;text-align:center;">SGST</th>
            </tr>
            <tr style="border: 1px solid black;">
			    <td style="border: 1px solid black;text-align:center;"><?php echo to_currency($total-$tax_total);?></td>
				<td style="border: 1px solid black;text-align:center;"><?php echo to_currency($tax_total/2);?></td>
				<td style="border: 1px solid black;text-align:center;"><?php echo to_currency($tax_total/2);?></td>
            </tr>
         </table>
      </div>
      <div class="footer">
        <div><?php echo nl2br($this->config->item('payment_message')); ?></div>
		 <div style='padding:2%;'><?php echo nl2br($this->config->item('return_policy')); ?></div>
      </div>
      <div style="text-align:center;margin-top:5px;">
         <img src='data:image/png;base64,<?php echo $barcode; ?>' /><br>
		 <?php echo $sale_id; ?>
      </div>
   </div>
</div>
</div>