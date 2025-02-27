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
<!-- <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div> -->

<!-- <ul id="error_message_box" class="error_message_box"></ul> -->

<div id="custom-toaster" class="toaster">Supplier has been <?php echo $toaster_text; ?>.</div>
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
		border-top-left-radius: 0px !important;
    	border-bottom-left-radius: 0px !important;
		border-left: 0px !important;
		overflow: hidden;
	}
	.custom-input:focus{
		border: 1px solid #ddd !important;
		border-radius: 15px !important;
		border-top-left-radius: 0px !important;
    	border-bottom-left-radius: 0px !important;
		border-left: 0px !important;
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
</style>

<?php echo form_open($controller_name . '/save/' . $person_info->person_id, array('id'=>'supplier_form', 'class'=>'form-horizontal')); ?>
	<fieldset id="supplier_basic_info" class="row m-0 p-0">
		<div class="new-form-design-background">
			<div class="form-header"><?php echo $text; ?> SUPPLIER</div>
			<div class="new-form-design-container">
				<div class="design-header">
					<span class="glyphicon glyphicon-cog"></span><span class="design-header-text">General Details</span>
				</div>
				<hr class="mb-0 mt-10">
				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('suppliers_company_name'), 'company_name', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<?php echo form_input(array(
								'name'=>'company_name',
								'id'=>'company_name_input',
								'class'=>'form-control input-sm custom-input-with-border',
								'value'=>$person_info->company_name)
								);?>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('suppliers_category'), 'category', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<?php echo form_dropdown('category', $categories, $person_info->category, array('class'=>'form-control cursor-pointer custom-input-with-border', 'id'=>'category'));?>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">	
							<?php echo form_label($this->lang->line('suppliers_agency_name'), 'agency_name', array('class'=>'control-label')); ?>
							<?php echo form_input(array(
								'name'=>'agency_name',
								'id'=>'agency_name_input',
								'class'=>'form-control input-sm custom-input-with-border',
								'value'=>$person_info->agency_name)
								);?>
						</div>
					</div>
				</div>

				<?php $this->load->view("people/form_basic_info"); ?>

				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">	
							<?php echo form_label($this->lang->line('suppliers_account_number'), 'account_number', array('class'=>'control-label')); ?>
							<?php echo form_input(array(
								'name'=>'account_number',
								'id'=>'account_number',
								'class'=>'form-control input-sm custom-input-with-border',
								'value'=>$person_info->account_number)
								);?>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('suppliers_tax_id'), 'tax_id', array('class'=>'control-label')); ?>
							<?php echo form_input(array(
									'name'=>'tax_id',
									'id'=>'tax_id',
									'class'=>'form-control input-sm custom-input-with-border',
									'value'=>$person_info->tax_id)
							);?>
						</div>
					</div>
				</div>

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
	</fieldset>
<?php echo form_close(); ?>

<script type="text/javascript">

function submitHandler(){
	$('#supplier_form').submit();
}

function customToaster(){
	const toaster = document.getElementById('custom-toaster');
	toaster.classList.add('show');

	// Hide the toaster after 1 second
	setTimeout(() => {
		toaster.classList.remove('show');
	}, 3000);
}


//validation and submit handling
$(document).ready(function()
{
	$('.content-wrapper').css('padding', '0px');
	$('#supplier_form').validate($.extend({
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)
				{
					customToaster();
					// dialog_support.hide();
					// table_support.handle_submit("<?php echo site_url($controller_name); ?>", response);
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
			company_name: 'required',
			first_name: 'required',
			last_name: 'required',
			email: 'email'
   		},

		messages: 
		{
			company_name: "<?php echo $this->lang->line('suppliers_company_name_required'); ?>",
			first_name: "<?php echo $this->lang->line('common_first_name_required'); ?>",
			last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>"
		}
	}, form_support.error));
});
</script>
