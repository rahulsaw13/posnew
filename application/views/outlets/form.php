<!-- <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul> -->

<?php $this->load->view("partial/header"); ?>
<?php
	// Get the current URL
	$current_url = $_SERVER['REQUEST_URI'];

	// Extract the item ID from the URL
	$segments = explode('/', trim($current_url, '/'));
	$item_id = end($segments);

	// Determine whether to show "Add" or "Update"
	$text = is_numeric($item_id) ? 'UPDATE' : 'ADD';
	$submit_text = is_numeric($item_id) ? 'Update' : 'Submit';
	$toaster_text = is_numeric($item_id) ? 'updated' : 'created';
?>

<style>
	body {
		font-family: sans-serif;
		letter-spacing: 1px;
	}
    .margin-15 {
        margin: 15px;
    }
	.padding-20{
		padding-left: 20px;
		padding-right: 20px;
	}
	.padding-40{
		padding-left: 40px;
		padding-right: 40px;
	}
	.radio-parent{
		display: flex;
		flex-direction: column;
	}
	.padding-0{
		padding: 0px;
	}
	.text-left{
		text-align: start !important;
	}
	.visibility-0{
		visibility: hidden;
	}
	.tax-input-width{
		width: 80% !important;
	}
	.resize-none{
		resize: none
	}
	.required-red{
		color: red;
		padding-left: 5px;
    	padding-top: 5px;
	}
	.theme-bg-color{
		color: #004AAD !important;
		background-color: white !important;
	}
	.form-buttons{
		border: 1px solid #ddd; 
		font-size: 16px; 
		height:100%; 
		display: flex; 
		justify-content: center; 
		align-items: center; 
		color: white !important; 
		border-radius: 5px;
		font-weight: 600;
		padding: 6px 60px;
		font-family: "Parkinsans", sans-serif;
		background-color: #004AAD !important;
	}
	.mix-input-icon-width{
		width: 35px;
	}
	.w-full{
		width: 100%;
	}
	.mix-input-icon-left-tag{
		border-top-left-radius: 5px !important;
		border-bottom-left-radius: 5px !important;
		overflow: hidden;
		border: 1px solid #004AAD;
		border-right: none;
		position: absolute;
		padding: 8px 9px !important;
	}
	.mix-input-icon-right-tag{
		border-top-right-radius: 5px !important;
		border-bottom-right-radius: 5px !important;
		overflow: hidden;
		border: 1px solid #004AAD;
		border-left: none;
	}
	.avatar-container{
		height: 116px;
		display: flex;
		align-items: flex-end;
		justify-content: center;
	}
	.avatar-container:hover{
		cursor: pointer;
	}
	.margin-top-50{
		margin-top: 50px;
	}
	.justify-right{
		display: flex;
		justify-content: end;
	}
	.bg-white{
		background-color: white !important;
	}
	.cursor-pointer:hover{
		cursor: pointer;
	}
	.m-0{
		margin: 0px !important;
	}
	.p-0{
		padding: 0px !important;
	}
	.form-header{
		font-size: 24px;
		font-weight: 700;
		margin-left: 0px;
		margin-bottom: 15px;
		color: #34495e;
	}
	.form-group-container{
		display: flex;
		justify-content: end;
		gap: 10px;
	}
	.custom-form-group{
		border-radius: 5px;
	}
	.custom-input{
		border: 1px solid #ddd !important;
		border-radius: 15px !important;
		overflow: hidden;
	}
	.custom-input:focus{
		border: 1px solid #ddd !important;
		border-radius: 15px !important;
		overflow: hidden;
	}
	.custom-input-without-right-border{
		border: 1px solid #ddd !important;
		border-radius: 15px !important;
		border-top-right-radius: 0px !important;
    	border-bottom-right-radius: 0px !important;
		border-right: 0px !important;
		overflow: hidden;
	}
	.custom-input-without-right-border:focus{
		border: 1px solid #ddd !important;
		border-top-right-radius: 0px !important;
    	border-bottom-right-radius: 0px !important;
		border-radius: 15px !important;
		border-right: 0px !important;
		overflow: hidden;
	}
	.custom-input-with-border{
		border: 1px solid #ddd !important;
		border-radius: 15px !important;
		overflow: hidden;
	}
	.custom-input-with-border:focus{
		border: 1px solid #ddd !important;
		border-radius: 15px !important;
		overflow: hidden;
	}
	.file-upload-thumbnail{
		width: 300px;
	}
	.file-upload-controls{
		display: flex;
    	justify-content: center;
	}
	.d-flex{
		display: flex;
		flex-direction: column;
	}
	.m-b-0{
		margin-bottom: 0px;
	}
	.display-none{
		display: none;
	}
	.has-error{
		color: red !important;
	}
	li {
		list-style: none;
	}
	.has-error .input-group-addon {
		color: red !important;
	}
	.has-error .form-control, .has-error .form-control:focus {
		border: 2px solid #e74c3c !important;
	}
	.customized-error-input > li{
		position: absolute;
		z-index: 10;
		top: 35px;
		left: 0px;
	}
	.toaster {
		position: fixed;
		top: 60px;
		right: 20px;
		background-color: green;
		color: white;
		padding: 10px 20px;
		border-radius: 5px;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		font-size: 14px;
		opacity: 0;
		transform: translateY(20px);
		transition: opacity 0.3s ease, transform 0.3s ease;
		z-index: 100000;
	}

	.toaster.show {
		opacity: 1;
		transform: translateY(0);
	}
	.new-form-design-container{
		background-color: white;
		border-radius: 20px;
		box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	}
	.new-form-design-background{
		background-color: #f3eeee7d;
   		padding: 20px 25px;
	}
	.design-header{
		padding-top: 1%;
		margin-left: 1%;
		font-size: 16px;
		font-weight: 700;
		display: flex;
		align-items: center;
	}
	.design-header-text{
		padding-left: 10px;
		padding-top: 5px;
		color: #34495e;
	}
	.mb-0{
		margin-bottom: 0px;
	}
	.mt-10{
		margin-top: 10px;
	}
	.mx-10{
		margin: 0px 10px !important;
	}
	.pb-10{
		padding-bottom: 10px !important;
	}
	.ml-0{
		margin-left: 0px !important;
	}
	.custom-ul{
		display: flex;
		flex-wrap: wrap;
		gap: 25px;
		padding: 0;
		margin: 0;
		list-style: none;
	}
	.truncate-text {
		width: 100px;
		white-space: nowrap;
		overflow: hidden; 
		text-overflow: ellipsis;
		display: block;
	}
	.d-flex-row{
		display: flex;
		align-items: center;
		gap: 5px;
	}
	.inner-checkboxes-container{
		display: flex;
		flex-wrap: wrap;
		gap: 15px;
	}
	.w-28{
		width: 28vw;
	}
	.custom-input-width-with-error{
		width: 92% !important;
		float: right !important;
		border-top-right-radius: 15px !important;
    	border-bottom-right-radius: 15px !important;
	}
