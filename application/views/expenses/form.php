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
		border-top-left-radius: 15px !important;
		border-bottom-left-radius: 15px !important;
		overflow: hidden;
		border: 1px solid #ddd;
		border-right: none;
		position: absolute;
		padding: 8px 9px !important;
	}
	.mix-input-icon-right-tag{
		border-top-right-radius: 15px !important;
		border-bottom-right-radius: 15px !important;
		overflow: hidden;
		border: 1px solid #ddd;
		border-left: none;
	}
	.mix-input-icon-right-tag:hover{
		border: 1px solid #ddd;
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
	.custom-input-width-with-error{
		width: 92% !important;
		float: right !important;
		border-top-right-radius: 15px !important;
    	border-bottom-right-radius: 15px !important;
	}
	.supplier-custom-container{
		display: flex !important;
	}
	.supplier-custom-container > a > span{
		scale: 1.3;
    	color: red;
	}
	.font-10{
		font-size: 10px !important;
	}
</style>

<div id="custom-toaster" class="toaster">Expense has been <?php echo $toaster_text; ?>.</div>

<?php echo form_open('expenses/save/'.$expenses_info->expense_id, array('id'=>'expenses_edit_form', 'class'=>'form-horizontal')); ?>
	<fieldset id="item_basic_info" class="row m-0 p-0">
		<div class="new-form-design-background">
			<div class="form-header"><?php echo $text; ?> Expense</div>
			<div class="new-form-design-container">
				<div class="design-header">
					<span class="glyphicon glyphicon-cog"></span><span class="design-header-text">Expense Info</span>
				</div>
				<hr class="mb-0 mt-10">
				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('expenses_date'), 'date', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<div class="input-group w-full custom-form-group">
								<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-calendar"></span></span>
								<?php echo form_input(array(
										'name'=>'date',
										'class'=>'form-control input-sm datetime custom-input custom-input-width-with-error',
										'value'=>to_datetime(strtotime($expenses_info->date)),
										'readonly'=>'readonly')
										);?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('expenses_supplier_name'), 'supplier_name', array('class'=>'control-label')); ?>
							<div class="supplier-custom-container">
								<?php echo form_input(array(
										'name'=>'supplier_name',
										'id'=>'supplier_name',
										'class'=>'form-control input-sm custom-input-with-border',
										'value'=>$this->lang->line('expenses_start_typing_supplier_name'))
									);
									echo form_input(array(
										'type'=>'hidden',
										'name'=>'supplier_id',
										'id'=>'supplier_id')
										);?>
								<a id="remove_supplier_button" class="btn btn-sm" title="Remove Supplier">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('expenses_supplier_tax_code'), 'supplier_tax_code', array('class'=>'control-label')); ?>
							<?php echo form_input(array(
									'name'=>'supplier_tax_code',
									'id'=>'supplier_tax_code',
									'class'=>'form-control input-sm custom-input-with-border',
									'value'=>$expenses_info->supplier_tax_code)
									);?>
						</div>
					</div>
				</div>
				<div class="row mx-10">
				    <div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('expenses_amount'), 'amount', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<div class="input-group w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag "><b class="font-10"><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b class="font-10"><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'amount',
										'id'=>'amount',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($expenses_info->amount))
										);?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('expenses_tax_amount'), 'tax_amount', array('class'=>'control-label')); ?>
							<div class="input-group w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b class="font-10"><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b class="font-10"><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'tax_amount',
										'id'=>'tax_amount',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($expenses_info->tax_amount))
										);?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('expenses_payment'), 'payment_type', array('class'=>'control-label')); ?>
							<?php echo form_dropdown('payment_type', $payment_options, $expenses_info->payment_type, array('class'=>'form-control cursor-pointer custom-input-with-border', 'id'=>'payment_type'));?>
						</div>
					</div>
				</div>
				<div class="row mx-10">
				  <div class="col-xs-4 padding-20">
					  <div class="form-group form-group-sm">
						  <?php echo form_label($this->lang->line('expenses_categories_name'), 'category', array('class'=>'control-label')); ?>
						  <?php echo form_dropdown('expense_category_id', $expense_categories, $expenses_info->expense_category_id, array('class'=>'form-control cursor-pointer custom-input-with-border', 'id'=>'category')); ?>
					  </div>
				  </div>
				  <div class="col-xs-4 padding-20">
					<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('expenses_employee'), 'employee', array('class'=>'control-label')); ?>
							<?php echo form_dropdown('employee_id', $employees, $expenses_info->employee_id, 'id="employee_id" class="form-control cursor-pointer custom-input-with-border"');?>
					</div>
				  </div>
				</div>
				<div class="row mx-10">
					<div class="col-xs-8 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('expenses_description'), 'description', array('class'=>'control-label')); ?>
							<?php echo form_textarea(array(
								'name'=>'description',
								'id'=>'description',
								'rows'=>'4',
								'class'=>'form-control input-sm resize-none custom-input-with-border',
								'value'=>$expenses_info->description)
								);?>
						</div>
					</div>
				</div>
				<div class="row mx-10">
				  <div class="col-xs-4 padding-20">
				  		<?php
						if(!empty($expenses_info->expense_id))
						{
						?>
							<div class="form-group form-group-sm">
								<?php echo form_checkbox(array(
									'name'=>'deleted',
									'id'=>'deleted',
									'value'=>1,
									'checked'=>($expenses_info->deleted) ? 1 : 0)
								);?>
								<?php echo form_label($this->lang->line('expenses_is_deleted').':', 'deleted', array('class'=>'control-label')); ?>
							</div>
						<?php
						}
						?>
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

