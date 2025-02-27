<?php $this->load->view("partial/header"); ?>

<?php
if(isset($error))
{
	echo "<div class='alert alert-dismissible alert-danger'>".$error."</div>";
}

if(!empty($warning))
{
	echo "<div class='alert alert-dismissible alert-warning'>".$warning."</div>";
}

if(isset($success))
{
	echo "<div class='alert alert-dismissible alert-success'>".$success."</div>";
}
?>

<div id="register_wrapper">

<!-- Top register controls -->

	<?php echo form_open($controller_name."/change_mode", array('id'=>'mode_form', 'class'=>'form-horizontal panel panel-default')); ?>
		<div class="panel-body form-group">
			<ul>
				<li class="pull-left first_li">
					<label class="control-label"><?php echo $this->lang->line('payment_mode'); ?></label>
				</li>
				<li class="pull-left">
					<?php echo form_dropdown('mode', $modes, $mode, array('onchange'=>"$('#mode_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
				</li>
				<!-- <?php
				if($this->Employee->has_grant('reports_sales', $this->session->userdata('person_id')))
				{
				?>
					<li class="pull-right">
						<?php echo anchor($controller_name."/manage", '<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'),
									array('class'=>'btn btn-primary btn-sm', 'id'=>'sales_takings_button', 'title'=>$this->lang->line('sales_takings'))); ?>
					</li>
				<?php
				}
				?> -->

			</ul>
		</div>
	<?php echo form_close(); ?>
	<?php if($mode=="customer")
				{
				 echo form_open($controller_name."/change_customer", array('id'=>'customer_form', 'class'=>'form-horizontal panel panel-default'));
				?>
				<li class="pull-left">
					<label class="control-label"><?php echo $this->lang->line('select_customer'); ?></label>
				</li>
				<li class="pull-left">
					<?php echo form_dropdown('customer', $customers, $customer, array('onchange'=>"$('#customer_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
				</li>
				<?php 
				echo form_close();
				if($customer!="None")
				{
					echo form_open($controller_name."/add_bill", array('id'=>'bill_form', 'class'=>'form-horizontal panel panel-default'));
				
				?>
				<li class="pull-left">
					<?php echo form_dropdown('payment_id', $bills,"None", array('onchange'=>"$('#bill_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
				</li>
				<?php
				echo form_close();
				}
				}
				else
				{
					echo form_open($controller_name."/change_supplier", array('id'=>'supplier_form', 'class'=>'form-horizontal panel panel-default'));
				?>
				<li class="pull-left">
					<label class="control-label"><?php echo $this->lang->line('select_supplier'); ?></label>
				</li>
				<li class="pull-left">
					<?php echo form_dropdown('supplier', $suppliers, $supplier, array('onchange'=>"$('#supplier_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
				</li>
				<?php
				echo form_close();
				if($supplier!="None")
				{
					echo form_open($controller_name."/add_bill", array('id'=>'bill_form', 'class'=>'form-horizontal panel panel-default'));
				
				?>
				<li class="pull-left">
					<?php echo form_dropdown('payment_id', $bills,"None", array('onchange'=>"$('#bill_form').submit();", 'class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit')); ?>
				</li>
				<?php
				echo form_close();
				}
				}
				?>
<!-- Sale Items List -->

	<table class="sales_table_100" id="register">
		<thead>
			<tr>
				<th style="width: 5%; "><?php echo $this->lang->line('common_delete'); ?></th>
				<th style="width: 15%;"><?php echo $this->lang->line('bill_no'); ?></th>
				<th style="width: 30%;"><?php echo $this->lang->line('payment_due_amount'); ?></th>
				<th style="width: 20%;"><?php echo $this->lang->line('sales_payment_type'); ?></th>
				<th style="width: 30%;"><?php echo $this->lang->line('sales_payment_amount'); ?></th>
			</tr>
		</thead>

		<tbody id="cart_contents">
			<?php

			if(count($cart) == 0)
			{
			?>
				<tr>
					<td colspan='8'>
						<div class='alert alert-dismissible alert-info'><?php echo $this->lang->line('payment_no_bill'); ?></div>
					</td>
				</tr>
			<?php
			}
			else
			{
				foreach(array_reverse($cart, TRUE) as $line=>$payment)
				{
					
				?>
					<?php echo form_open($controller_name."/update_bill/$line", array('class'=>'form-horizontal', 'id'=>'cart_'.$line)); ?>
						<tr>
								<td <?php echo $cell_style; ?>>
									<span data-bill-no="<?php echo $line; ?>" class="delete_payment_button"><span class="glyphicon glyphicon-trash"></span></span>
									<?php echo form_input(array('type'=>'hidden', 'name'=>'bill_no', 'value'=>$payment['bill_no']));?>
								</td>
								<td <?php echo $cell_style; ?>style="align: left;">
									<?php echo 'Bill-'.$payment['bill_no']; ?>
								</td>
								<td style="align: right;">
								<?php echo form_input(array( 'name'=>'due_amount', 'value'=>$payment['due_amount'], 'readonly'=>'true','class' => 'readonly-input'));?>
								</td>
								<td <?php echo $cell_style; ?>style="align: center;">
								<?php
								 echo form_dropdown('payment_type', $payment_options, $payment['payment_type'],  array(
									'id' => 'payment_type_' . $payment['bill_no'], 
									'onchange' => 'this.select();', // Pass both the dropdown value and payment_id
									'class' => 'selectpicker show-menu-arrow',
									'data-style' => 'btn-default btn-sm',
									'data-width' => 'medium'
								)); ?>
								</td>
								<td <?php echo $cell_style; ?>>
									<?php 
									echo form_input(array(
										'name' => 'payment_amount', 
										'class' => 'form-control input-sm price-input', 
										'value' => to_currency_no_money($payment['payment_amount']),  
										'tabindex' => $payment['bill_no'], 
										'onClick' => 'this.select();'
									));?>
								</td>
						</tr>
					
					<?php echo form_close(); ?>
			<?php
			}?>
			<tr class='btn'>
				<th><div class='btn btn-sm btn-success pull-right' id='finish_sale_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div></th>
				<th>
				<?php echo form_open($controller_name."/cancel", array('id'=>'buttons_form')); ?>
				<div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>
				<?php echo form_close(); ?>
				</th>
			</tr>
		<?php }
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	// Initialize tooltip
	$('[data-toggle="tooltip"]').tooltip();

	const redirect = function() {
		window.location.href = "<?php echo site_url('payments'); ?>";
	};

	$(".delete_payment_button").click(function()
	{
		const bill_no = $(this).data('bill-no');
		$.post("<?php echo site_url('payments/delete_payment/'); ?>" + bill_no, redirect);
	});

	$('#finish_sale_button').click(function() {
		$('#buttons_form').attr('action', "<?php echo site_url($controller_name.'/complete'); ?>");
		$('#buttons_form').submit();
	});
	

	$('#cancel_sale_button').click(function() {
		if(confirm("<?php echo $this->lang->line('payment_confirm_cancel_payments'); ?>"))
		{
			$('#buttons_form').attr('action', "<?php echo site_url($controller_name.'/cancel'); ?>");
			$('#buttons_form').submit();
		}
	});

	$('#finish_sale_button').keypress(function(event) {
		if(event.which == 13)
		{
			$('#finish_sale_form').submit();
		}
	});
	$('#cart_contents input').keypress(function(event) {
		if(event.which == 13)
		{
			$(this).parents('tr').prevAll('form:first').submit();
		}
	});
	$(document).ready(function() {
    // Bind to the change event of all payment_type dropdowns
    $('[id^="payment_type_"]').change(function() {
        $(this).closest('form').submit();  // Submit the closest form to the dropdown
    });
	});


	dialog_support.init('a.modal-dlg, button.modal-dlg');

	
});



// Add Keyboard Shortcuts/Hotkeys to Sale Register
document.body.onkeyup = function(e)
{
	
	switch(event.keyCode) 
	{
		case 27: // ESC Cancel Current Sale
			$("#cancel_sale_button").click();
			break;		  
    }
}

</script>

<!-- CSS for the Tooltip-like Bubble -->
<style>
.readonly-input {
	background-color: transparent;  /* Remove the background color */
	border: none;                   /* Remove the border */
	color: #000;                    /* Set the text color to black */
	font-size: 14px;                 /* Adjust font size if needed */
	pointer-events: none;           /* Disable all mouse events (no clicking, selecting, etc.) */
	align:center;
}
/* Tooltip bubble style */
.info-bubble {
    position: absolute;
    background-color: #f7f7f7; 
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    max-width: 260px; /* Adjust the width for a larger box */
    display: none; /* Initially hidden */
    border: 1px solid #ddd; /* Light border for the box */
    color: #333; /* Dark text for better readability */
    font-family: Arial, sans-serif; /* Use a simple font */
    font-size: 12px; /* Adjust font size */
}

/* The arrow pointing upwards */
.info-bubble:after {
    content: '';
    position: absolute;
    bottom: 100%; /* Position the arrow above the box */
    left: calc(50% + 40px); /* Center the arrow horizontally in the bubble */
    transform: translateX(-50%); /* Center the arrow */
    border-width: 8px; /* Size of the arrow */
    border-style: solid;
    border-color: transparent transparent #f7f7f7 transparent; /* Arrow color */
}

.info-bubble p {
    margin: 5px 0;
    color: #555;
}

.info-bubble strong {
    color: #007bff; /* Make strong text blue for emphasis */
}

.info-icon {
    cursor: pointer;
    color: #007bff;
    font-size: 18px; /* Size of the icon */
}

</style>

<?php $this->load->view("partial/footer"); ?>