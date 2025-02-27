<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open('bankdetails/save/'.$bank_info->bank_id, array('id'=>'bankdetails_form', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal')); ?>
	<fieldset id="bankdetails_basic_info">
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('bank_account_number'), 'account_number', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="input-group">
					<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-pencil"></span></span>
					<?php echo form_input(array(
							'name'=>'bank_account_number',
							'id'=>'bank_account_number',
							'class'=>'form-control input-sm',
							'value'=>$bank_info->bank_account_number)
							);?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('bank_account_holder_name'), 'account_holder_name', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
						'name'=>'bank_account_holder_name',
						'id'=>'bank_account_holder_name',
						'class'=>'form-control input-sm',
						'value'=>$bank_info->bank_account_holder_name)
						);?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('bank_ifsc'), 'bank_ifsc', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
						'name'=>'bank_ifsc',
						'id'=>'bank_ifsc',
						'class'=>'form-control input-sm',
						'value'=>$bank_info->bank_ifsc)
						);?>
			</div>
		</div>
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('bank_upi_id'), 'bank_upi_id', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
						'name'=>'bank_upi_id',
						'id'=>'bank_upi_id',
						'class'=>'form-control input-sm',
						'value'=>$bank_info->bank_upi_id)
						);?>
			</div>
		</div>
	
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('is_active'), 'is_active', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-1'>
				<?php echo form_checkbox(array(
						'name'=>'is_active',
						'id'=>'is_active',
						'value'=>1,
						'checked'=>($bank_info->is_active) ? 1 : 0)
						);?>
			</div>
			<?php echo form_label($this->lang->line('is_primary'), 'is_primary', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-1'>
				<?php echo form_checkbox(array(
						'name'=>'is_primary',
						'id'=>'is_primary',
						'value'=>1,
						'checked'=>($bank_info->is_primary) ? 1 : 0)
						);?>
			</div>
		</div>
	</fieldset>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	$('#new').click(function() {
		stay_open = true;
		$('#bankdetails_form').submit();
	});

	$('#submit').click(function() {
		stay_open = false;
	});

		var init_validation = function() {
		$('#bankdetails_form').validate($.extend({
			submitHandler: function(form, event) {
				$(form).ajaxSubmit({
					success: function(response) {
						var stay_open = dialog_support.clicked_id() != 'submit';
						if(stay_open)
						{
							// set action of bankdetails_form to url without bankdetails id, so a new one can be created
							$('#bankdetails_form').attr('action', "<?php echo site_url('bankdetailss/save/')?>");
							// use a whitelist of fields to minimize unintended side effects
							$(':text, :password, :file, textarea, select, input[type="radio"], input[type="checkbox"]', '#bankdetails_form')
                        		.not('#bank_account_number, #bank_account_holder_name, #bank_ifsc, #is_active, #is_primary').val('');
						// de-select any checkboxes, radios and drop-down menus
							$(':input', '#bankdetails_form').removeAttr('checked').removeAttr('selected');
						}
						else
						{
							dialog_support.hide();
						}
						table_support.handle_submit('<?php echo site_url('bankdetails'); ?>', response, stay_open);
						init_validation();
					},
					dataType: 'json'
				});
			},

			errorLabelContainer: '#error_message_box',

			rules:
			{
				// bankdetails_number:
				// {
				// 	required: false,
				// 	remote:
				// 	{
				// 		url: "<?php echo site_url($controller_name . '/check_bankdetails_number')?>",
				// 		type: 'POST',
				// 		data: {
				// 			'bankdetails_id' : "<?php echo $bankdetails_info->bankdetails_id; ?>",
				// 			'bankdetails_number' : function()
				// 			{
				// 				return $('#bankdetails_number').val();
				// 			},
				// 		}
				// 	}
				// },
				 // Validation rules for each field
				 bank_account_number: {
					required: true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				},
				bank_account_holder_name: 'required',
				bank_ifsc: {
					required: true,
					minlength: 11,  // Ensure IFSC code is at least 11 characters long
					maxlength: 11,  // Ensure IFSC code is exactly 11 characters
				},
				is_active: {
					required: false
				},
				is_primary: {
					required: false
				}
			},

			messages:
			{
				  // Custom error messages for each field
				  	bank_account_number: {
						required: "<?php echo $this->lang->line('bank_account_number_required'); ?>"
					},
					bank_account_holder_name: {
						required: "<?php echo $this->lang->line('bank_account_holder_name_required'); ?>",
						minlength: "<?php echo $this->lang->line('bank_account_holder_name_minlength'); ?>",
						number: "<?php echo $this->lang->line('bank_account_holder_name_pattern'); ?>"  // Pattern error message
					},
					bank_ifsc: {
						required: "<?php echo $this->lang->line('bank_ifsc_required'); ?>",
						minlength: "<?php echo $this->lang->line('bank_ifsc_length'); ?>",
						maxlength: "<?php echo $this->lang->line('bank_ifsc_length'); ?>"  // Error message for invalid IFSC code length
					}
			}
		}, form_support.error));
	};

	init_validation();
});
</script>

