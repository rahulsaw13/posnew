<link rel="stylesheet" type="text/css" href="css/configuration.css" />

<?php echo form_open('config/save_tax/', array('id' => 'tax_config_form', 'class' => 'form-horizontal')); ?>
	<div id="config_wrapper">
		<fieldset id="config_info">

			<div class="row mx-10">
				<div class="col-xs-2 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_tax_id'), 'tax_id', array('class' => 'control-label')); ?>
						<?php echo form_input(array(
							'name' => 'tax_id',
							'id' => 'tax_id',
							'class' => 'form-control input-sm custom-input-with-border',
							'value' => $this->config->item('tax_id'))); ?>
					</div>
				</div>
			</div>

			<div class="row mx-10">
				<div class="col-xs-3 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_default_tax_rate_1'), 'default_tax_1_rate', array('class' => 'control-label')); ?>
						<div class='row p-0'>
							<div class='col-xs-4'>
								<?php echo form_input(array(
									'name' => 'default_tax_1_name',
									'id' => 'default_tax_1_name',
									'class' => 'form-control input-sm custom-input-with-border',
									'value'=>$this->config->item('default_tax_1_name')!==FALSE ? $this->config->item('default_tax_1_name') : $this->lang->line('items_sales_tax_1'))); ?>
							</div>
							<div class="col-xs-7 p-0">
								<div class="input-group input-group-sm w-full tax-input-width">
									<?php echo form_input(array(
										'name' => 'default_tax_1_rate',
										'id' => 'default_tax_1_rate',
										'class' => 'form-control input-sm custom-input-without-right-border',
										'value'=> to_tax_decimals($this->config->item('default_tax_1_rate')))); ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-right-tag mix-input-icon-width"><b>%</b></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_default_tax_rate_2'), 'default_tax_2_rate', array('class' => 'control-label')); ?>
						<div class='row p-0'>
							<div class='col-xs-4'>
								<?php echo form_input(array(
									'name' => 'default_tax_2_name',
									'id' => 'default_tax_2_name',
									'class' => 'form-control input-sm custom-input-with-border',
									'value'=>$this->config->item('default_tax_2_name')!==FALSE ? $this->config->item('default_tax_2_name') : $this->lang->line('items_sales_tax_2'))); ?>
							</div>
							<div class="col-xs-7 p-0">
								<div class="input-group input-group-sm w-full tax-input-width">
									<?php echo form_input(array(
										'name' => 'default_tax_2_rate',
										'id' => 'default_tax_2_rate',
										'class' => 'form-control input-sm custom-input-without-right-border',
										'value'=> to_tax_decimals($this->config->item('default_tax_2_rate')))); ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-right-tag mix-input-icon-width">%</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-3 padding-20 pt-6">
					<div class="d-flex padding-20">
						<div class="form-group form-group-sm m-b-0">
							<?php echo form_checkbox(array(
								'name' => 'tax_included',
								'id' => 'tax_included',
								'value' => 'tax_included',
								'checked'=>$this->config->item('tax_included'))); ?>
							<?php echo form_label($this->lang->line('config_tax_included'), 'tax_included', array('class' => 'control-label')); ?>
						</div>
						<div class="form-group form-group-sm m-b-0">
							<?php echo form_checkbox(array(
								'name' => 'use_destination_based_tax',
								'id' => 'use_destination_based_tax',
								'value' => 'use_destination_based_tax',
								'checked'=>$this->config->item('use_destination_based_tax'))); ?>
							<?php echo form_label($this->lang->line('config_use_destination_based_tax'), 'use_destination_based_tax', array('class' => 'control-label')); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row mx-10">
				<div class="col-xs-3 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_default_tax_code'), 'default_tax_code', array('class' => 'control-label')); ?>
						<?php echo form_dropdown('default_tax_code', $tax_code_options, $this->config->item('default_tax_code'), array('class' => 'form-control input-sm custom-input-with-border')); ?>
					</div>
				</div>
				<div class="col-xs-3 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_default_tax_category'), 'default_tax_category', array('class' => 'control-label')); ?>
						<?php echo form_dropdown('default_tax_category', $tax_category_options, $this->config->item('default_tax_category'), array('class' => 'form-control input-sm custom-input-with-border')); ?>
					</div>
				</div>
				<div class="col-xs-3 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_default_tax_jurisdiction'), 'default_tax_jurisdiction', array('class' => 'control-label')); ?>
						<?php echo form_dropdown('default_tax_jurisdiction', $tax_jurisdiction_options, $this->config->item('default_tax_jurisdiction'), array('class' => 'form-control input-sm custom-input-with-border')); ?>
					</div>
				</div>
			</div>

			<div class="row mx-10 pb-10">
					<div class="form-group-container">
						<div class="margin-top-50">
							<?php echo form_submit(array(
							'name' => 'submit_tax',
							'id' => 'submit_tax',
							'value' => $this->lang->line('common_submit'),
							'class' => 'form-buttons theme-transition-effect')); ?>
						</div>
					</div>
			</div>
		</fieldset>
	</div>

<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	var enable_disable_use_destination_based_tax = (function() {
	   var use_destination_based_tax = $("#use_destination_based_tax").is(":checked");
	   $("select[name='default_tax_code']").prop("disabled", !use_destination_based_tax);
		$("select[name='default_tax_category']").prop("disabled", !use_destination_based_tax);
		$("select[name='default_tax_jurisdiction']").prop("disabled", !use_destination_based_tax);
		$("input[name='tax_included']").prop("disabled", use_destination_based_tax);
		$("input[name='default_tax_1_rate']").prop("disabled", use_destination_based_tax);
		$("input[name='default_tax_1_name']").prop("disabled", use_destination_based_tax);
		$("input[name='default_tax_2_rate']").prop("disabled", use_destination_based_tax);
		$("input[name='default_tax_2_name']").prop("disabled", use_destination_based_tax);

		return arguments.callee;
	})();

	$("#use_destination_based_tax").change(enable_disable_use_destination_based_tax);


	$('#tax_config_form').validate($.extend(form_support.handler, {
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				beforeSerialize: function(arr, $form, options) {
					return true;
				},
				success: function(response)	{
					$.notify({ message: response.message }, { type: response.success ? 'success' : 'danger'});
				},
				dataType: 'json'
			});
		},

		rules:
		{
			default_tax_1_rate:
			{
				remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
			},
			default_tax2_rate:
			{
				remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
			},
		},

		messages:
		{
			default_tax_1_rate:
			{
				number: "<?php echo $this->lang->line('config_default_tax_rate_number'); ?>"
			},
		}
	}));
});
</script>