</style>
<div id="custom-toaster" class="toaster">Oultet has been <?php echo $toaster_text; ?>.</div>

<?php echo form_open($controller_name . '/save/' . $person_info->person_id, array('id'=>'outlet_form', 'class'=>'form-horizontal')); ?>
	<div class="new-form-design-background">
		<div class="form-header"><?php echo $text; ?> Outlet</div>
		<div class="new-form-design-container">
			<div class="design-header">
				<span class="glyphicon glyphicon-cog"></span><span class="design-header-text">General <?php echo $this->lang->line("employees_basic_information"); ?></span>
			</div>
			<hr class="mb-0 mt-10">
			<fieldset class="row m-0 p-0" id="employee_basic_info">
            <div class="col-xs-4 padding-20">
                <div class="form-group form-group-sm">	
                    <?php echo form_label('Branch Name', 'branch_name', array('class'=>'control-label')); ?><span class="required-red">*</span>
                    <?php echo form_input(array(
                        'name'=>'branch_name',
                        'id'=>'branch_name',
                        'placeholder' => "Branch Name",
                        'class'=>'form-control input-sm custom-input-with-border',
                        'value'=>$person_info->branch_name)
                    );?>
                </div>
            </div>
			</fieldset>

			<div class="design-header mt-10">
				<span class="glyphicon glyphicon-cog"></span><span class="design-header-text"><?php echo $this->lang->line("employees_login_info"); ?> <?php echo $this->lang->line("employees_basic_information"); ?></span>
			</div>
			<hr class="mb-0 mt-10">
			<fieldset class="row m-0 p-0" id="outlet_login_info">
				<div class="row mx-10">
					<div class="col-xs-4 padding-20">	
						<div class="form-group form-group-sm">	
							<?php echo form_label($this->lang->line('employees_username'), 'username', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<div class="input-group w-full custom-form-group">
								<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-user"></span></span>
								<?php echo form_input(array(
									'name'=>'username',
									'id'=>'username',
									'class'=>'form-control input-sm custom-input custom-input-width-with-error',
									'value'=> $person_info->username)
								);?>
							</div>
						</div>
						<?php $password_label_attributes = $person_info->person_id == "" ? array('class'=>'required') : array(); ?>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">	
							<?php echo form_label($this->lang->line('employees_password'), 'password', array_merge($password_label_attributes, array('class'=>'control-label'))); ?>
							<div class="input-group w-full custom-form-group">
								<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-lock"></span></span>
								<?php echo form_password(array(
									'name'=>'password',
									'id'=>'password',
									'class'=>'form-control input-sm custom-input custom-input-width-with-error')
								);?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">	
							<?php echo form_label($this->lang->line('employees_repeat_password'), 'repeat_password', array_merge($password_label_attributes, array('class'=>'control-label'))); ?>
							<div class="input-group w-full custom-form-group">
								<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-lock"></span></span>
								<?php echo form_password(array(
									'name'=>'repeat_password',
									'id'=>'repeat_password',
									'class'=>'form-control input-sm custom-input custom-input-width-with-error')
								);?>
							</div>
						</div>
					</div>
				</div>
				
			</fieldset>
            <div class="row mx-10 pb-10">
				<div class="form-group-container">
				<div class="margin-top-50 justify-right">
					<button class='form-buttons theme-transition-effect' type="button" title="Cancel" onclick="window.location.href='<?php echo site_url("$controller_name"); ?>';">
						Cancel
					</button>
				</div>
				<div class="margin-top-50">
					<button class='form-buttons theme-transition-effect' type="button" title="Submit" onclick="submitHandler();">
						<?php echo $submit_text; ?>
					</button>
				</div>
			</div>

			
		</div>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling

function submitHandler(){

	$('#outlet_form').submit();
}

function customToaster(){
	const toaster = document.getElementById('custom-toaster');
	toaster.classList.add('show');

	// Hide the toaster after 1 second
	setTimeout(() => {
		toaster.classList.remove('show');
	}, 3000);
}

$(document).ready(function()
{
	$('.content-wrapper').css('padding', '0px');

	$.validator.setDefaults({ ignore: [] });

	$.validator.addMethod('module', function (value, element) {
		var result = $('#permission_list input').is(':checked');
		$('.module').each(function(index, element)
		{
			var parent = $(element).parent();
			var checked =  $(element).is(':checked');
			if($('ul', parent).length > 0 && result)
			{
				result &= !checked || (checked && $('ul > li > input:checked', parent).length > 0);
			}
		});
		return result;
	}, "<?php echo $this->lang->line('employees_subpermission_required'); ?>");

	$('ul#permission_list > li > input.module').each(function()
	{
		var $this = $(this);
		$('ul > li > input,select', $this.parent()).each(function()
		{
			var $that = $(this);
			var updateInputs = function (checked)
			{
				$that.prop('disabled', !checked);
				!checked && $that.prop('checked', false);
			}
			$this.change(function() {
				updateInputs($this.is(':checked'));
			});
			updateInputs($this.is(':checked'));
		});
	});
	
	$('#outlet_form').validate($.extend({
        
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)
				{
					console.log("asADAd",response)
					// dialog_support.hide();
					// table_support.handle_submit("<?php echo site_url($controller_name); ?>", response);
					customToaster();
					if(response){
						window.location.href = '<?php echo site_url($controller_name); ?>';
					}
				},
				dataType: 'json'
			});
		},

		errorLabelContainer: '#error_message_box',

		rules:
		{
			branch_name: 'required',
			username:
			{

				required: true,
				minlength: 5,
				remote: '<?php echo site_url("$controller_name/check_username/$employee_id")?>'
			},
			password:
			{
				<?php
				if($person_info->person_id == '')
				{
				?>
					required: true,
				<?php
				}
				?>
				minlength: 8
			},	
			repeat_password:
			{
				equalTo: '#password'
			},
			email: 'email'
		},

		messages: 
		{
			branch_name: "<?php echo 'Branch name is required'; ?>",
			username:
			{
				required: "<?php echo $this->lang->line('employees_username_required'); ?>",
				minlength: "<?php echo $this->lang->line('employees_username_minlength'); ?>",
				remote: "<?php echo $this->lang->line('employees_username_duplicate'); ?>"
            },
			password:
			{
				<?php
				if($person_info->person_id == "")
				{
				?>
				required: "<?php echo $this->lang->line('employees_password_required'); ?>",
				<?php
				}
				?>
				minlength: "<?php echo $this->lang->line('employees_password_minlength'); ?>"
			},
			repeat_password:
			{
				equalTo: "<?php echo $this->lang->line('employees_password_must_match'); ?>"
			},
			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>"
		}
	}, form_support.error));
});
</script>
