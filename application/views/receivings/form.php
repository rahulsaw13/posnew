<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open("receivings/save/".$receiving_info['receiving_id'], array('id'=>'receivings_edit_form', 'class'=>'form-horizontal')); ?>
	<fieldset id="receiving_basic_info">
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('receivings_receipt_number'), 'supplier', array('class'=>'control-label col-xs-3')); ?>
			<?php echo anchor('receivings/receipt/'.$receiving_info['receiving_id'], 'RECV ' . $receiving_info['receiving_id'], array('target'=>'_blank', 'class'=>'control-label col-xs-8', "style"=>"text-align:left"));?>
		</div>
		
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('receivings_date'), 'date', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
						'name'	=> 'date',
						'value'	=> to_datetime(strtotime($receiving_info['receiving_time'])),
						'id'	=> 'datetime',
						'class'	=> 'datetime form-control input-sm',
        					'readonly' => 'readonly'));
				?>
			</div>
		</div>
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('receivings_supplier'), 'supplier', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array('name' => 'supplier_name', 'value' => $selected_supplier_name, 'id' => 'supplier_name', 'class'=>'form-control input-sm'));?>
				<?php echo form_hidden('supplier_id', $selected_supplier_id);?>
			</div>
		</div>
		<?php
		if($balance_due)
		{
		?>
			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('sales_payment'), 'payment_new', array('class'=>'control-label col-xs-3')); ?>
				<div class='col-xs-4'>
					<?php echo form_dropdown('payment_type_new', $new_payment_options, $payment_type_new, array('id'=>'payment_types_new', 'class'=>'form-control')); ?>
				</div>
				<div class='col-xs-4'>
					<div class="input-group input-group-sm">
						<?php if(!currency_side()): ?>
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
						<?php endif; ?>
						<?php echo form_input(array('name'=>'payment_amount_new', 'value'=>$payment_amount_new, 'id'=>'payment_amount_new', 'class'=>'form-control input-sm'));?>
						<?php if(currency_side()): ?>
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php
		}
		?>

		<?php 
		$i = 0;
		foreach($payments as $row)
		{
		?>
			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('sales_payment'), 'payment_'.$i, array('class'=>'control-label col-xs-3')); ?>
				<div class='col-xs-4'>
					<?php // no editing of Gift Card payments as it's a complex change ?>
					<?php echo form_hidden('payment_id_'.$i, $row->payment_id); ?>
					<?php if( !empty(strstr($row->payment_type, $this->lang->line('sales_giftcard'))) ): ?>
						<?php echo form_input(array('name'=>'payment_type_'.$i, 'value'=>$row->payment_type, 'id'=>'payment_type_'.$i, 'class'=>'form-control input-sm', 'readonly'=>'true'));?>
					<?php else: ?>
						<?php echo form_dropdown('payment_type_'.$i, $payment_options, $row->payment_type, array('id'=>'payment_types_'.$i, 'class'=>'form-control')); ?>
					<?php endif; ?>
				</div>
				<div class='col-xs-4'>
					<div class="input-group input-group-sm">
						<?php if(!currency_side()): ?>
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
						<?php endif; ?>
						<?php echo form_input(array('name'=>'payment_amount_'.$i, 'value'=>$row->payment_amount, 'id'=>'payment_amount_'.$i, 'class'=>'form-control input-sm', 'readonly'=>'true'));?>
						<?php if(currency_side()): ?>
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- <div class="form-group">
				<label for="batch_number">Select Batch</label>
				<select class="form-control" name="batch_id" id="batch_id" required>
					<?php foreach ($batches as $batch): ?>
						<option value="<?= $batch['id'] ?>"><?= $batch['batch_number'] ?> - Quantity: <?= $batch['quantity'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="quantity">Quantity to Sell</label>
				<input type="number" class="form-control" name="quantity" id="quantity" required>
			</div> -->

			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('sales_refund'), 'refund_'.$i, array('class'=>'control-label col-xs-3')); ?>
				<div class='col-xs-4'>
					<?php // no editing of Gift Card payments as it's a complex change ?>
					<?php if( !empty(strstr($row->payment_type, $this->lang->line('sales_giftcard'))) ): ?>
						<?php echo form_input(array('name'=>'refund_type_'.$i, 'value'=>$this->lang->line('sales_cash'), 'id'=>'refund_type_'.$i, 'class'=>'form-control input-sm', 'readonly'=>'true'));?>
					<?php else: ?>
						<?php echo form_dropdown('refund_type_'.$i, $payment_options, $this->lang->line('sales_cash'), array('id'=>'refund_types_'.$i, 'class'=>'form-control')); ?>
					<?php endif; ?>
				</div>
				<div class='col-xs-4'>
					<div class="input-group input-group-sm">
						<?php if(!currency_side()): ?>
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
						<?php endif; ?>
						<?php echo form_input(array('name'=>'refund_amount_'.$i, 'value'=>$row->cash_refund, 'id'=>'refund_amount_'.$i, 'class'=>'form-control input-sm', 'readonly'=>'true'));?>
						<?php if(currency_side()): ?>
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php 
			++$i;
		}
		echo form_hidden('number_of_payments', $i);			
		?>
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('receivings_reference'), 'reference', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array('name' => 'reference', 'value' => $receiving_info['reference'], 'id' => 'reference', 'class'=>'form-control input-sm'));?>
			</div>
		</div>
		
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('receivings_employee'), 'employee', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_dropdown('employee_id', $employees, $receiving_info['employee_id'], 'id="employee_id" class="form-control"');?>
			</div>
		</div>
		
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('receivings_comments'), 'comment', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_textarea(array('name'=>'comment','value'=>$receiving_info['comment'], 'id'=>'comment', 'class'=>'form-control input-sm'));?>
			</div>
		</div>
	</fieldset>
<?php echo form_close(); ?>
		
<script type="text/javascript">
$(document).ready(function()
{
	<?php $this->load->view('partial/datepicker_locale'); ?>

    $('#datetime').datetimepicker(pickerconfig);

	var fill_value = function(event, ui) {
		event.preventDefault();
		$("input[name='supplier_id']").val(ui.item.value);
		$("input[name='supplier_name']").val(ui.item.label);
	};

	$('#supplier_name').autocomplete({
		source: "<?php echo site_url('suppliers/suggest'); ?>",
		minChars: 0,
		delay: 15, 
		cacheLength: 1,
		appendTo: '.modal-content',
		select: fill_value,
		focus: fill_value
	});

	$('button#delete').click(function()
	{
		dialog_support.hide();
		table_support.do_delete("<?php echo site_url($controller_name); ?>", <?php echo $receiving_info['receiving_id']; ?>);
	});

	$('#receivings_edit_form').validate($.extend({
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)
				{
					dialog_support.hide();
					table_support.handle_submit("<?php echo site_url($controller_name); ?>", response);
				},
				dataType: 'json'
			});
		}
	}, form_support.error));
});
</script>
