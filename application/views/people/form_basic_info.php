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
<div class="row mx-10">
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_first_name'), 'first_name', array('class'=>'control-label')); ?><span class="required-red">*</span>
			<?php echo form_input(array(
				'name'=>'first_name',
				'id'=>'first_name',
				'placeholder' => $this->lang->line('common_first_name'),
				'class'=>'form-control input-sm custom-input-with-border',
				'value'=>$person_info->first_name)
			);?>
		</div>
	</div>
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_last_name'), 'last_name', array('class'=>'control-label')); ?><span class="required-red">*</span>
			<?php echo form_input(array(
				'name'=>'last_name',
				'id'=>'last_name',
				'placeholder' => $this->lang->line('common_last_name'),
				'class'=>'form-control input-sm custom-input-with-border',
				'value'=>$person_info->last_name)
			);?>
		</div>
	</div>
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm radio-parent">	
			<?php echo form_label($this->lang->line('common_gender'), 'gender', !empty($basic_version) ? array('class'=>'control-label') : array('class'=>'control-label text-left')); ?>
			<div>
				<div class="radio-inline">
					<?php echo form_radio(array(
							'name'=>'gender',
							'type'=>'radio',
							'id'=>'gender',
							'value'=>1,
							'checked'=>$person_info->gender === '1')
							); ?> <?php echo $this->lang->line('common_gender_male'); ?>
				</div>
				<div class="radio-inline margin-15">
					<?php echo form_radio(array(
							'name'=>'gender',
							'type'=>'radio',
							'id'=>'gender',
							'value'=>0,
							'checked'=>$person_info->gender === '0')
							); ?> <?php echo $this->lang->line('common_gender_female'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mx-10">
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_email'), 'email', array('class'=>'control-label')); ?>
			<div class="input-group w-full custom-form-group">
				<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-envelope"></span></span>
				<?php echo form_input(array(
						'name'=>'email',
						'id'=>'email',
						'placeholder' => $this->lang->line('common_email'),
						'class'=>'form-control input-sm custom-input custom-input-width-with-error',
						'value'=>$person_info->email)
						);?>
			</div>
		</div>
	</div>
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_phone_number'), 'phone_number', array('class'=>'control-label')); ?>
			<div class="input-group w-full custom-form-group">
				<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-phone-alt"></span></span>
				<?php echo form_input(array(
						'name'=>'phone_number',
						'id'=>'phone_number',
						'placeholder' => $this->lang->line('common_phone_number'),
						'class'=>'form-control input-sm custom-input custom-input-width-with-error',
						'value'=>$person_info->phone_number)
						);?>
			</div>
		</div>
	</div>
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_address_1'), 'address_1', array('class'=>'control-label')); ?>
			<?php echo form_input(array(
				'name'=>'address_1',
				'id'=>'address_1',
				'placeholder' => $this->lang->line('common_address_1'),
				'class'=>'form-control input-sm custom-input-with-border',
				'value'=>$person_info->address_1)
			);?>
		</div>
	</div>
</div>

<div class="row mx-10">
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_address_2'), 'address_2', array('class'=>'control-label')); ?>
			<?php echo form_input(array(
				'name'=>'address_2',
				'id'=>'address_2',
				'placeholder' => $this->lang->line('common_address_2'),
				'class'=>'form-control input-sm custom-input-with-border',
				'value'=>$person_info->address_2)
			);?>
		</div>
	</div>
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_city'), 'city', array('class'=>'control-label')); ?>
			<?php echo form_input(array(
				'name'=>'city',
				'id'=>'city',
				'placeholder' => $this->lang->line('common_city'),
				'class'=>'form-control input-sm custom-input-with-border',
				'value'=>$person_info->city)
			);?>
		</div>
	</div>
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_state'), 'state', array('class'=>'control-label')); ?>
			<?php echo form_input(array(
				'name'=>'state',
				'id'=>'state',
				'placeholder' => $this->lang->line('common_state'),
				'class'=>'form-control input-sm custom-input-with-border',
				'value'=>$person_info->state)
			);?>
		</div>
	</div>
</div>

<div class="row mx-10">
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_zip'), 'zip', array('class'=>'control-label')); ?>
			<?php echo form_input(array(
				'name'=>'zip',
				'id'=>'postcode',
				'placeholder' => $this->lang->line('common_zip'),
				'class'=>'form-control input-sm custom-input-with-border',
				'value'=>$person_info->zip)
			);?>
		</div>
	</div>
	<div class="col-xs-4 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_country'), 'country', array('class'=>'control-label')); ?>
			<?php echo form_input(array(
				'name'=>'country',
				'id'=>'country',
				'placeholder' => $this->lang->line('common_country'),
				'class'=>'form-control input-sm custom-input-with-border',
				'value'=>$person_info->country)
			);?>
		</div>
	</div>
</div>

<div class="row mx-10">
	<div class="col-xs-8 padding-20">
		<div class="form-group form-group-sm">	
			<?php echo form_label($this->lang->line('common_comments'), 'comments', array('class'=>'control-label')); ?>
			<?php echo form_textarea(array(
				'name'=>'comments',
				'id'=>'comments',
				'rows'=>'4',
				'placeholder' => $this->lang->line('common_comments'),
				'class'=>'form-control input-sm resize-none custom-input-with-border',
				'value'=>$person_info->comments)
			);?>
		</div>
	</div>
</div>
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
});
</script>