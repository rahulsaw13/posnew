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
</style>

<!-- <ul id="error_message_box" class="error_message_box"></ul> -->
<div id="custom-toaster" class="toaster">Item has been <?php echo $toaster_text; ?>.</div>

<?php echo form_open('items/save/'.$item_info->item_id, array('id'=>'item_form', 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal')); ?>
	<fieldset id="item_basic_info" class="row m-0 p-0">
		<div class="new-form-design-background">
			<div class="form-header"><?php echo $text; ?> ITEM</div>
			<div class="new-form-design-container">
				<div class="design-header">
					<span class="glyphicon glyphicon-cog"></span><span class="design-header-text">General Details</span>
				</div>
				<hr class="mb-0 mt-10">
				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('items_item_number'), 'item_number', array('class'=>'control-label')); ?>
							<div class="input-group w-full custom-form-group">
								<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-barcode"></span></span>
								<?php echo form_input(array(
										'name' => 'item_number',
										'id' => 'item_number',
										'placeholder' => $this->lang->line('items_item_number'),
										'class' => 'form-control input-sm custom-input custom-input-width-with-error',
										'value' => $item_info->item_number
									));
								?>
							</div>
						</div>
					</div>
			
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('items_name'), 'name', array('class' => 'control-label')); ?><span class="required-red">*</span>
							<?php echo form_input(array(
									'name' => 'name',
									'id' => 'name',
									'placeholder' => $this->lang->line('items_name'),
									'class' => 'form-control input-sm custom-input-with-border',
									'value' => $item_info->name
								));
							?>
						</div>
					</div>
			
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('items_batch_number'), 'batch_number', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<?php echo form_input(array(
								'name'=>'batch_number',
								'id'=>'batch_number',
								'placeholder' => $this->lang->line('items_batch_number'),
								'class'=>'form-control input-sm custom-input-with-border',
								'value'=>$item_info->batch_number)
							);?>
						</div>
					</div>
				</div>

				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('items_category'), 'category', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<div class="input-group w-full custom-form-group customized-error-input">
								<span class="input-group-addon input-sm theme-bg-color mix-input-icon-left-tag mix-input-icon-width"><span class="glyphicon glyphicon-tag"></span></span>
								<?php
									if($this->Appconfig->get('category_dropdown'))
									{
										echo form_dropdown('category', $categories, $selected_category, array('class'=>'form-control'));
									}
									else
									{
										echo form_input(array(
											'name'=>'category',
											'id'=>'category',
											'placeholder' => $this->lang->line('items_category'),
											'class'=>'form-control input-sm custom-input custom-input-width-with-error',
											'value'=>$item_info->category)
											);
									}
								?>
							</div>
						</div>
					</div>
			
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('items_supplier'), 'supplier', array('class'=>'control-label')); ?>
							<?php echo form_dropdown('supplier_id', $suppliers, $selected_supplier, array('class'=>'form-control cursor-pointer custom-input-with-border')); ?>
						</div>
					</div>

					<div class="col-xs-2 padding-20">
						<div class="form-group form-group-sm radio-parent">
							<?php echo form_label($this->lang->line('items_stock_type'), 'stock_type', !empty($basic_version) ? array('class'=>'control-label') : array('class'=>'control-label text-left')); ?>
							<div>
								<div class="radio-inline">
									<?php echo form_radio(array(
											'name'=>'stock_type',
											'type'=>'radio',
											'id'=>'stock_type',
											'value'=>0,
											'checked'=>$item_info->stock_type == HAS_STOCK)
									); ?> <?php echo $this->lang->line('items_stock'); ?>
								</div>
								<div class="radio-inline margin-15">
									<?php echo form_radio(array(
											'name'=>'stock_type',
											'type'=>'radio',
											'id'=>'stock_type',
											'value'=>1,
											'checked'=>$item_info->stock_type == HAS_NO_STOCK)
									); ?><?php echo $this->lang->line('items_nonstock'); ?>
								</div>
							</div>
						</div>
					</div>
			
					<div class="col-xs-2 padding-20">
						<div class="form-group form-group-sm radio-parent">
							<?php echo form_label($this->lang->line('items_type'), 'item_type', !empty($basic_version) ? array('class'=>'control-label') : array('class'=>'control-label text-left')); ?>
							<div>
								<div class="radio-inline">
									<?php
										$radio_button = array(
											'name'=>'item_type',
											'type'=>'radio',
											'id'=>'item_type',
											'value'=>0,
											'checked'=>$item_info->item_type == ITEM);
										if($standard_item_locked)
										{
											$radio_button['disabled'] = TRUE;
										}
										echo form_radio($radio_button); ?> <?php echo $this->lang->line('items_standard'); ?>
								</div>
								<div class="radio-inline margin-15">
									<?php
										$radio_button = array(
											'name'=>'item_type',
											'type'=>'radio',
											'id'=>'item_type',
											'value'=>1,
											'checked'=>$item_info->item_type == ITEM_KIT);
										if($item_kit_disabled)
										{
											$radio_button['disabled'] = TRUE;
										}
										echo form_radio($radio_button); ?> <?php echo $this->lang->line('items_kit');
									?>
								</div>
								<?php
								if($this->config->item('derive_sale_quantity') == '1')
								{
								?>
								<div class="radio-inline margin-15">
									<?php echo form_radio(array(
											'name' => 'item_type',
											'type' => 'radio',
											'id' => 'item_type',
											'value' => 2,
											'checked' => $item_info->item_type == ITEM_AMOUNT_ENTRY)
									); ?><?php echo $this->lang->line('items_amount_entry'); ?>
								</div>
								<?php
								}
								?>
								<?php
								if($allow_temp_item == 1)
								{
								?>
								<div class="radio-inline margin-15">
									<?php echo form_radio(array(
											'name'=>'item_type',
											'type'=>'radio',
											'id'=>'item_type',
											'value'=>3,
											'checked'=>$item_info->item_type == ITEM_TEMP)
									); ?> <?php echo $this->lang->line('items_temp'); ?>
								</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>

				<div id="attributes" class="row mx-10">
					<script type="text/javascript">
						$('#attributes').load('<?php echo site_url("items/attributes/$item_info->item_id");?>');
					</script>
				</div>

				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('items_cost_price'), 'cost_price', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<div class="input-group input-group-sm w-full custom-form-group customized-error-input">
									<?php if (!currency_side()): ?>
										<span class="input-group-addon input-sm theme-bg-color mix-input-icon-left-tag mix-input-icon-width"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
									<?php endif; ?>
									<?php echo form_input(array(
											'name'=>'cost_price',
											'id'=>'cost_price',
											'class'=>'form-control input-sm custom-input custom-input-width-with-error',
											'onClick'=>'this.select();',
											'value'=>to_currency_no_money($item_info->cost_price))
				
											);?>
									<?php if (currency_side()): ?>
										<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
			
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('items_unit_price'), 'unit_price', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<div class="input-group input-group-sm w-full custom-form-group customized-error-input">
									<?php if (!currency_side()): ?>
										<span class="input-group-addon input-sm theme-bg-color mix-input-icon-left-tag mix-input-icon-width"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
									<?php endif; ?>
									<?php echo form_input(array(
											'name'=>'unit_price',
											'id'=>'unit_price',
											'class'=>'form-control input-sm custom-input custom-input-width-with-error',
											'onClick'=>'this.select();',
											'value'=>to_currency_no_money($item_info->unit_price))
											//'value'=>to_currency_no_money($batch->unit_price))
											);?>
									<?php if (currency_side()): ?>
										<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
									<?php endif; ?>
								</div>
						</div>
					</div>
				</div>

				<div class="row mx-10">
					<?php
					foreach($stock_locations as $key=>$location_detail)
					{
					?>
						<div class="col-xs-2 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('items_quantity').' '.$location_detail['location_name'], 'quantity_' . $key, array('class'=>'control-label')); ?><span class="required-red">*</span>
								<?php echo form_input(array(
									'name'=>'quantity_' . $key,
									'id'=>'quantity_' . $key,
									'class'=>'required quantity form-control custom-input-with-border',
									'onClick'=>'this.select();',
									'value'=>isset($item_info->item_id) ? to_quantity_decimals($location_detail['quantity']) : to_quantity_decimals(0))
								);?>
							</div>
						</div>
					<?php
					}
					?>
					<?php
					if(!$use_destination_based_tax)
					{
					?>
						<div class="form-group form-group-sm col-xs-2 padding-20">
							<?php echo form_label($this->lang->line('items_tax_1'), 'tax_percent_1', array('class'=>'control-label')); ?> (<?php echo isset($item_tax_info[0]['name']) ? $item_tax_info[0]['name'] : $this->config->item('default_tax_1_name'); ?>)
								<div class="input-group input-group-sm w-full tax-input-width">
									<?php echo form_input(array(
											'name'=>'tax_percents[]',
											'id'=>'tax_percent_name_1',
											'class'=>'form-control input-sm custom-input-without-right-border',
											'value'=>isset($item_tax_info[0]['percent']) ? to_tax_decimals($item_tax_info[0]['percent']) : to_tax_decimals($default_tax_1_rate))
											);?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-right-tag mix-input-icon-width"><b>%</b></span>
								</div>
						</div>
			
						<div class="form-group form-group-sm col-xs-2 padding-20">
							<?php echo form_label($this->lang->line('items_tax_2'), 'tax_percent_2', array('class'=>'control-label')); ?>(<?php echo isset($item_tax_info[1]['name']) ? $item_tax_info[1]['name'] : $this->config->item('default_tax_2_name') ?>)
								<div class="input-group input-group-sm w-full tax-input-width">
									<?php echo form_input(array(
											'name'=>'tax_percents[]',
											'class'=>'form-control input-sm custom-input-without-right-border',
											'id'=>'tax_percent_name_2',
											'value'=>isset($item_tax_info[1]['percent']) ? to_tax_decimals($item_tax_info[1]['percent']) : to_tax_decimals($default_tax_2_rate))
											);?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-right-tag mix-input-icon-width"><b>%</b></span>
								</div>
						</div>
					<?php
					}
					?>
				</div>

				<div class="row mx-10">
					<?php if($use_destination_based_tax): ?>
						<div class="col-xs-4 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('taxes_tax_category'), 'tax_category', array('class'=>'control-label')); ?>
								<div class="input-group input-group-sm">
									<?php echo form_input(array(
											'name'=>'tax_category',
											'id'=>'tax_category',
											'class'=>'form-control input-sm custom-input-with-border',
											'size'=>'50',
											'value'=>$tax_category)
									); ?>
									<?php echo form_hidden('tax_category_id', $tax_category_id); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
			
					<?php if($include_hsn): ?>
						<div class="col-xs-4 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('items_hsn_code'), 'category', array('class'=>'control-label col-xs-3')); ?>
								<div class="input-group">
									<?php echo form_input(array(
											'name'=>'hsn_code',
											'id'=>'hsn_code',
											'class'=>'form-control input-sm custom-input-with-border',
											'value'=>$hsn_code)
									);?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="row mx-10">
						<div class="col-xs-2 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('items_receiving_quantity'), 'receiving_quantity', array('class'=>'control-label')); ?><span class="required-red">*</span>
								<?php echo form_input(array(
									'name'=>'receiving_quantity',
									'id'=>'receiving_quantity',
									'class'=>'required form-control input-sm custom-input-with-border',
									'onClick'=>'this.select();',
									'value'=>isset($item_info->item_id) ? to_quantity_decimals($item_info->receiving_quantity) : to_quantity_decimals(0))
								);?>
							</div>
						</div>
				
						<div class="col-xs-2 padding-20">
							<div class="form-group form-group-sm">
								<?php echo form_label($this->lang->line('items_reorder_level'), 'reorder_level', array('class'=>'control-label')); ?><span class="required-red">*</span>
								<?php echo form_input(array(
									'name'=>'reorder_level',
									'id'=>'reorder_level',
									'class'=>'form-control input-sm custom-input-with-border',
									'onClick'=>'this.select();',
									'value'=>isset($item_info->item_id) ? to_quantity_decimals($item_info->reorder_level) : to_quantity_decimals(0))
									);?>
							</div>
						</div>

						<div class="d-flex padding-20">
							<div>
								<div class="form-group form-group-sm m-b-0">
									<?php echo form_checkbox(array(
										'name'=>'allow_alt_description',
										'id'=>'allow_alt_description',
										'value'=>1,
										'checked'=>($item_info->allow_alt_description) ? 1 : 0)
									);?>
									<?php echo form_label($this->lang->line('items_allow_alt_description'), 'allow_alt_description', array('class'=>'control-label')); ?>
								</div>
							</div>
					
							<div>
								<div class="form-group form-group-sm m-b-0">
									<?php echo form_checkbox(array(
										'name'=>'is_serialized',
										'id'=>'is_serialized',
										'value'=>1,
										'checked'=>($item_info->is_serialized) ? 1 : 0)
									);?>
									<?php echo form_label($this->lang->line('items_is_serialized'), 'is_serialized', array('class'=>'control-label')); ?>
								</div>
							</div>
					
							<?php
							if($this->config->item('multi_pack_enabled') == '1')
							{
								?>
								<div class="col-xs-4">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('items_qty_per_pack'), 'qty_per_pack', array('class'=>'control-label')); ?>
										<?php echo form_input(array(
												'name'=>'qty_per_pack',
												'id'=>'qty_per_pack',
												'class'=>'form-control input-sm custom-input-with-border',
												'value'=>isset($item_info->item_id) ? to_quantity_decimals($item_info->qty_per_pack) : to_quantity_decimals(0))
										);?>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('items_pack_name'), 'name', array('class'=>'control-label')); ?>
										<?php echo form_input(array(
											'name'=>'pack_name',
											'id'=>'pack_name',
											'class'=>'form-control input-sm custom-input-with-border',
											'value'=>$item_info->pack_name)
										);?>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="form-group form-group-sm">
										<?php echo form_label($this->lang->line('items_low_sell_item'), 'low_sell_item_name', array('class'=>'control-label')); ?>
										<div class="input-group input-group-sm">
											<?php echo form_input(array(
													'name'=>'low_sell_item_name',
													'id'=>'low_sell_item_name',
													'class'=>'form-control input-sm custom-input-with-border',
													'value'=>$selected_low_sell_item)
											); ?>
											<?php echo form_hidden('low_sell_item_id', $selected_low_sell_item_id);?>
										</div>
									</div>
								</div>
								<?php
							}
							?>
					
							<div>
								<div class="form-group form-group-sm m-b-0">
									<?php echo form_checkbox(array(
										'name'=>'is_deleted',
										'id'=>'is_deleted',
										'value'=>1,
										'checked'=>($item_info->deleted) ? 1 : 0)
									);?>
									<?php echo form_label($this->lang->line('items_is_deleted'), 'is_deleted', array('class'=>'control-label')); ?>
								</div>
							</div>
						</div>
				</div>

				<div class="row mx-10">
					<div class="col-xs-8 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('items_description'), 'description', array('class'=>'control-label')); ?>
							<?php echo form_textarea(array(
								'name'=>'description',
								'id'=>'description',
								'placeholder' => $this->lang->line('items_description'),
								'rows'=>'4',
								'class'=>'form-control input-sm resize-none custom-input-with-border',
								'value'=>$item_info->description)
								);?>
						</div>
					</div>
					<div class="col-xs-4 padding-20 avatar-container">
						<div class="form-group form-group-sm">
							<div class="fileinput <?php echo $logo_exists ? 'fileinput-exists' : 'fileinput-new'; ?>" data-provides="fileinput">
								<div class="fileinput-preview fileinput-exists thumbnail file-upload-thumbnail">
										<img data-src="holder.js/100%x100%" alt="<?php echo $this->lang->line('items_image'); ?>" 
											src="<?php echo $image_path; ?>" width="300px" />
								</div>
								<?php 
									echo isset($image_path) 
										? null 
										: '<div id="default-image">
											<img src="https://rahulindesign.websites.co.in/twenty-nineteen/img/defaults/product-default.png" 
											alt="default image" width="300px">
										</div>';
									?>
								<div class="file-upload-controls">
									<span class="btn btn-primary btn-file theme-bg-color">
										<span class="fileinput-new theme-bg-color">Select Image / Avatar</span>
										<span class="fileinput-exists theme-bg-color"><?php echo $this->lang->line("items_change_image"); ?></span>
										<input type="file" name="item_image" accept="image/*" onchange={imageChangeHandler()}>
									</span>
									<a href="#" class="btn fileinput-exists theme-bg-color" data-dismiss="fileinput" onclick={deleteImage()}>
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</div>
							</div>
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

