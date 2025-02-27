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
	.readonly-icon{
		background-color: #ecf0f1 !important;
	}
	.custom-input-width-with-error{
		width: 92% !important;
		float: right !important;
		border-top-right-radius: 15px !important;
    	border-bottom-right-radius: 15px !important;
	}
	.font-trim{
		font-size: 13px !important;
		font-weight: 500 !important;
	}
</style>

<div id="custom-toaster" class="toaster">Customer has been <?php echo $toaster_text; ?>.</div>

<!-- <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul> -->

<?php echo form_open($controller_name . '/save/' . $person_info->person_id, array('id'=>'customer_form', 'class'=>'form-horizontal')); ?>
	<!-- <ul class="nav nav-tabs nav-justified" data-tabs="tabs">
		<li class="active" role="presentation">
			<a data-toggle="tab" href="#customer_basic_info"><?php echo $this->lang->line("customers_basic_information"); ?></a>
		</li>
		<?php
		if(!empty($stats))
		{
		?>
			<li role="presentation">
				<a data-toggle="tab" href="#customer_stats_info"><?php echo $this->lang->line("customers_stats_info"); ?></a>
			</li>
		<?php
		}
		?>
		<?php
		if(!empty($mailchimp_info) && !empty($mailchimp_activity))
		{
		?>
			<li role="presentation">
				<a data-toggle="tab" href="#customer_mailchimp_info"><?php echo $this->lang->line("customers_mailchimp_info"); ?></a>
			</li>
		<?php
		}
		?>
	</ul> -->
	<div class="new-form-design-background">
		<div class="form-header"><?php echo $text; ?> CUSTOMER</div>
		<div class="new-form-design-container">
				<div class="design-header">
					<span class="glyphicon glyphicon-cog"></span><span class="design-header-text">General Details</span>
				</div>
				<hr class="mb-0 mt-10">
				<div class="tab-pane fade in active" id="customer_basic_info">
					<fieldset class="row m-0 p-0">
					   <?php $this->load->view("people/form_basic_info"); ?>
					   <div class="design-header mt-10">
							<span class="glyphicon glyphicon-cog"></span><span class="design-header-text">Additional Details</span>
						</div>
					   <hr class="mb-0 mt-10">
					   <div class="row mx-10">
						<div class="col-xs-4 padding-20">
							<div>
								<div class="form-group form-group-sm m-b-0">
									<?php echo form_checkbox('consent', '1', $person_info->consent == '' ? (boolean)!$this->config->item('enforce_privacy') : (boolean)$person_info->consent); ?>
									<?php echo form_label($this->lang->line('customers_consent'), 'consent', array('class' => 'control-label')); ?><span class="required-red">*</span>
								</div>
							</div>
						</div>
						<div class="col-xs-4 padding-20">
							<div class="form-group form-group-sm radio-parent">
								<?php echo form_label($this->lang->line('customers_discount_type'), 'discount_type', array('class'=>'control-label text-left')); ?>
								<div>
									<div class="radio-inline">
										<?php echo form_radio(array(
												'name'=>'discount_type',
												'type'=>'radio',
												'id'=>'discount_type',
												'value'=>0,
												'checked'=>$person_info->discount_type == PERCENT)
										); ?> <?php echo $this->lang->line('customers_discount_percent'); ?>
									</div>
									<div class="radio-inline">
										<?php echo form_radio(array(
												'name'=>'discount_type',
												'type'=>'radio',
												'id'=>'discount_type',
												'value'=>1,
												'checked'=>$person_info->discount_type == FIXED)
										); ?> <?php echo $this->lang->line('customers_discount_fixed'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-4 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('customers_discount'), 'discount', array('class' => 'control-label')); ?>
								<?php echo form_input(array(
									'name'=>'discount',
									'id'=>'discount',
									'placeholder' => $this->lang->line('customers_discount'),
									'class'=>'form-control input-sm custom-input-with-border',
									'onClick'=>'this.select();',
									'value'=>$person_info->discount)
								); ?>
							</div>
						</div>
					   </div>
		
					   <div class="row mx-10">
						<div class="col-xs-4 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('customers_company_name'), 'company_name', array('class' => 'control-label')); ?>
								<?php echo form_input(array(
									'name'=>'company_name',
									'id'=>'company_name',
									'placeholder' => $this->lang->line('customers_company_name'),
									'class'=>'form-control input-sm custom-input-with-border font-trim',
									'value'=>$person_info->company_name)
								); ?>
							</div>
						</div>
						<div class="col-xs-4 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('customers_account_number'), 'account_number', array('class' => 'control-label')); ?>
								<?php echo form_input(array(
									'name'=>'account_number',
									'id'=>'account_number',
									'class'=>'form-control input-sm custom-input-with-border',
									'placeholder' => $this->lang->line('customers_account_number'),
									'value'=>$person_info->account_number)
								); ?>
							</div>
						</div>
						<div class="col-xs-4 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('customers_tax_id'), 'tax_id', array('class' => 'control-label')); ?>
								<?php echo form_input(array(
										'name'=>'tax_id',
										'id'=>'tax_id',
										'placeholder' => $this->lang->line('customers_tax_id'),
										'class'=>'form-control input-sm custom-input-with-border',
										'value'=>$person_info->tax_id)
								); ?>
							</div>
						</div>
					   </div>
		
						<?php if($this->config->item('customer_reward_enable') == TRUE): ?>
							<div class="row mx-10">
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('rewards_package'), 'rewards', array('class'=>'control-label')); ?>
										<?php echo form_dropdown('package_id', $packages, $selected_package, array('class'=>'form-control')); ?>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_available_points'), 'available_points', array('class' => 'control-label')); ?>
										<?php echo form_input(array(
											'name'=>'available_points',
											'id'=>'available_points',
											'placeholder' => $this->lang->line('customers_available_points'),
											'class'=>'form-control input-sm',
											'value'=>$person_info->points,
											'disabled'=>'')
										); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
		
						<div class="row mx-10">
							<div class="col-xs-4 padding-20">
								<div class="form-group form-group-sm">
									<?php echo form_label($this->lang->line('customers_taxable'), 'taxable', array('class' => 'control-label')); ?>
									<?php echo form_checkbox('taxable', '1', $person_info->taxable == '' ? TRUE : (boolean)$person_info->taxable); ?>
								</div>
							</div>
							<div class="col-xs-4 padding-20">
								<?php
									if($use_destination_based_tax)
									{
									?>
										<div class="form-group form-group-sm">
											<?php echo form_label($this->lang->line('customers_tax_code'), 'sales_tax_code_name', array('class'=>'control-label')); ?>
											<div class="input-group input-group-sm">
												<?php echo form_input(array(
														'name'=>'sales_tax_code_name',
														'id'=>'sales_tax_code_name',
														'placeholder' => $this->lang->line('customers_tax_code'),
														'class'=>'form-control input-sm custom-input-with-border',
														'size'=>'50',
														'value'=>$sales_tax_code_label)
												); ?>
												<?php echo form_hidden('sales_tax_code_id', $person_info->sales_tax_code_id); ?>
											</div>
										</div>
									<?php
									}
								?>
							</div>
						</div>
		
						<div class="row mx-10">
							<div class="col-xs-4 padding-20">
								<div class="form-group form-group-sm">
									<?php echo form_label($this->lang->line('customers_date'), 'date', array('class'=>'control-label')); ?>
									<div class="input-group w-full custom-form-group cursor-pointer">
										<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon"><span class="glyphicon glyphicon-calendar"></span></span>
										<?php echo form_input(array(
											'name'=>'date',
											'id'=>'datetime',
											'class'=>'form-control input-sm custom-input cursor-pointer custom-input-width-with-error',
											'value'=>to_datetime(strtotime($person_info->date)),
											'readonly'=>'true')
										); ?>
									</div>
								</div>
							</div>
							<div class="col-xs-4 padding-20">
								<div class="form-group form-group-sm">
									<?php echo form_label($this->lang->line('customers_employee'), 'employee', array('class'=>'control-label')); ?>
									<?php echo form_input(array(
										'name'=>'employee',
										'id'=>'employee',
										'class'=>'form-control input-sm custom-input-with-border cursor-pointer',
										'placeholder' => $this->lang->line('customers_employee'),
										'value'=>$employee,
										'readonly'=>'true')
									); ?>
								</div>
							</div>
						</div>
		
						<?php echo form_hidden('employee_id', $person_info->employee_id); ?>
					</fieldset>
				</div>
		
				<?php
				if(!empty($stats))
				{
				?>
					<div class="tab-pane" id="customer_stats_info">
						<fieldset class="row m-0 p-0">
							<div class="row mx-10">
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_total'), 'total', array('class' => 'control-label')); ?>
										<div class="input-group w-full custom-form-group cursor-pointer">
											<?php if (!currency_side()): ?>
												<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon">
													<b><?php echo $this->config->item('currency_symbol'); ?></b>
												</span>
											<?php endif; ?>
											<?php echo form_input(array(
													'name'=>'total',
													'id'=>'total',
													'class'=>'form-control input-sm custom-input cursor-pointer custom-input-width-with-error',
													'value'=>to_currency_no_money($stats->total),
													'disabled'=>'')
													); ?>
											<?php if (currency_side()): ?>
												<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon">
													<b><?php echo $this->config->item('currency_symbol'); ?></b>
												</span>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_max'), 'max', array('class' => 'control-label')); ?>
										<div class="input-group w-full custom-form-group cursor-pointer">
											<?php if (!currency_side()): ?>
												<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
											<?php endif; ?>
											<?php echo form_input(array(
													'name'=>'max',
													'id'=>'max',
													'class'=>'form-control input-sm custom-input cursor-pointer custom-input-width-with-error',
													'value'=>to_currency_no_money($stats->max),
													'disabled'=>'')
													); ?>
											<?php if (currency_side()): ?>
												<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_min'), 'min', array('class' => 'control-label')); ?>
										<div class="input-group w-full custom-form-group cursor-pointer">
											<?php if (!currency_side()): ?>
												<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
											<?php endif; ?>
											<?php echo form_input(array(
													'name'=>'min',
													'id'=>'min',
													'class'=>'form-control input-sm custom-input cursor-pointer custom-input-width-with-error',
													'value'=>to_currency_no_money($stats->min),
													'disabled'=>'')
													); ?>
											<?php if (currency_side()): ?>
												<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="row mx-10">
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_average'), 'average', array('class' => 'control-label')); ?>
										<div class="input-group w-full custom-form-group cursor-pointer">
											<?php if (!currency_side()): ?>
												<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
											<?php endif; ?>
											<?php echo form_input(array(
													'name'=>'average',
													'id'=>'average',
													'class'=>'form-control input-sm custom-input cursor-pointer custom-input-width-with-error',
													'value'=>to_currency_no_money($stats->average),
													'disabled'=>'')
													); ?>
											<?php if (currency_side()): ?>
												<span class="input-group-addon input-sm mix-input-icon-width mix-input-icon-left-tag readonly-icon"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_quantity'), 'quantity', array('class' => 'control-label')); ?>
										<div class="input-group w-full custom-form-group cursor-pointer">
											<?php echo form_input(array(
													'name'=>'quantity',
													'id'=>'quantity',
													'class'=>'form-control input-sm custom-input-with-border cursor-pointer',
													'value'=>$stats->quantity,
													'disabled'=>'')
													); ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_avg_discount'), 'avg_discount', array('class' => 'control-label')); ?>
										<div class="input-group w-full custom-form-group cursor-pointer">
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
							</div>
						</fieldset>
					</div>
				<?php
				}
				?>
		
				<?php
				if(!empty($mailchimp_info) && !empty($mailchimp_activity))
				{
				?>
					<div class="tab-pane" id="customer_mailchimp_info">
						<fieldset class="row m-0 p-0">
							<div class="row mx-10">
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_status'), 'mailchimp_status', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-4'>
											<?php echo form_dropdown('mailchimp_status', 
												array(
													'subscribed' => 'subscribed',
													'unsubscribed' => 'unsubscribed',
													'cleaned' => 'cleaned',
													'pending' => 'pending'
												),
												$mailchimp_info['status'],
												array('id' => 'mailchimp_status', 'class' => 'form-control input-sm')); ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_vip'), 'mailchimp_vip', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-1'>
											<?php echo form_checkbox('mailchimp_vip', '1', $mailchimp_info['vip'] == '' ? FALSE : (boolean)$mailchimp_info['vip']); ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_member_rating'), 'mailchimp_member_rating', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-4'>
											<?php echo form_input(array(
													'name'=>'mailchimp_member_rating',
													'class'=>'form-control input-sm',
													'value'=>$mailchimp_info['member_rating'],
													'disabled'=>'')
													); ?>
										</div>
									</div>
								</div>
							</div>
		
							<div class="row mx-10">
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_activity_total'), 'mailchimp_activity_total', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-4'>
											<?php echo form_input(array(
													'name'=>'mailchimp_activity_total',
													'class'=>'form-control input-sm',
													'value'=>$mailchimp_activity['total'],
													'disabled'=>'')
													); ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_activity_lastopen'), 'mailchimp_activity_lastopen', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-4'>
											<?php echo form_input(array(
													'name'=>'mailchimp_activity_lastopen',
													'class'=>'form-control input-sm',
													'value'=>$mailchimp_activity['lastopen'],
													'disabled'=>'')
													); ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_activity_open'), 'mailchimp_activity_open', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-4'>
											<?php echo form_input(array(
													'name'=>'mailchimp_activity_open',
													'class'=>'form-control input-sm',
													'value'=>$mailchimp_activity['open'],
													'disabled'=>'')
													); ?>
										</div>
									</div>
								</div>
							</div>
		
							<div class="row mx-10">
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_activity_click'), 'mailchimp_activity_click', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-4'>
											<?php echo form_input(array(
													'name'=>'mailchimp_activity_click',
													'class'=>'form-control input-sm',
													'value'=>$mailchimp_activity['click'],
													'disabled'=>'')
													); ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_activity_unopen'), 'mailchimp_activity_unopen', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-4'>
											<?php echo form_input(array(
													'name'=>'mailchimp_activity_unopen',
													'class'=>'form-control input-sm',
													'value'=>$mailchimp_activity['unopen'],
													'disabled'=>'')
													); ?>
										</div>
									</div>
								</div>
								<div class="col-xs-4 padding-20">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('customers_mailchimp_email_client'), 'mailchimp_email_client', array('class' => 'control-label col-xs-3')); ?>
										<div class='col-xs-4'>
											<?php echo form_input(array(
													'name'=>'mailchimp_email_client',
													'class'=>'form-control input-sm',
													'value'=>$mailchimp_info['email_client'],
													'disabled'=>'')
													); ?>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				<?php
				}
				?>
			<div class="row mx-10 pb-10">
				<div class="form-group-container">
				<div class="margin-top-50 justify-right">
					<button class='form-buttons theme-transition-effect' type="button" title="Cancel" onclick="window.location.href='<?php echo site_url("$controller_name"); ?>';">
						Cancel
					</button>
				</div>
				<div class="margin-top-50">
					<button class='form-buttons theme-transition-effect' type="button" title="Submit" onclick="customerSubmitHandler();">
						<?php echo $submit_text; ?>
					</button>
				</div>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>

<?php $this->load->view("partial/footer"); ?>

<script type="text/javascript">
//validation and submit handling
function customerSubmitHandler(){
	$('#customer_form').submit();
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

	$('#customer_form').validate($.extend({
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)
				{
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
			consent: "<?php echo $this->lang->line('customers_consent_required'); ?>",
			email: "<?php echo $this->lang->line('customers_email_duplicate'); ?>",
			account_number: "<?php echo $this->lang->line('customers_account_number_duplicate'); ?>"
		}
	}, form_support.error));
});
</script>
