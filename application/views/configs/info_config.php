<link rel="stylesheet" type="text/css" href="css/configuration.css" />

<?php echo form_open('config/save_info/', array('id' => 'info_config_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
	<div id="config_wrapper">
		<fieldset id="config_info" class="m-0 p-0">
			<div class="row m-0 p-0">
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">	
						<?php echo form_label($this->lang->line('config_company'), 'company', array('class' => 'control-label')); ?><span class="required-red">*</span>
						<div class="input-group w-full custom-form-group">
							<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-home"></span></span>
							<?php echo form_input(array(
								'name' => 'company',
								'id' => 'company',
								'class' => 'form-control input-sm custom-input custom-input-width-with-error',
								'value'=>$this->config->item('company'))); ?>
						</div>
					</div>
				</div>
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">	
						<?php echo form_label($this->lang->line('config_website'), 'website', array('class' => 'control-label')); ?>
						<div class="input-group w-full custom-form-group">
							<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-globe"></span></span>
							<?php echo form_input(array(
								'name' => 'website',
								'id' => 'website',
								'class' => 'form-control input-sm custom-input custom-input-width-with-error',
								'value'=>$this->config->item('website'))); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row m-0 p-0">
				<div class="col-xs-8 padding-20">
					<div class="form-group form-group-sm">	
						<?php echo form_label($this->lang->line('config_address'), 'address', array('class' => 'control-label')); ?><span class="required-red">*</span>
						<?php echo form_textarea(array(
							'name' => 'address',
							'id' => 'address',
							'rows'=>'4',
							'class' => 'form-control input-sm resize-none custom-input-with-border',
							'value'=>$this->config->item('address'))); ?>
					</div>
				</div>
			</div>

			<div class="row m-0 p-0">
				<div class="col-xs-8 padding-20">
					<div class="form-group form-group-sm">	
						<?php echo form_label($this->lang->line('common_return_policy'), 'return_policy', array('class' => 'control-label')); ?><span class="required-red">*</span>
						<?php echo form_textarea(array(
							'name' => 'return_policy',
							'id' => 'return_policy',
							'rows'=>'4',
							'class' => 'form-control input-sm resize-none custom-input-with-border',
							'value'=>$this->config->item('return_policy'))); ?>
					</div>
				</div>
			</div>

			<div class="row m-0 p-0">
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">	
						<?php echo form_label($this->lang->line('common_email'), 'email', array('class' => 'control-label')); ?>
						<div class="input-group w-full custom-form-group">
							<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-envelope"></span></span>
							<?php echo form_input(array(
								'name' => 'email',
								'id' => 'email',
								'type' => 'email',
								'class' => 'form-control input-sm custom-input custom-input-width-with-error',
								'value'=>$this->config->item('email'))); ?>
						</div>
					</div>
				</div>
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">	
						<?php echo form_label($this->lang->line('config_phone'), 'phone', array('class' => 'control-label')); ?><span class="required-red">*</span>
						<div class="input-group w-full custom-form-group">
							<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-phone-alt"></span></span>
							<?php echo form_input(array(
								'name' => 'phone',
								'id' => 'phone',
								'class' => 'form-control input-sm custom-input custom-input-width-with-error',
								'value'=>$this->config->item('phone'))); ?>
						</div>
					</div>
				</div>
				<div class="col-xs-4 padding-20 avatar-container">
					<div class="form-group form-group-sm">
						<div class="fileinput <?php echo $logo_exists ? 'fileinput-exists' : 'fileinput-new'; ?>" data-provides="fileinput">
							<div class="fileinput-preview fileinput-exists thumbnail file-upload-thumbnail">
								<img 
									data-src="holder.js/100%x100%" 
									alt="<?php echo $this->lang->line('config_company_logo'); ?>" 
									src="<?php echo $logo_exists ? base_url('uploads/' . $this->config->item('company_logo')) : ''; ?>" 
									width="300px">
							</div>

							<?php if (!$logo_exists): ?>
								<div id="default-image">
									<img 
										src="https://rahulindesign.websites.co.in/twenty-nineteen/img/defaults/product-default.png" 
										alt="default image" 
										width="300px">
								</div>
							<?php endif; ?>

							<div class="file-upload-controls">
								<span class="btn btn-primary btn-file theme-bg-color">
									<span class="fileinput-new theme-bg-color">Select Image / Avatar</span>
									<span class="fileinput-exists theme-bg-color"><?php echo $this->lang->line("config_company_change_image"); ?></span>
									<input type="file" name="company_logo" accept="image/*">
								</span>
								<a href="#" 
									class="btn fileinput-exists theme-bg-color" 
									data-dismiss="fileinput" 
									onclick="deleteImage()">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="row m-0 p-0">
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">    
						<?php echo form_label($this->lang->line('config_gst_number'), 'gst_number', array('class' => 'control-label')); ?>
						<div class="input-group w-full custom-form-group">
							<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-pencil"></span></span>
							<?php echo form_input(array(
								'name' => 'gst_number',
								'id' => 'gst_number',
								'class' => 'form-control input-sm custom-input custom-input-width-with-error',
								'value'=>$this->config->item('gst_number'))); ?>
						</div>
					</div>
				</div>
				<div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">	
						<?php echo form_label($this->lang->line('config_fax'), 'fax', array('class' => 'control-label')); ?>
						<div class="input-group w-full custom-form-group">
							<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-phone-alt"></span></span>
							<?php echo form_input(array(
								'name' => 'fax',
								'id' => 'fax',
								'class' => 'form-control input-sm custom-input custom-input-width-with-error',
								'value'=>$this->config->item('fax'))); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row mx-10 pb-10">
					<div class="form-group-container">
						<div class="margin-top-50">
							<?php echo form_submit(array(
							'name' => 'submit_info',
							'id' => 'submit_info',
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
	$("a.fileinput-exists").click(function() {
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url("$controller_name/remove_logo"); ?>',
			dataType: 'json'
		})
	});

	$('#info_config_form').validate($.extend(form_support.handler, {

		errorLabelContainer: "#info_error_message_box",

		rules:
		{
			company: "required",
			address: "required",
			phone: "required",
    		email: "email",
    		return_policy: "required" 		
   		},

		messages: 
		{
			company: "<?php echo $this->lang->line('config_company_required'); ?>",
			address: "<?php echo $this->lang->line('config_address_required'); ?>",
			phone: "<?php echo $this->lang->line('config_phone_required'); ?>",
			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
			return_policy: "<?php echo $this->lang->line('config_return_policy_required'); ?>"
		}
	}));
});
</script>