<script type='text/javascript'>

function submitHandler(){
	$('#expenses_edit_form').submit();
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
	<?php $this->load->view('partial/datepicker_locale'); ?>

	var amount_validator = function(field) {
		return {
			url: "<?php echo site_url($controller_name . '/ajax_check_amount')?>",
			type: 'POST',
			dataFilter: function(data) {
				var response = JSON.parse(data);
				return response.success;
			}
		}
	}

	$('#supplier_name').click(function() {
		$(this).attr('value', '');
	});

	$('#supplier_name').autocomplete({
		source: '<?php echo site_url("suppliers/suggest"); ?>',
		minChars:0,
		delay:10,
		select: function (event, ui) {
			$('#supplier_id').val(ui.item.value);
			$(this).val(ui.item.label);
			$(this).attr('readonly', 'readonly');
			$('#remove_supplier_button').css('display', 'inline-block');
			return false;
		}
	});

	$('#supplier_name').blur(function() {
		$(this).attr('value',"<?php echo $this->lang->line('expenses_start_typing_supplier_name'); ?>");
	});

	$('#remove_supplier_button').css('display', 'none');

	$('#remove_supplier_button').click(function() {
		$('#supplier_id').val('');
		$('#supplier_name').removeAttr('readonly');
		$('#supplier_name').val('');
		$(this).css('display', 'none');
	});

	<?php
	if(!empty($expenses_info->expense_id))
	{
	?>
		$('#supplier_id').val('<?php echo $expenses_info->supplier_id ?>');
		$('#supplier_name').val('<?php echo $expenses_info->supplier_name ?>').attr('readonly', 'readonly');
		$('#remove_supplier_button').css('display', 'inline-block');
	<?php
	}
	?>

	$('#expenses_edit_form').validate($.extend({
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)
				{	
					console.log("response",response)
					customToaster();
					if(response){
						// window.location.href = '<?php echo site_url($controller_name); ?>';
					}
				},
				dataType: 'json'
			});
		},

		errorLabelContainer: '#error_message_box',

		ignore: '',

		rules:
		{
			category: 'required',
			date:
			{
				required: true
			},
			amount:
			{
				required: true,
				remote: amount_validator('#amount')
			},
			tax_amount:
			{
				remote: amount_validator('#tax_amount')
			}
		},

		messages:
		{
			category: "<?php echo $this->lang->line('expenses_category_required'); ?>",
			date:
			{
				required: "<?php echo $this->lang->line('expenses_date_required'); ?>"

			},
			amount:
			{
				required: "<?php echo $this->lang->line('expenses_amount_required'); ?>",
				remote: "<?php echo $this->lang->line('expenses_amount_number'); ?>"
			},
			tax_amount:
			{
				remote: "<?php echo $this->lang->line('expenses_tax_amount_number'); ?>"
			}
		}
	}, form_support.error));
});
</script>