<?php $this->load->view("partial/footer"); ?>

<script type="text/javascript">

function submitHandler(){
	$('#item_form').submit();
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
	
	$("input[name='tax_category']").change(function() {
		!$(this).val() && $(this).val('');
	});

	var fill_value = function(event, ui) {
		event.preventDefault();
		$("input[name='tax_category_id']").val(ui.item.value);
		$("input[name='tax_category']").val(ui.item.label);
	};

	$('#tax_category').autocomplete({
		source: "<?php echo site_url('taxes/suggest_tax_categories'); ?>",
		minChars: 0,
		delay: 15,
		cacheLength: 1,
		appendTo: '.modal-content',
		select: fill_value,
		focus: fill_value
	});

	var fill_value = function(event, ui) {
		event.preventDefault();
		$("input[name='low_sell_item_id']").val(ui.item.value);
		$("input[name='low_sell_item_name']").val(ui.item.label);
	};

	$('#low_sell_item_name').autocomplete({
		source: "<?php echo site_url('items/suggest_low_sell'); ?>",
		minChars: 0,
		delay: 15,
		cacheLength: 1,
		appendTo: '.modal-content',
		select: fill_value,
		focus: fill_value
	});

	$('#category').autocomplete({
		source: "<?php echo site_url('items/suggest_category');?>",
		delay: 10,
		appendTo: '.modal-content'
	});

	$('a.fileinput-exists').click(function() {
		$.ajax({
			type: 'GET',
			url: '<?php echo site_url("$controller_name/remove_logo/$item_info->item_id"); ?>',
			dataType: 'json'
		})
	});

	$.validator.addMethod('valid_chars', function(value, element) {
		return value.match(/(\||_)/g) == null;
	}, "<?php echo $this->lang->line('attributes_attribute_value_invalid_chars'); ?>");

	var init_validation = function() {
		$('#item_form').validate($.extend({
			submitHandler: function(form, event) {
				$(form).ajaxSubmit({
					success: function(response) {
						// set action of item_form to url without item id, so a new one can be created
						$('#item_form').attr('action', "<?php echo site_url('items/save/')?>");
						// use a whitelist of fields to minimize unintended side effects
						$(':text, :password, :file, #description, #item_form').not('.quantity, #reorder_level, #tax_name_1, #receiving_quantity, ' +
							'#tax_percent_name_1, #category, #reference_number, #name, #batch_number, #cost_price, #unit_price, #taxed_cost_price, #taxed_unit_price, #definition_name, [name^="attribute_links"]').val('');
						// de-select any checkboxes, radios and drop-down menus
						$(':input', '#item_form').removeAttr('checked').removeAttr('selected');
						customToaster();
						if(response){
							// window.location.href = '<?php echo site_url($controller_name); ?>';
						}
						// init_validation();
					},
					dataType: 'json'
				});
			},

			rules:
			{
				name: 'required',
				batch_number: 'required',
				category: 'required',
				receiving_quantity: 'required',
				item_number:
				{
					required: false,
					remote:
					{
						url: "<?php echo site_url($controller_name . '/check_item_number')?>",
						type: 'POST',
						data: {
							'item_id' : "<?php echo $item_info->item_id; ?>",
							'item_number' : function()
							{
								return $('#item_number').val();
							},
						}
					}
				},
				cost_price:
				{
					required: true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				},
				unit_price:
				{
					required: true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				},
				<?php
				foreach($stock_locations as $key=>$location_detail)
				{
				?>
				<?php echo 'quantity_' . $key ?>:
					{
						required: true,
						remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
					},
				<?php
				}
				?>
				reorder_level:
				{
					required: true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				},
				tax_percent:
				{
					required: true,
					remote: "<?php echo site_url($controller_name . '/check_numeric')?>"
				}
			},

			messages:
			{
				name: "<?php echo $this->lang->line('items_name_required'); ?>",
				item_number: "<?php echo $this->lang->line('items_item_number_duplicate'); ?>",
				category: "<?php echo $this->lang->line('items_category_required'); ?>",
				batch_number: "<?php echo $this->lang->line('items_batch_number_required'); ?>",
				cost_price:
				{
					required: "<?php echo $this->lang->line('items_cost_price_required'); ?>",
					number: "<?php echo $this->lang->line('items_cost_price_number'); ?>"
				},
				unit_price:
				{
					required: "<?php echo $this->lang->line('items_unit_price_required'); ?>",
					number: "<?php echo $this->lang->line('items_unit_price_number'); ?>"
				},
				<?php
				foreach($stock_locations as $key=>$location_detail)
				{
				?>
				<?php echo 'quantity_' . $key ?>:
					{
						required: "<?php echo $this->lang->line('items_quantity_required'); ?>",
						number: "<?php echo $this->lang->line('items_quantity_number'); ?>"
					},
				<?php
				}
				?>
				receiving_quantity:
				{
					required: "<?php echo $this->lang->line('items_quantity_required'); ?>",
					number: "<?php echo $this->lang->line('items_quantity_number'); ?>"
				},
				reorder_level: {
					required: "<?php echo $this->lang->line('items_reorder_level_required'); ?>",
					number: "<?php echo $this->lang->line('items_reorder_level_number'); ?>"
				},
				tax_percent:
				{
					required: "<?php echo $this->lang->line('items_tax_percent_required'); ?>",
					number: "<?php echo $this->lang->line('items_tax_percent_number'); ?>"
				}
			}
		}, form_support.error));
	};

	init_validation();
});

function imageChangeHandler(){
	document.getElementById("default-image").style.display = "none";
}
function deleteImage(){
	document.getElementById("default-image").style.display = "block";
}
</script>