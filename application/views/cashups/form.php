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
<link rel="stylesheet" type="text/css" href="css/cashups.css" />

<div id="custom-toaster" class="toaster">Cashup has been <?php echo $toaster_text; ?>.</div>

<?php echo form_open('cashups/save/'.$cash_ups_info->cashup_id, array('id'=>'cashups_edit_form', 'class'=>'form-horizontal')); ?>
	<fieldset id="item_basic_info" class="row m-0 p-0">
		<div class="new-form-design-background">
			<div class="form-header"><?php echo $text; ?> CASHUP</div>
			<div class="new-form-design-container">
				<div class="design-header">
					<span class="glyphicon glyphicon-cog"></span><span class="design-header-text">General Details</span>
				</div>
				<hr class="mb-0 mt-10">
				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_info'), 'cash_ups_info', array('class'=>'control-label')); ?>
							<?php echo form_label(!empty($cash_ups_info->cashup_id) ? $this->lang->line('cashups_id') . ' ' . $cash_ups_info->cashup_id : '', 'cashup_id', array('class'=>'control-label', 'style'=>'text-align:left')); ?>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_open_date'), 'open_date', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<div class="input-group w-full custom-form-group">
								<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-calendar"></span></span>
								<?php echo form_input(array(
										'name'=>'open_date',
										'id'=>'open_date',
										'class'=>'form-control input-sm datepicker custom-input custom-input-width-with-error',
										'value'=>to_datetime(strtotime($cash_ups_info->open_date)))
										);?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_open_employee'), 'open_employee', array('class'=>'control-label')); ?>
							<?php echo form_dropdown('open_employee_id', $employees, $cash_ups_info->open_employee_id, 'id="open_employee_id" class="form-control cursor-pointer custom-input-with-border"');?>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_open_amount_cash'), 'open_amount_cash', array('class'=>'control-label')); ?>
							<div class="input-group input-group-sm w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'open_amount_cash',
										'id'=>'open_amount_cash',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($cash_ups_info->open_amount_cash))
										);?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_transfer_amount_cash'), 'transfer_amount_cash', array('class'=>'control-label')); ?>
							<div class="input-group input-group-sm w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'transfer_amount_cash',
										'id'=>'transfer_amount_cash',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($cash_ups_info->transfer_amount_cash))
										);?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_close_date'), 'close_date', array('class'=>'control-label')); ?><span class="required-red">*</span>
							<div class="input-group  w-full custom-form-group">
								<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><span class="glyphicon glyphicon-calendar"></span></span>
								<?php echo form_input(array(
										'name'=>'close_date',
										'id'=>'close_date',
										'class'=>'form-control input-sm datepicker custom-input custom-input-width-with-error',
										'value'=>to_datetime(strtotime($cash_ups_info->close_date)))
										);?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_close_employee'), 'close_employee', array('class'=>'control-label')); ?>
							<?php echo form_dropdown('close_employee_id', $employees, $cash_ups_info->close_employee_id, 'id="close_employee_id" class="form-control cursor-pointer custom-input-with-border"');?>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_closed_amount_cash'), 'closed_amount_cash', array('class'=>'control-label')); ?>
							<div class="input-group input-group-sm w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'closed_amount_cash',
										'id'=>'closed_amount_cash',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($cash_ups_info->closed_amount_cash))
										);?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20 display-flex gap-50">
						<div class="form-group form-group-sm mt-30">
							<?php echo form_checkbox(array(
								'name'=>'note',
								'id'=>'note',
								'value'=>0,
								'checked'=>($cash_ups_info->note) ? 1 : 0)
							);?>
							<?php echo form_label($this->lang->line('cashups_note'), 'note', array('class'=>'control-label')); ?>
						</div>
						<?php
							if(!empty($cash_ups_info->cashup_id))
							{
							?>
								<div class="form-group form-group-sm mt-30">
									<?php echo form_checkbox(array(
										'name'=>'deleted',
										'id'=>'deleted',
										'value'=>1,
										'checked'=>($cash_ups_info->deleted) ? 1 : 0)
									);?>
									<?php echo form_label($this->lang->line('cashups_is_deleted'), 'deleted', array('class'=>'control-label')); ?>
								</div>
							<?php
							}
						?>
					</div>
				</div>
				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_closed_amount_due'), 'closed_amount_due', array('class'=>'control-label')); ?>
							<div class="input-group input-group-sm w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'closed_amount_due',
										'id'=>'closed_amount_due',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($cash_ups_info->closed_amount_due))
										);?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_closed_amount_card'), 'closed_amount_card', array('class'=>'control-label')); ?>
							<div class="input-group input-group-sm w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'closed_amount_card',
										'id'=>'closed_amount_card',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($cash_ups_info->closed_amount_card))
										);?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row mx-10">
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_closed_amount_check'), 'closed_amount_check', array('class'=>'control-label')); ?>
							<div class="input-group input-group-sm w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'closed_amount_check',
										'id'=>'closed_amount_check',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($cash_ups_info->closed_amount_check))
										);?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_closed_amount_total'), 'closed_amount_total', array('class'=>'control-label')); ?>
							<div class="input-group input-group-sm w-full custom-form-group">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'closed_amount_total',
										'id'=>'closed_amount_total',
										'readonly'=>'true',
										'class'=>'form-control input-sm custom-input custom-input-width-with-error',
										'value'=>to_currency_no_money($cash_ups_info->closed_amount_total)
										));?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row mx-10">
					<div class="col-xs-8 padding-20">
						<div class="form-group form-group-sm">
							<?php echo form_label($this->lang->line('cashups_description'), 'description', array('class'=>'control-label')); ?>
							<?php echo form_textarea(array(
								'name'=>'description',
								'id'=>'description',
								'rows'=>'4',
								'class'=>'form-control input-sm resize-none custom-input-with-border',
								'value'=>$cash_ups_info->description)
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

<script type='text/javascript'>

function submitHandler(){
	$('#cashups_edit_form').submit();
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

	$('#open_date').datetimepicker({
		format: "<?php echo dateformat_bootstrap($this->config->item('dateformat')) . ' ' . dateformat_bootstrap($this->config->item('timeformat'));?>",
		startDate: "<?php echo date($this->config->item('dateformat') . ' ' . $this->config->item('timeformat'), mktime(0, 0, 0, 1, 1, 2010));?>",
		<?php
		$t = $this->config->item('timeformat');
		$m = $t[strlen($t)-1];
		if( strpos($this->config->item('timeformat'), 'a') !== false || strpos($this->config->item('timeformat'), 'A') !== false )
		{
		?>
			showMeridian: true,
		<?php
		}
		else
		{
		?>
			showMeridian: false,
		<?php
		}
		?>
		minuteStep: 1,
		autoclose: true,
		todayBtn: true,
		todayHighlight: true,
		bootcssVer: 3,
		language: '<?php echo current_language_code(); ?>'
	});

	$('#close_date').datetimepicker({
		format: "<?php echo dateformat_bootstrap($this->config->item('dateformat')) . ' ' . dateformat_bootstrap($this->config->item('timeformat'));?>",
		startDate: "<?php echo date($this->config->item('dateformat') . ' ' . $this->config->item('timeformat'), mktime(0, 0, 0, 1, 1, 2010));?>",
		<?php
		$t = $this->config->item('timeformat');
		$m = $t[strlen($t)-1];
		if( strpos($this->config->item('timeformat'), 'a') !== false || strpos($this->config->item('timeformat'), 'A') !== false )
		{
		?>
			showMeridian: true,
		<?php
		}
		else
		{
		?>
			showMeridian: false,
		<?php
		}
		?>
		minuteStep: 1,
		autoclose: true,
		todayBtn: true,
		todayHighlight: true,
		bootcssVer: 3,
		language: '<?php echo current_language_code(); ?>'
	});

	$('#open_amount_cash, #transfer_amount_cash, #closed_amount_cash, #closed_amount_due, #closed_amount_card, #closed_amount_check').keyup(function() {
		$.post("<?php echo site_url($controller_name . '/ajax_cashup_total')?>", {
				'open_amount_cash': $('#open_amount_cash').val(),
				'transfer_amount_cash': $('#transfer_amount_cash').val(),
				'closed_amount_due': $('#closed_amount_due').val(),
				'closed_amount_cash': $('#closed_amount_cash').val(),
				'closed_amount_card': $('#closed_amount_card').val(),
				'closed_amount_check': $('#closed_amount_check').val()
			},
			function(response) {
				$('#closed_amount_total').val(response.total);
			},
			'json'
		);
	});

	var submit_form = function()
	{
		$(this).ajaxSubmit(
		{
			success: function(response)
			{
				customToaster();
				if(response){
					window.location.href = '<?php echo site_url($controller_name); ?>';
				}
			},
			dataType: 'json'
		});
	};

	$('#cashups_edit_form').validate($.extend(
	{
		submitHandler: function(form)
		{
			submit_form.call(form);
		},
		rules:
		{

		},
		messages:
		{
			open_date:
			{
				required: '<?php echo $this->lang->line('cashups_date_required'); ?>'

			},
			close_date:
			{
				required: '<?php echo $this->lang->line('cashups_date_required'); ?>'

			},
			amount:
			{
				required: '<?php echo $this->lang->line('cashups_amount_required'); ?>',
				number: '<?php echo $this->lang->line('cashups_amount_number'); ?>'
			}
		}
	}, form_support.error));
});
</script>
