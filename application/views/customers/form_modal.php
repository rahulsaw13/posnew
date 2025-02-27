<link rel="stylesheet" type="text/css" href="css/common_modal.css" />
<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open($controller_name . '/save/' . $person_info->person_id, array('id'=>'customer_form', 'class'=>'form-horizontal')); ?>
	<ul class="nav nav-tabs nav-justified" data-tabs="tabs">
		<li class="active" role="presentation">
			<a data-toggle="tab" href="#customer_basic_info" class="customer-info-heading"><?php echo $this->lang->line("customers_basic_information"); ?></a>
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
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="customer_basic_info">
			<fieldset>
				<div class="form-group form-group-sm m-0">
					<?php echo form_label($this->lang->line('customers_consent'), 'consent', array('class' => 'required control-label col-xs-3 text-left')); ?>
					<div class='col-xs-1'>
						<?php echo form_checkbox('consent', '1', $person_info->consent == '' ? (boolean)!$this->config->item('enforce_privacy') : (boolean)$person_info->consent); ?>
					</div>
				</div>

				<?php $this->load->view("people/form_basic_info_modal"); ?>

				<!-- Customer Category (Dropdown) -->
				<div class="form-group form-group-sm m-0">
					<?php echo form_label('Customers Category', 'customer_category', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class="col-xs-8">
						<?php
						// Ensure $category_options is set
						if (isset($category_options) && !empty($category_options)) {
							// Render the dropdown with customer category options
							echo form_dropdown('customer_category', $category_options, set_value('customer_category', $person_info->customer_category), 'class="form-control input-sm"');
						} else {
							echo '<p>No categories available.</p>';
						}
						?>
					</div>
				</div>

				<!-- Referred By Field (Dropdown from ospos_referral table) -->
				<div class="form-group form-group-sm mx-0">
					<?php echo form_label('Customers Referred By', 'referred_by', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class="col-xs-8">
						<?php
						// Ensure that $referral_options is passed from the controller
						if (isset($referral_options) && !empty($referral_options)) {
							echo form_dropdown('referred_by', $referral_options, set_value('referred_by', $person_info->referred_by), 'class="form-control input-sm"');
						} else {
							echo '<p>No referrals available.</p>';
						}
						?>
					</div>
				</div>

				<!-- Location (Google map link ) field -->
				<div class="form-group form-group-sm mx-0">
					<?php echo form_label('Customers Location Link', 'location', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class="col-xs-8" style="display: flex; align-items: center;">
						<?php echo form_input(array(
							'name' => 'location',
							'id' => 'location',
							'class' => 'form-control input-sm',
							'placeholder' => 'Enter Google Maps link',
							'value' => $person_info->location
						)); ?>
						
						<!-- Google Maps Link Button (with circled "i") -->
						<a href="javascript:void(0);" id="location-info" class="btn btn-info btn-sm" style="border-radius: 50%; padding: 5px 10px;text-decoration: none; color: #3498db; background-color: #ffffff; border-color:#ffffff" title="View Location">
							<i class="fa fa-info-circle"></i> <!-- FontAwesome Info Circle -->
						</a>
					</div>
				</div>

				<!-- Location Image (File Upload) -->
				<div class="form-group form-group-sm mx-0">
					<?php echo form_label('Customers Location Image', 'location_image', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class="col-xs-8">
						<div class="fileinput <?php echo $person_info->location_image ? 'fileinput-exists' : 'fileinput-new'; ?>" data-provides="fileinput">
							<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;"></div>
							<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;">
								<?php if ($person_info->location_image): ?>
									<img id="location_image_preview" src="<?php echo base_url('uploads/customer_loc_pics/' . $person_info->location_image); ?>" alt="Location Image" style="max-width: 100%; max-height: 100%;">
								<?php else: ?>
									<p>No image uploaded</p>
								<?php endif; ?>
							</div>
							<div>
								<span class="btn btn-default btn-sm btn-file">
									<span class="fileinput-new"><?php echo $this->lang->line('items_select_image');?></span>
									<span class="fileinput-exists"><?php echo $this->lang->line("items_change_image"); ?></span>
									<input type="file" name="location_image" class="cursor-pointer" accept="image/*" id="location_image_input">
								</span>
								<!-- Show the "Remove Image" button only if there is an image -->
								<?php if ($person_info->location_image): ?>
									<a href="#" id="delete_location_image" class="btn btn-danger btn-sm fileinput-exists" onclick="clearLocationImage(); return false;"><?php echo $this->lang->line("items_remove_image"); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<!-- Hidden input field to track image removal -->
				<input type="hidden" id="remove_location_image" name="remove_location_image" value="0" />
				
				<div class="form-group form-group-sm mx-0">
					<?php echo form_label($this->lang->line('customers_discount_type'), 'discount_type', array('class'=>'control-label col-xs-3 text-left')); ?>
					<div class="col-xs-8">
						<label class="radio-inline">
							<?php echo form_radio(array(
									'name'=>'discount_type',
									'type'=>'radio',
									'id'=>'discount_type',
									'value'=>0,
									'checked'=>$person_info->discount_type == PERCENT)
							); ?> <?php echo $this->lang->line('customers_discount_percent'); ?>
						</label>
						<label class="radio-inline">
							<?php echo form_radio(array(
									'name'=>'discount_type',
									'type'=>'radio',
									'id'=>'discount_type',
									'value'=>1,
									'checked'=>$person_info->discount_type == FIXED)
							); ?> <?php echo $this->lang->line('customers_discount_fixed'); ?>
						</label>
					</div>
				</div>

				<div class="form-group form-group-sm mx-0">
					<?php echo form_label($this->lang->line('customers_discount'), 'discount', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class='col-xs-3 text-left'>
						<div class="input-group input-group-sm">
							<?php echo form_input(array(
									'name'=>'discount',
									'id'=>'discount',
									'class'=>'form-control input-sm',
									'onClick'=>'this.select();',
									'value'=>$person_info->discount)
									); ?>
						</div>
					</div>	
				</div>

				<div class="form-group form-group-sm mx-0">
					<?php echo form_label($this->lang->line('customers_company_name'), 'company_name', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class='col-xs-8'>
						<?php echo form_input(array(
								'name'=>'company_name',
								'id'=>'company_name',
								'class'=>'form-control input-sm',
								'value'=>$person_info->company_name)
								); ?>
					</div>
				</div>

				<div class="form-group form-group-sm mx-0">
					<?php echo form_label($this->lang->line('customers_account_number'), 'account_number', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class='col-xs-4'>
						<?php echo form_input(array(
								'name'=>'account_number',
								'id'=>'account_number',
								'class'=>'form-control input-sm',
								'value'=>$person_info->account_number)
								); ?>
					</div>
				</div>

				<div class="form-group form-group-sm mx-0">
					<?php echo form_label($this->lang->line('customers_tax_id'), 'tax_id', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class='col-xs-4'>
						<?php echo form_input(array(
								'name'=>'tax_id',
								'id'=>'tax_id',
								'class'=>'form-control input-sm',
								'value'=>$person_info->tax_id)
						); ?>
					</div>
				</div>

				<?php if($this->config->item('customer_reward_enable') == TRUE): ?>
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('rewards_package'), 'rewards', array('class'=>'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-8'>
							<?php echo form_dropdown('package_id', $packages, $selected_package, array('class'=>'form-control')); ?>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_available_points'), 'available_points', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
									'name'=>'available_points',
									'id'=>'available_points',
									'class'=>'form-control input-sm',
									'value'=>$person_info->points,
									'disabled'=>'')
									); ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="form-group form-group-sm mx-0">
					<?php echo form_label($this->lang->line('customers_taxable'), 'taxable', array('class' => 'control-label col-xs-3 text-left')); ?>
					<div class='col-xs-1'>
						<?php echo form_checkbox('taxable', '1', $person_info->taxable == '' ? TRUE : (boolean)$person_info->taxable); ?>
					</div>
				</div>

				<?php
				if($use_destination_based_tax)
				{
				?>
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_tax_code'), 'sales_tax_code_name', array('class'=>'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-8'>
							<div class="input-group input-group-sm">
								<?php echo form_input(array(
										'name'=>'sales_tax_code_name',
										'id'=>'sales_tax_code_name',
										'class'=>'form-control input-sm',
										'size'=>'50',
										'value'=>$sales_tax_code_label)
								); ?>
								<?php echo form_hidden('sales_tax_code_id', $person_info->sales_tax_code_id); ?>
							</div>
						</div>
					</div>
				<?php
				}
				?>

				<div class="form-group form-group-sm mx-0">
					<?php echo form_label($this->lang->line('customers_date'), 'date', array('class'=>'control-label col-xs-3 text-left')); ?>
					<div class='col-xs-8'>
						<div class="input-group">
							<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-calendar"></span></span>
							<?php echo form_input(array(
									'name'=>'date',
									'id'=>'datetime',
									'class'=>'form-control input-sm',
									'value'=>to_datetime(strtotime($person_info->date)),
									'readonly'=>'true')
									); ?>
						</div>
					</div>
				</div>

				<div class="form-group form-group-sm mx-0">
					<?php echo form_label($this->lang->line('customers_employee'), 'employee', array('class'=>'control-label col-xs-3 text-left')); ?>
					<div class='col-xs-8'>
						<?php echo form_input(array(
								'name'=>'employee',
								'id'=>'employee',
								'class'=>'form-control input-sm',
								'value'=>$employee,
								'readonly'=>'true')
								); ?>
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
				<fieldset>
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_total'), 'total', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'total',
										'id'=>'total',
										'class'=>'form-control input-sm',
										'value'=>to_currency_no_money($stats->total),
										'disabled'=>'')
										); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_max'), 'max', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'max',
										'id'=>'max',
										'class'=>'form-control input-sm',
										'value'=>to_currency_no_money($stats->max),
										'disabled'=>'')
										); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_min'), 'min', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'min',
										'id'=>'min',
										'class'=>'form-control input-sm',
										'value'=>to_currency_no_money($stats->min),
										'disabled'=>'')
										); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_average'), 'average', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
								<?php echo form_input(array(
										'name'=>'average',
										'id'=>'average',
										'class'=>'form-control input-sm',
										'value'=>to_currency_no_money($stats->average),
										'disabled'=>'')
										); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_quantity'), 'quantity', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php echo form_input(array(
										'name'=>'quantity',
										'id'=>'quantity',
										'class'=>'form-control input-sm',
										'value'=>$stats->quantity,
										'disabled'=>'')
										); ?>
							</div>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_avg_discount'), 'avg_discount', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class="col-xs-3 text-left">
							<div class="input-group input-group-sm">
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

					<!-- Adding credit note field to display -->
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('sales_credit_note'), 'credit_note', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class="col-xs-3 text-left">
							<div class="input-group input-group-sm">
							<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php echo form_input(array(
										'name' => 'credit_note',
										'id' => 'credit_note',
										'class' => 'form-control input-sm',
										'value' => to_currency_no_money($stats->credit_note),
										'disabled' => ''
								)); ?>
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
				<fieldset>
					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_status'), 'mailchimp_status', array('class' => 'control-label col-xs-3 text-left')); ?>
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

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_vip'), 'mailchimp_vip', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-1'>
							<?php echo form_checkbox('mailchimp_vip', '1', $mailchimp_info['vip'] == '' ? FALSE : (boolean)$mailchimp_info['vip']); ?>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_member_rating'), 'mailchimp_member_rating', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
									'name'=>'mailchimp_member_rating',
									'class'=>'form-control input-sm',
									'value'=>$mailchimp_info['member_rating'],
									'disabled'=>'')
									); ?>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_activity_total'), 'mailchimp_activity_total', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
									'name'=>'mailchimp_activity_total',
									'class'=>'form-control input-sm',
									'value'=>$mailchimp_activity['total'],
									'disabled'=>'')
									); ?>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_activity_lastopen'), 'mailchimp_activity_lastopen', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
									'name'=>'mailchimp_activity_lastopen',
									'class'=>'form-control input-sm',
									'value'=>$mailchimp_activity['lastopen'],
									'disabled'=>'')
									); ?>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_activity_open'), 'mailchimp_activity_open', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
									'name'=>'mailchimp_activity_open',
									'class'=>'form-control input-sm',
									'value'=>$mailchimp_activity['open'],
									'disabled'=>'')
									); ?>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_activity_click'), 'mailchimp_activity_click', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
									'name'=>'mailchimp_activity_click',
									'class'=>'form-control input-sm',
									'value'=>$mailchimp_activity['click'],
									'disabled'=>'')
									); ?>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_activity_unopen'), 'mailchimp_activity_unopen', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
									'name'=>'mailchimp_activity_unopen',
									'class'=>'form-control input-sm',
									'value'=>$mailchimp_activity['unopen'],
									'disabled'=>'')
									); ?>
						</div>
					</div>

					<div class="form-group form-group-sm mx-0">
						<?php echo form_label($this->lang->line('customers_mailchimp_email_client'), 'mailchimp_email_client', array('class' => 'control-label col-xs-3 text-left')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
									'name'=>'mailchimp_email_client',
									'class'=>'form-control input-sm',
									'value'=>$mailchimp_info['email_client'],
									'disabled'=>'')
									); ?>
						</div>
					</div>
				</fieldset>
			</div>
		<?php
		}
		?>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
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
             // If everything is valid, submit the form via Ajax
			 $(form).ajaxSubmit({
                success: function(response) {
                    dialog_support.hide();
                    table_support.handle_submit("<?php echo site_url($controller_name); ?>", response);
                },
                dataType: 'json'
            });
        },

        errorLabelContainer: '#error_message_box',

        rules: {
            first_name: 'required',
            last_name: 'required',
            consent: 'required',
            email: {
                remote: {
                    url: "<?php echo site_url($controller_name . '/ajax_check_email') ?>",
                    type: 'POST',
                    data: {
                        'person_id': "<?php echo $person_info->person_id; ?>"
                    }
                }
            },
            account_number: {
                remote: {
                    url: "<?php echo site_url($controller_name . '/ajax_check_account_number') ?>",
                    type: 'POST',
                    data: {
                        'person_id': "<?php echo $person_info->person_id; ?>"
                    }
                }
            }
        },

        messages: {
            first_name: "<?php echo $this->lang->line('common_first_name_required'); ?>",
            last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
            consent: "<?php echo $this->lang->line('customers_consent_required'); ?>",
            email: "<?php echo $this->lang->line('customers_email_duplicate'); ?>",
            account_number: "<?php echo $this->lang->line('customers_account_number_duplicate'); ?>"
        }
    }, form_support.error));
});

function clearLocationImage() {
    var image_name = $('#location_image_preview').attr('src').split('/').pop();  // Assuming image name is in the src URL

    // Clear the image preview
    $('#location_image_preview').attr('src', '');  // Remove the current image preview
	$('#location_image_preview').hide();
    $('#location_image_preview').html('Image Removed!');  // Show "No image uploaded" text

    // Hide the "Remove Image" button
    $('#delete_location_image').hide();

    // Reset the file input field
    $('input[name="location_image"]').val('');  // Clear the file input value

    // Set the remove flag so it will be passed in the form
    $('#remove_location_image').val('1');  // Mark the form field so it won't submit the previous image
}


document.getElementById("location-info").addEventListener("click", function() {
    var locationLink = document.getElementById("location").value.trim();

    if (locationLink) {
        // Check if the link contains either 'https://www.google.com/maps' or 'https://maps.app.goo.gl/'
        if (locationLink.includes("https://www.google.com/maps") || locationLink.includes("https://maps.app.goo.gl/")) {
            window.open(locationLink, "_blank"); // Open the Google Maps link in a new tab
        } else {
            alert("Please enter a valid Google Maps link.");
        }
    } else {
        alert("Please enter a Google Maps link first.");
    }
});
</script>
