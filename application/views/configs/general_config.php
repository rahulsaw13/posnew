<link rel="stylesheet" type="text/css" href="css/configuration.css" />

<?php echo form_open('config/save_general/', array('id' => 'general_config_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
	<div id="config_wrapper">
		<fieldset id="config_info" class="m-0 p-0">

			<div class="row mx-10">
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_theme'), 'theme', array('class' => 'control-label')); ?>
						<div class="align-item-center">
							<?php echo form_dropdown('theme', $themes, $this->config->item('theme'), array('class' => 'form-control input-sm cursor-pointer custom-input-with-border', 'id' => 'theme-change')); ?>
							<a class="scale-3 ml-10" href="<?php echo 'https://bootswatch.com/3/' . ('bootstrap'==($this->config->item('theme')) ? 'default' : $this->config->item('theme')); ?>" target="_blank" rel=”noopener”>
								<span class="glyphicon glyphicon-new-window"></span>
							</a>
						</div>
					</div>
				</div>
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_login_form'), 'login_form', array('class' => 'control-label ml-50')); ?>
						<?php echo form_dropdown('login_form', array(
								'floating_labels' => $this->lang->line('config_floating_labels'),
								'input_groups' => $this->lang->line('config_input_groups')
							),
						$this->config->item('login_form'), array('class' => 'form-control input-sm cursor-pointer custom-input-with-border ml-50')); ?>
					</div>
				</div>
			</div>

			<div class="row mx-10">
				<div class="col-xs-2 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_lines_per_page'), 'lines_per_page', array('class' => 'control-label')); ?><span class="required-red">*</span>
						<?php echo form_input(array(
							'name' => 'lines_per_page',
							'id' => 'lines_per_page',
							'class' => 'form-control input-sm custom-input-with-border',
							'type' => 'number',
							'min' => 10,
							'max' => 1000,
							'value' => $this->config->item('lines_per_page'))); 
						?>
					</div>
				</div>
				<div class="col-xs-2 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_default_sales_discount'), 'default_sales_discount', array('class' => 'control-label')); ?><span class="required-red">*</span>
						<div class="input-group">
							<?php echo form_input(array(
								'name' => 'default_sales_discount',
								'id' => 'default_sales_discount',
								'class' => 'form-control input-sm custom-input-without-right-border',
								'type' => 'number',
								'min' => 0,
								'max' => 100,
								'value' => $this->config->item('default_sales_discount'))); ?>
							<span class="input-group-btn custom-discount-toggle-container">
								<?php echo form_checkbox(array(
									'id' => 'default_sales_discount_type',
									'name' => 'default_sales_discount_type',
									'value' => 1,
									'class' => 'custom-input-height',
									'data-toggle' => 'toggle',
									'data-size' => 'normal',
									'data-onstyle' => 'success',
									'data-on' => '<b>'.$this->config->item('currency_symbol').'</b>',
									'data-off' => '<b>%</b>',
									'checked' => $this->config->item('default_sales_discount_type'))); ?>
							</span>
						</div>
					</div>
				</div>
				<div class="col-xs-3 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_default_receivings_discount'), 'default_receivings_discount', array('class' => 'control-label')); ?><span class="required-red">*</span>
						<div class="input-group">
							<?php echo form_input(array(
								'name' => 'default_receivings_discount',
								'id' => 'default_receivings_discount',
								'class' => 'form-control input-sm custom-input-without-right-border',
								'type' => 'number',
								'min' => 0,
								'max' => 100,
								'value' => $this->config->item('default_receivings_discount'))); ?>
							<span class="input-group-btn">
								<?php echo form_checkbox(array(
									'id' => 'default_receivings_discount_type',
									'name' => 'default_receivings_discount_type',
									'value' => 1,
									'data-toggle' => 'toggle',
									'data-size' => 'normal',
									'data-onstyle' => 'success',
									'data-on' => '<b>'.$this->config->item('currency_symbol').'</b>',
									'data-off' => '<b>%</b>',
									'checked' => $this->config->item('default_receivings_discount_type'))); ?>
							</span>
						</div>
					</div>
				</div>
				<div class="col-xs-4 padding-20 pt-6">
					<div class="d-flex padding-20">
						<div class="form-group form-group-sm m-b-0">
								<?php echo form_checkbox(array(
									'name' => 'enforce_privacy',
									'id' => 'enforce_privacy',
									'value' => 'enforce_privacy',
									'checked' => $this->config->item('enforce_privacy'))); ?>
								<?php echo form_label($this->lang->line('config_enforce_privacy'), 'enforce_privacy', array('class' => 'control-label')); ?>
								<label class="control-label">
									<span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?php echo $this->lang->line('config_enforce_privacy_tooltip'); ?>"></span>
								</label>
						</div>

						<div class="form-group form-group-sm m-b-0">
							<?php echo form_checkbox(array(
								'name' => 'receiving_calculate_average_price',
								'id' => 'receiving_calculate_average_price',
								'value' => 'receiving_calculate_average_price',
								'checked' => $this->config->item('receiving_calculate_average_price'))); ?>
							<?php echo form_label($this->lang->line('config_receiving_calculate_average_price'), 'receiving_calculate_average_price', array('class' => 'control-label')); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row mx-10">
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_notify_alignment'), 'notify_horizontal_position', array('class' => 'control-label')); ?>
						<div class="form-group form-group-sm row">
							<div class='col-sm-6'>
								<?php echo form_dropdown('notify_vertical_position', array(
										'top' => $this->lang->line('config_top'),
										'bottom' => $this->lang->line('config_bottom')
									),
								$this->config->item('notify_vertical_position'), array('class' => 'form-control input-sm cursor-pointer custom-input-with-border')); ?>
							</div>
							<div class='col-sm-6'>
								<?php echo form_dropdown('notify_horizontal_position', array(
										'left' => $this->lang->line('config_left'),
										'center' => $this->lang->line('config_center'),
										'right' => $this->lang->line('config_right')),
								$this->config->item('notify_horizontal_position'), array('class' => 'form-control input-sm cursor-pointer custom-input-with-border')); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mx-10">
				<div class="col-xs-12 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_image_restrictions'), 'image_restrictions', array('class' => 'control-label')); ?><span class="required-red">*</span>
						<div class="form-group form-group-sm row m-0">
							<div class='col-sm-2 pl-0'>
								<div class='input-group w-full custom-form-group'>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag position-relative"><span class="glyphicon glyphicon-resize-horizontal"></span></span>
									<?php echo form_input(array(
										'name' => 'image_max_width',
										'id' => 'image_max_width',
										'class' => 'form-control input-sm custom-input custom-input-width-with-error w-full-imp',
										'type' => 'number',
										'min' => 128,
										'max' => 3840,
										'value' => $this->config->item('image_max_width'),
										'data-toggle' => 'tooltip',
										'data-placement' => 'top',
										'title' => $this->lang->line('config_image_max_width_tooltip')));
									?>
								</div>
							</div>
							<div class='col-sm-2 pl-0'>
								<div class='input-group w-full custom-form-group'>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag position-relative">
										<span class="glyphicon glyphicon-resize-vertical"></span>
									</span>
									<?php echo form_input(array(
										'name' => 'image_max_height',
										'id' => 'image_max_height',
										'class' => 'form-control input-sm custom-input custom-input-width-with-error w-full-imp',
										'type' => 'number',
										'min' => 128,
										'max' => 3840,
										'value' => $this->config->item('image_max_height'),
										'data-toggle' => 'tooltip',
										'data-placement' => 'top',
										'title' => $this->lang->line('config_image_max_height_tooltip')));
									?>
								</div>
							</div>
							<div class='col-sm-2 pl-0'>
								<div class='input-group w-full custom-form-group'>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag position-relative"><span class="glyphicon glyphicon-hdd"></span></span>
									<?php echo form_input(array(
										'name' => 'image_max_size',
										'id' => 'image_max_size',
										'class' => 'form-control input-sm custom-input custom-input-width-with-error w-full-imp',
										'type' => 'number',
										'min' => 128,
										'max' => 2048,
										'value' => $this->config->item('image_max_size'),
										'data-toggle' => 'tooltip',
										'data-placement' => 'top',
										'title' => $this->lang->line('config_image_max_size_tooltip')));
									?>
								</div>
							</div>
							<div class='col-sm-4 pl-0'>
								<div class='input-group'>
									<span class="input-group-addon input-sm text-sidebar"><?php echo $this->lang->line('config_image_allowed_file_types');?></span>
									<?php echo form_multiselect('image_allowed_types[]', $image_allowed_types, $selected_image_allowed_types, array(
										'id'=>'image_allowed_types',
										'class'=>'selectpicker show-menu-arrow',
										'data-none-selected-text'=>$this->lang->line('common_none_selected_text'),
										'data-selected-text-format'=>'count > 1',
										'data-style'=>'btn-default btn-sm',
										'data-width'=>'100%'));
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mx-10">
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_gcaptcha_site_key'), 'config_gcaptcha_site_key', array('class' => 'control-label','id' => 'config_gcaptcha_site_key')); ?><span class="required-red">*</span>
						<?php echo form_input(array(
							'name' => 'gcaptcha_site_key',
							'id' => 'gcaptcha_site_key',
							'class' => 'form-control input-sm custom-input-with-border',
							'value' => $this->config->item('gcaptcha_site_key'))); ?>
					</div>
				</div>
				
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_gcaptcha_secret_key'), 'config_gcaptcha_secret_key', array('class' => 'control-label','id' => 'config_gcaptcha_secret_key')); ?><span class="required-red">*</span>
						<?php echo form_input(array(
							'name' => 'gcaptcha_secret_key',
							'id' => 'gcaptcha_secret_key',
							'class' => 'form-control input-sm custom-input-with-border',
							'value' => $this->config->item('gcaptcha_secret_key'))); ?>
					</div>
				</div>
				
				<div class="col-xs-4 padding-20 login-page-recaptcha">
					<div class="form-group form-group-sm">
						<?php echo form_checkbox(array(
							'name' => 'gcaptcha_enable',
							'id' => 'gcaptcha_enable',
							'value' => 'gcaptcha_enable',
							'checked' => $this->config->item('gcaptcha_enable'))); ?>
						<?php echo form_label($this->lang->line('config_gcaptcha_enable'), 'gcaptcha_enable', array('class' => 'control-label')); ?>
						<label class="control-label">
							<a href="https://www.google.com/recaptcha/admin" target="_blank">
								<span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?php echo $this->lang->line('config_gcaptcha_tooltip'); ?>"></span>
							</a>
						</label>
					</div>
				</div>
			</div>

			<div class="row mx-10">
				<div class="col-xs-8 padding-20">
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('config_suggestions_layout'), 'suggestions_layout', array('class' => 'control-label')); ?>
						<div class="form-group form-group-sm row m-0">
							<div class='col-sm-4 pl-0'>
								<div class='input-group'>
									<span class="input-group-addon input-sm text-sidebar"><?php echo $this->lang->line('config_suggestions_first_column'); ?></span>
									<?php echo form_dropdown('suggestions_first_column', array(
										'name' => $this->lang->line('items_name'),
										'item_number' => $this->lang->line('items_number_information'),
										'unit_price' => $this->lang->line('items_unit_price'),
										'cost_price' => $this->lang->line('items_cost_price')),
										$this->config->item('suggestions_first_column'), array('class' => 'form-control input-sm suggestion-dropdown')); ?>
								</div>
							</div>
							<div class='col-sm-4 pl-0'>
								<div class='input-group'>
									<span class="input-group-addon input-sm text-sidebar"><?php echo $this->lang->line('config_suggestions_second_column'); ?></span>
									<?php echo form_dropdown('suggestions_second_column', array(
										'' => $this->lang->line('config_none'),
										'name' => $this->lang->line('items_name'),
										'item_number' => $this->lang->line('items_number_information'),
										'unit_price' => $this->lang->line('items_unit_price'),
										'cost_price' => $this->lang->line('items_cost_price')),
										$this->config->item('suggestions_second_column'), array('class' => 'form-control input-sm suggestion-dropdown')); ?>
								</div>
							</div>
							<div class='col-sm-4 pl-0'>
								<div class='input-group'>
									<span class="input-group-addon input-sm text-sidebar"><?php echo $this->lang->line('config_suggestions_third_column'); ?></span>
									<?php echo form_dropdown('suggestions_third_column', array(
										'' => $this->lang->line('config_none'),
										'name' => $this->lang->line('items_name'),
										'item_number' => $this->lang->line('items_number_information'),
										'unit_price' => $this->lang->line('items_unit_price'),
										'cost_price' => $this->lang->line('items_cost_price')),
										$this->config->item('suggestions_third_column'), array('class' => 'form-control input-sm suggestion-dropdown')); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mx-10">
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm radio-parent">
						<?php echo form_label($this->lang->line('config_giftcard_number'), 'giftcard_number', array('class' => 'control-label text-left')); ?>
						<div>
							<div class="radio-inline">
								<?php echo form_radio(array(
									'name' => 'giftcard_number',
									'value' => 'series',
									'checked' => $this->config->item('giftcard_number') == 'series')); ?>
								<?php echo $this->lang->line('config_giftcard_series'); ?>
							</div>
							<div class="radio-inline margin-15">
								<?php echo form_radio(array(
									'name' => 'giftcard_number',
									'value' => 'random',
									'checked' => $this->config->item('giftcard_number') == 'random')); ?>
								<?php echo $this->lang->line('config_giftcard_random'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mx-10 padding-20">
				<div class="form-group form-group-sm">
					<?php echo form_checkbox(array(
						'name' => 'derive_sale_quantity',
						'id' => 'derive_sale_quantity',
						'value' => 'derive_sale_quantity',
						'checked' => $this->config->item('derive_sale_quantity'))); ?>
					<?php echo form_label($this->lang->line('config_derive_sale_quantity'), 'derive_sale_quantity', array('class' => 'control-label')); ?>
					<label class="control-label">
						<span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="<?php echo $this->lang->line('config_derive_sale_quantity_tooltip'); ?>"></span>
					</label>
				</div>
	
				<div class="form-group form-group-sm">
					<?php echo form_checkbox(array(
						'name' => 'show_office_group',
						'id' => 'show_office_group',
						'value' => 'show_office_group',
						'checked' => $show_office_group)); ?>
					<?php echo form_label($this->lang->line('config_show_office_group'), 'show_office_group', array('class' => 'control-label')); ?>
				</div>
	
				<div class="form-group form-group-sm">
					<?php echo form_checkbox(array(
						'name' => 'multi_pack_enabled',
						'id' => 'multi_pack_enabled',
						'value' => 'multi_pack_enabled',
						'checked' => $this->config->item('multi_pack_enabled'))); ?>
					<?php echo form_label($this->lang->line('config_multi_pack_enabled'), 'multi_pack_enabled', array('class' => 'control-label')); ?>
				</div>
	
				<div class="form-group form-group-sm">
					<?php echo form_checkbox(array(
						'name' => 'include_hsn',
						'id' => 'include_hsn',
						'value' => 'include_hsn',
						'checked' => $this->config->item('include_hsn'))); ?>
					<?php echo form_label($this->lang->line('config_include_hsn'), 'include_hsn', array('class' => 'control-label')); ?>
				</div>
	
				<div class="form-group form-group-sm">
					<?php echo form_checkbox(array(
						'name' => 'category_dropdown',
						'id' => 'category_dropdown',
						'value' => 'category_dropdown',
						'checked' => $this->config->item('category_dropdown'))); ?>
					<?php echo form_label($this->lang->line('config_category_dropdown'), 'category_dropdown', array('class' => 'control-label')); ?>
				</div>
			</div>

				<div class="justify-right mx-10 pb-10">
					<div class="form-group-container">
						<div id="backup_db" class="form-buttons theme-transition-effect cursor-pointer">
							<span><?php echo $this->lang->line('config_backup_button'); ?></span><span class="glyphicon glyphicon-download-alt pl-20"></span>
						</div>
					</div>
					<div class="form-group-container">
						<?php echo form_submit(array(
							'name' => 'submit_info',
							'id' => 'submit_info',
							'value' => $this->lang->line('common_submit'),
							'class' => 'form-buttons theme-transition-effect')); ?>
					</div>
				</div>
		</fieldset>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	var enable_disable_gcaptcha_enable = (function() {
		var gcaptcha_enable = $("#gcaptcha_enable").is(":checked");
		if(gcaptcha_enable)
		{
			$("#gcaptcha_site_key, #gcaptcha_secret_key").prop("disabled", !gcaptcha_enable).addClass("required");
			$("#config_gcaptcha_site_key, #config_gcaptcha_secret_key").addClass("required");
		}
		else
		{
			$("#gcaptcha_site_key, #gcaptcha_secret_key").prop("disabled", gcaptcha_enable).removeClass("required");
			$("#config_gcaptcha_site_key, #config_gcaptcha_secret_key").removeClass("required");
		}

		return arguments.callee;
	})();

	$("#gcaptcha_enable").change(enable_disable_gcaptcha_enable);

	$("#backup_db").click(function() {
		window.location='<?php echo site_url('config/backup_db') ?>';
	});

	$('#general_config_form').validate($.extend(form_support.handler, {

		errorLabelContainer: "#general_error_message_box",

		rules:
		{
			lines_per_page:
			{
				required: true,
				remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
			},
			default_sales_discount:
			{
				required: true,
				remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
			},
			gcaptcha_site_key:
			{
				required: "#gcaptcha_enable:checked"
			},
			gcaptcha_secret_key:
			{
				required: "#gcaptcha_enable:checked"
			}
		},

		messages:
		{
			default_sales_discount:
			{
				required: "<?php echo $this->lang->line('config_default_sales_discount_required'); ?>",
				number: "<?php echo $this->lang->line('config_default_sales_discount_number'); ?>"
			},
			lines_per_page:
			{
				required: "<?php echo $this->lang->line('config_lines_per_page_required'); ?>",
				number: "<?php echo $this->lang->line('config_lines_per_page_number'); ?>"
			},
			gcaptcha_site_key:
			{
				required: "<?php echo $this->lang->line('config_gcaptcha_site_key_required'); ?>"
			},
			gcaptcha_secret_key:
			{
				required: "<?php echo $this->lang->line('config_gcaptcha_secret_key_required'); ?>"
			}
		},

		submitHandler: function(form) {
			$(form).ajaxSubmit({
				beforeSerialize: function(arr, $form, options) {
					$("#gcaptcha_site_key, #gcaptcha_secret_key").prop("disabled", false);
					return true;
				},
				success: function(response) {
					$.notify( { message: response.message }, { type: response.success ? 'success' : 'danger'} )
					// set back disabled state
					enable_disable_gcaptcha_enable();
				},
				dataType: 'json'
			});
		}
	}));
});
</script>
