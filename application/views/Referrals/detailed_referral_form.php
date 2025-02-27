<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open($controller_name . '/save_detailed_referral_report/' . $Referral->referral_id.'/'.$Referral->sale_id, array('id'=>'referal_form', 'class'=>'form-horizontal')); ?>
	<div class="tab-content">
		<div class="tab-pane fade in active" id="referal_sales_info">
			<fieldset>
					<div class="form-group form-group-sm">	
					<?php echo form_label($this->lang->line('Bill_no'), 'Bill_no', array('class'=>'control-label col-xs-3')); ?>
					<div class='col-xs-8'>
						<div class="input-group">
							
							<?php echo form_input(array(
									'name'=>'Bill_no',
									'id'=>'Bill_no',
									'class'=>'form-control input-sm',
									'value'=>$Referral->sale_id,
									'readonly'=>'true')
									);?>
						</div>
					</div>
				</div>
				<div class="form-group form-group-sm">	
					<?php echo form_label($this->lang->line('Bill_amount'), 'Bill_amount', array('class'=>'control-label col-xs-3')); ?>
					<div class='col-xs-8'>
						<div class="input-group">
						<?php if(!currency_side()): ?>
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
						<?php endif; ?>
							<?php echo form_input(array(
									'name'=>'Bill_amount',
									'id'=>'Bill_amount',
									'class'=>'form-control input-sm',
									'value'=>$Referral->sale_total,
									'readonly'=>'true')
									);?>
						</div>
					</div>
				</div>

				<div class="form-group form-group-sm">	
					<?php echo form_label($this->lang->line('Commission'), 'Commission', array('class'=>'control-label col-xs-3')); ?>
					<div class='col-xs-8'>
					<div class="input-group input-group-sm">
						<?php if(!currency_side()): ?>
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
						<?php endif; ?>	
						<?php echo form_input(array(
									'name'=>'Commission',
									'id'=>'Commission',
									'class'=>'form-control input-sm',
									'value'=>$Referral->sale_commission,
									'readonly'=>'true')
									);?>
						</div>
					</div>
				</div>
				<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('commission_paid_status'), 'commission_paid_status', array('class'=>'control-label col-xs-3')); ?>
				<div class='col-xs-4'>
					<?php echo form_dropdown('commission_paid_status', array( "DUE","PAID"), $Referral->commission_paid_status, array('id'=>'commission_paid_status', 'class'=>'form-control')); ?>
				
				</div>
				</div>
			</fieldset>
		</div>

		<?php
		if(!empty($stats))
		{
		?>
			<div class="tab-pane" id="referal_stats_info">
				<fieldset>
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('referals_total'), 'total', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'total',
										'id'=>'total',
										'class'=>'form-control input-sm',
										'value'=>to_currency_no_money($stats->total),
										'disabled'=>'')
										); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('referals_max'), 'max', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'max',
										'id'=>'max',
										'class'=>'form-control input-sm',
										'value'=>to_currency_no_money($stats->max),
										'disabled'=>'')
										); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('referals_min'), 'min', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'min',
										'id'=>'min',
										'class'=>'form-control input-sm',
										'value'=>to_currency_no_money($stats->min),
										'disabled'=>'')
										); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('referals_average'), 'average', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'average',
										'id'=>'average',
										'class'=>'form-control input-sm',
										'value'=>to_currency_no_money($stats->average),
										'disabled'=>'')
										); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('referals_quantity'), 'quantity', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php echo form_input(array(
										'name'=>'quantity',
										'id'=>'quantity',
										'class'=>'form-control input-sm',
										'value'=>$stats->quantity,
										'disabled'=>'')
										); ?>
							</div>
						</div>
					</div>

					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('referals_avg_discount'), 'avg_discount', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-3">
							<div class="input-group input-group-sm">
								<?php echo form_input(array(
										'name'=>'avg_discount',
										'id'=>'avg_discount',
										'class'=>'form-control input-sm',
										'value'=>$stats->avg_discount,
										'disabled'=>'')
										); ?>
								<span class="input-group-addon input-sm"><b>%</b></span>
							</div>
						</div>
					</div>

					<!-- Adding credit note field to display -->
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('sales_credit_note'), 'credit_note', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-3">
							<div class="input-group input-group-sm">
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php echo form_input(array(
										'name' => 'credit_note',
										'id' => 'credit_note',
										'class' => 'form-control input-sm',
										'value' => to_currency_no_money($stats->credit_note),
										'disabled' => ''
								)); ?>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
		<?php
		}
		?>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	nominatim.init({
		fields : {
			postcode : {
				dependencies :  ["postcode", "city", "state", "country"],
				response : {
					field : 'postalcode',
					format: ["postcode", "village|town|hamlet|city_district|city", "state", "country"]
				}
			},

			city : {
				dependencies :  ["postcode", "city", "state", "country"],
				response : {
					format: ["postcode", "village|town|hamlet|city_district|city", "state", "country"]
				}
			},

			state : {
				dependencies :  ["state", "country"]
			},

			country : {
				dependencies :  ["state", "country"]
			}
		},
		language : '<?php echo current_language_code();?>',
		country_codes: '<?php echo $this->config->item('country_codes'); ?>'
	});

	$("input[name='sales_tax_code_name']").change(function() {
		if( ! $("input[name='sales_tax_code_name']").val() ) {
			$("input[name='sales_tax_code_id']").val('');
		}
	});

	var fill_value = function(event, ui) {
		event.preventDefault();
		$("input[name='sales_tax_code_id']").val(ui.item.value);
		$("input[name='sales_tax_code_name']").val(ui.item.label);
	};

	$('#sales_tax_code_name').autocomplete({
		source: "<?php echo site_url('taxes/suggest_tax_codes'); ?>",
		minChars: 0,
		delay: 15,
		cacheLength: 1,
		appendTo: '.modal-content',
		select: fill_value,
		focus: fill_value
	});

	$('#referal_form').validate($.extend({
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)
				{
					dialog_support.hide();
					table_support.handle_submit("<?php echo site_url($controller_name); ?>", response);
				},
				dataType: 'json'
			});
		},

		errorLabelContainer: '#error_message_box',

		rules:
		{
			first_name: 'required',
			last_name: 'required',
			consent: 'required',
			email:
			{
				remote:
				{
					url: "<?php echo site_url($controller_name . '/ajax_check_email') ?>",
					type: 'POST',
					data: {
						'person_id': "<?php echo $person_info->person_id; ?>"
						// email is posted by default
					}
				}
			},
			account_number:
			{
				remote:
				{
					url: "<?php echo site_url($controller_name . '/ajax_check_account_number') ?>",
					type: 'POST',
					data: {
						'person_id': "<?php echo $person_info->person_id; ?>"
						// account_number is posted by default
					}
				}
			}
		},

		messages:
		{
			first_name: "<?php echo $this->lang->line('common_first_name_required'); ?>",
			last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
			consent: "<?php echo $this->lang->line('referals_consent_required'); ?>",
			email: "<?php echo $this->lang->line('referals_email_duplicate'); ?>",
			account_number: "<?php echo $this->lang->line('referals_account_number_duplicate'); ?>"
		}
	}, form_support.error));
});
</script>
