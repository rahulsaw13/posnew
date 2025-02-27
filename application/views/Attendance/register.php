<?php $this->load->view("partial/header"); ?>

<?php
if(isset($error))
{
	echo "<div class='alert alert-dismissible alert-danger'>".$error."</div>";
}

if(!empty($warning))
{
	echo "<div class='alert alert-dismissible alert-warning'>".$warning."</div>";
}

if(isset($success))
{
	echo "<div class='alert alert-dismissible alert-success'>".$success."</div>";
}
?>

<div id="attendance_wrapper">
    <!-- Date Selection Form -->
    <?php echo form_open($controller_name."/select_date", array('id'=>'date_form', 'class'=>'form-horizontal panel panel-default no-print')); ?>
        <div class="panel-body form-group">
            <ul>
                <li class="pull-left first_li">
                    <label class="control-label"><?php echo $this->lang->line('attendance_date'); ?></label>
                </li>
                <li class="pull-left">
                    <?php echo form_input(array(
                        'type' => 'date',
                        'name' => 'attendance_date',
                        'value' => $selected_date,
                        'class' => 'form-control input-sm',
                        'onchange' => "$('#date_form').submit();"
                    )); ?>
                </li>
            </ul>
        </div>
    <?php echo form_close(); ?>

    <!-- Print Header - Only shows when printing -->
    <div class="print-header">
        <h2>Attendance Report</h2>
        <p>Date: <?php echo date('Y-m-d', strtotime($selected_date)); ?></p>
    </div>

    <!-- Attendance Table -->
    <table class="attendance_table_100" id="register">
        <thead>
            <tr>
                <th style="width: 1%;"><?php echo $this->lang->line('common_id'); ?></th>
                <th style="width: 20%;"><?php echo $this->lang->line('common_employee_name'); ?></th>
                <th style="width: 20%;"><?php echo $this->lang->line('attendance_status'); ?></th>
                <th style="width: 20%;"><?php echo $this->lang->line('employees_daily_salary'); ?></th>
                <th style="width: 10%;"><?php echo $this->lang->line('advance_payment'); ?></th>
                <!-- <th style="width: 10%;"><?php echo $this->lang->line('attendance_payment_status'); ?></th> -->
                <th style="width: 25%;"><?php echo $this->lang->line('attendance_remarks'); ?></th>
                <th style="width: 5%;"></th>
            </tr>
        </thead>

        <tbody id="attendance_contents">
            <?php
            if(empty($employees))
            {
            ?>
                <tr>
                    <td colspan='5'>
                        <div class='alert alert-dismissible alert-info'><?php echo $this->lang->line('attendance_no_employees'); ?></div>
                    </td>
                </tr>
            <?php
            }
            else if ($selected_date)
            {
                foreach($employees as $employee)
                {
                    $attendance_status = isset($attendance_records[$employee->id]) ? $attendance_records[$employee->id]['status'] : '';
                    $attendance_payment_status = isset($attendance_records[$employee->id]) ? $attendance_records[$employee->id]['payment_status'] : '';
                    $attendance_remarks = isset($attendance_records[$employee->id]) ? $attendance_records[$employee->id]['remarks'] : '';
                    $advance_payment = isset($attendance_records[$employee->id]) ? $attendance_records[$employee->id]['advance_payment'] : '';
                    
					?>
                    <?php echo form_open($controller_name."/update_attendance/".$employee->id, array('class'=>'form-horizontal', 'id'=>'attendance_'.$employee->id)); ?>
                        
						<tr>
                            <!-- <td><?php echo $employee->id; ?></td> -->
                            <td>
                                <!-- <span class="employee-id-link" 
                                   onclick="getMonthlyReport(<?php echo $employee->id; ?>)"
                                   style="text-decoration: underline; color: #0066cc;">
                                    <?php echo $employee->id; ?>
                                </span> -->

                                <span class="employee-id-link" 
                                    onclick="showDateSelectionModal(<?php echo $employee->id; ?>)"
                                    style="text-decoration: underline; color: #0066cc;">
                                    <?php echo $employee->id; ?>
                                </span>

                            </td>
                            <td><?php echo $employee->full_name; ?></td>
                            <td>
                                <?php 
							    $disabled = ($attendance_status !== '') ? 'disabled' : ''; 
                                // For printing, show text instead of dropdown
                                echo '<span class="status-text">' . 
                                    ($attendance_status == '1' ? 'Present' : 
                                    ($attendance_status == '0' ? 'Absent' : '')) . 
                                    '</span>';
                                // Hidden dropdown for form functionality
                                echo '<span class="status-dropdown no-print">';
								
                                  echo form_dropdown('status', 
                                    array(
                                        '' => 'Select Status',
                                        '1' => 'Present',
                                        '0' => 'Absent',
                                    ), 
                                    $attendance_status,
                                    array('class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit',   'onchange' => 'this.form.submit()')
                                ); 
                                    echo '</span>';
								// Add a hidden input field to always submit the value of status
								echo form_hidden('status_value', $attendance_status); 
								?>
                            </td>
                            <td><?php echo $employee->employee_daily_salary; ?></td>
                            <td>
                                <!-- <?php echo form_input(array(
                                    'name' => 'advance_payment',
                                    'value' => $advance_payment,
                                    'class' => 'form-control input-sm form-control-auto-submit change_value',
                                    'type' => 'number',
                                    'step' => 'any', // Allows decimal values if needed,
                                )); ?> -->
                               <?php echo form_input(array('name' => 'advance_payment', 'class' => 'form-control input-sm', 'value' => to_currency_no_money($advance_payment), 'onClick' => 'this.select();'));
                               ?>
							
                            </td>
                            <!-- <td>
                                <?php 
							    //$disabled = ($attendance_payment_status !== '') ? 'disabled' : ''; 
                                // For printing, show text instead of dropdown
                                echo '<span class="status-text">' . 
                                    ($attendance_payment_status == '1' ? 'Paid' : 
                                    ($attendance_payment_status == '0' ? 'Unpaid' : '')) . 
                                    '</span>';
                                // Hidden dropdown for form functionality
                                echo '<span class="status-dropdown no-print">';
								
                                  echo form_dropdown('payment_status', 
                                    array(
                                        '' => 'Select Status',
                                        '1' => 'Paid',
                                        '0' => 'Unpaid',
                                    ), 
                                    $attendance_payment_status,
                                    array('class'=>'selectpicker show-menu-arrow', 'data-style'=>'btn-default btn-sm', 'data-width'=>'fit',   'onchange' => 'this.form.submit()')
                                ); 
                                    echo '</span>';
								// Add a hidden input field to always submit the value of status
								echo form_hidden('payment_status_value', $attendance_payment_status); 
								?>
                            </td> -->
                            <td>
                                <?php echo form_input(array(
                                    'name' => 'remarks',
                                    'value' => $attendance_remarks,
                                    'class' => 'form-control input-sm form-control-auto-submit change_value'
                                )); ?>
                            </td>
							<td class="no-print">
								<button type="button" class="btn btn-print btn-sm" onclick="printAttendanceToken('<?php echo $employee->full_name; ?>','<?php echo $attendance_status; ?>','<?php echo $employee->employee_daily_salary; ?>', '<?php echo $advance_payment; ?>','<?php echo $attendance_remarks; ?>')">
									<i class="glyphicon glyphicon-print"></i> Print
								</button>
							</td>
                            <!-- <td>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-save">&nbsp;</span>Save
                                </button>
                            </td> -->
                        </tr>
                    <?php echo form_close(); ?>
                <?php
                }
            }
			else
			{
				?>
				<tr>
				<td colspan='8'>
					<div class='alert alert-dismissible alert-info'><?php echo $this->lang->line('attendance_no_data'); ?></div>
				</td>
			</tr>
			<?php }
            ?>
			<tr class='btn no-print'>
				<th>
				<?php echo form_open($controller_name."/complete", array('id'=>'buttons_form')); ?>
					<div class='btn btn-sm btn-success pull-right' id='finish_sale_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo "save"; ?></div></th>
				<?php echo form_close(); ?>
				<th>
				<?php echo form_open($controller_name."/cancel", array('id'=>'buttons_form')); ?>
				<div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>
				<?php echo form_close(); ?>
				</th>
                           <th>
                    <div class='btn btn-sm btn-info pull-right' id='print_button'>
                        <span class="glyphicon glyphicon-print">&nbsp</span>Print
                    </div>
                </th>
			</tr>
        </tbody>
    </table>
    <!-- Add a modal for the monthly report -->
    <div id="monthlyReportModal" class="mb-2 modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 92mm;" role="document"> <!-- Changed from modal-lg to fixed width -->
        <div class="modal-content" style="border-radius: 0;"> <!-- Remove rounded corners for thermal style -->
            <div class="no-print modal-header" style="padding: 10px 15px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-size: 14px;">Monthly Report</h4>
            </div>
            <div class="modal-body thermal-report" id="monthlyReportContent" 
                 style="width: 80mm; margin: 0 auto; padding: 5mm; font-size: 12px;">
                <!-- Report content will be loaded here -->
            </div>
            <div class="no-print modal-footer" style="padding: 10px 15px;">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" onclick="printMonthlyReport()">Print Report</button>
            </div>
        </div>
    </div>
</div>
<div id="dateSelectionModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Date Range</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" id="report_start_date" class="form-control">
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" id="report_end_date" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="getMonthlyReport()">Generate Report</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	// Print button click handler
    $('#print_button').click(function() {
        window.print();
    });

$('#finish_sale_button').click(function() {
		$('#buttons_form').attr('action', "<?php echo site_url($controller_name.'/complete'); ?>");
		$('#buttons_form').submit();
	});
	

	$('#cancel_sale_button').click(function() {
		if(confirm("<?php echo $this->lang->line('confirm_cancel_attendances'); ?>"))
		{
			$('#buttons_form').attr('action', "<?php echo site_url($controller_name.'/cancel'); ?>");
			$('#buttons_form').submit();
		}
	});
    $('[name="advance_payment"],[name="remarks"]').change(function() {
			$(this).parents('tr').prevAll('form:first').submit()
		});
    

    // Success message fade out
    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
    }, 3000);
});
// function getMonthlyReport(employeeId) {
//     var selectedDate = document.querySelector('input[name="attendance_date"]').value;
//     var date = new Date(selectedDate);
//     $.ajax({
//         url: '<?php echo site_url($controller_name."/get_monthly_report"); ?>',
//         type: 'POST',
//         data: {
//             employee_id: employeeId,
//             month: date.getMonth() + 1,  // getMonth() returns 0-11, so add 1
//             year: date.getFullYear(),
//             selected_date: selectedDate 
//         },
//         success: function(response) {
//             $('#monthlyReportContent').html(response);
//             $('#monthlyReportModal').modal('show');
//         },
//         error: function() {
//             alert('Error fetching monthly report');
//         }
//     });
// }

var selectedEmployeeId = null;

function showDateSelectionModal(employeeId) {
    selectedEmployeeId = employeeId;
    
    // Get the current selected date from the attendance view
    var selectedDate = document.querySelector('input[name="attendance_date"]').value;
    var date = new Date(selectedDate);
    
    // Set default date range to current month
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    
    // Format dates for input fields (YYYY-MM-DD)
    document.getElementById('report_start_date').value = firstDay.toISOString().split('T')[0];
    document.getElementById('report_end_date').value = lastDay.toISOString().split('T')[0];
    
    // Show the date selection modal
    $('#dateSelectionModal').modal('show');
}

function getMonthlyReport() {
    var startDate = document.getElementById('report_start_date').value;
    var endDate = document.getElementById('report_end_date').value;
    
    // Validate dates
    if (!startDate || !endDate) {
        alert('Please select both start and end dates');
        return;
    }
    
    if (new Date(startDate) > new Date(endDate)) {
        alert('Start date cannot be after end date');
        return;
    }
    
    // Close the date selection modal
    $('#dateSelectionModal').modal('hide');
    
    // Make the AJAX request
    $.ajax({
        url: '<?php echo site_url($controller_name."/get_monthly_report"); ?>',
        type: 'POST',
        data: {
            employee_id: selectedEmployeeId,
            start_date: startDate,
            end_date: endDate,
            selected_date: document.querySelector('input[name="attendance_date"]').value
        },
        success: function(response) {
            $('#monthlyReportContent').html(response);
            $('#monthlyReportModal').modal('show');
        },
        error: function() {
            alert('Error fetching monthly report');
        }
    });
}

// Add event listeners for date validation
document.getElementById('report_start_date').addEventListener('change', function() {
    var endDate = document.getElementById('report_end_date');
    endDate.min = this.value;
});

document.getElementById('report_end_date').addEventListener('change', function() {
    var startDate = document.getElementById('report_start_date');
    startDate.max = this.value;
});

// Clean up when modals are closed
$('#dateSelectionModal').on('hidden.bs.modal', function () {
    if (!$('#monthlyReportModal').is(':visible')) {
        selectedEmployeeId = null;
    }
});

$('#monthlyReportModal').on('hidden.bs.modal', function () {
    selectedEmployeeId = null;
});
function printMonthlyReport() {
    var printContents = document.getElementById('monthlyReportContent').innerHTML;
    var originalContents = document.body.innerHTML;

    // document.body.innerHTML = `
    //     ${printContents}
    // `;

    window.print();
    // document.body.innerHTML = originalContents;
    
    // Rebind jQuery events after restoring content
    $(document).ready(function() {
        // [Previous document.ready functions]
    });
}
function printAttendanceToken(employeeName,attendance_status, daily_salary, advance_payment, remarks) {
    // Sanitize input to prevent XSS
    employeeName = employeeName.replace(/[<>&"']/g, function(match) {
        return {
            '<': '&lt;',
            '>': '&gt;',
            '&': '&amp;',
            '"': '&quot;',
            "'": '&#39;'
        }[match];
    });

    // Create print content
    let attendanceStatus = `${attendance_status ? "Present" : "Absent"}`;
    var printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Attendance Token</title>
            <style>
                @page { 
                   size: auto;  /* Auto size based on content */
                    margin: 0;
                    top: 0;
                }
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    width: 80mm;
                    height: 50mm;
                    margin: 0;
                    padding: 10mm;
                    box-sizing: border-box;
                    border: 1px solid black;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                }
                .header {
                    font-weight: bold;
                    font-size: 5mm;
                    margin-bottom: 3mm;
                }
                .details {
                    font-size: 4mm;
                }
                .status {
                    margin-top: 2mm;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class="header">Attendance Token</div>
            <div class="details">
                <div>Employee: ${employeeName}</div>
                <div>${new Date().toLocaleString()}</div>
                <div>Attendance: ${attendanceStatus}</div>
                <hr>
                <div>Advance Payment: ${advance_payment}</div>
                <div>Daily Payment: ${daily_salary}</div>
                <div>${remarks}</div>
            </div>
            <script>
                window.onload = function() {
                    window.print();
                    window.close();
                }
            <\/script>
        </body>
        </html>
    `;

    // Open print window
    var printWindow = window.open('', '_blank', 'width=300,height=200');
    
    // Write content
    printWindow.document.open();
    printWindow.document.write(printContent);
    printWindow.document.close();

    // Fallback print method
    setTimeout(function() {
        try {
            printWindow.print();
        } catch(e) {
            console.error('Print error:', e);
            alert('Unable to print. Please check your browser settings.');
        }
    }, 500);
}
</script>

<style>
    .employee-id-link {
        cursor: pointer;
    }

    .employee-id-link:hover {
        text-decoration: underline !important;
        color: #004499 !important;
    }

    #dateSelectionModal .form-group {
        margin-bottom: 15px;
    }

    #dateSelectionModal .modal-body {
        padding: 20px;
    }

    #dateSelectionModal label {
        display: block;
        margin-bottom: 5px;
    }
.attendance_table_100 {
    width: 100%;
    margin-bottom: 20px;
}

.attendance_table_100 th, 
.attendance_table_100 td {
    padding: 8px;
    vertical-align: middle;
}

.panel-body ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.panel-body ul li {
    margin-right: 15px;
}

.form-horizontal .control-label {
    padding-top: 7px;
    margin-right: 10px;
}


.employee-id-link {
    cursor: pointer;
}

.employee-id-link:hover {
    text-decoration: underline;
    color: #004499;
}

/* Print-specific styles */
@media print {
    .no-print {
        display: none !important;
    }
    .thermal-report {
					width: 80mm;
					padding: 5mm;
                    padding-left: 0px;
					margin: 0 auto;
					font-size: 12px;
					font-family: Arial, sans-serif;
				}

    .modal-footer,
    .close {
        display: none !important;
    }
    #monthlyReportModal {
        position: absolute;
        left: 0;
        top: 0;
        margin: 0;
        padding: 0;
        overflow: visible !important;
    }

    #monthlyReportModal .modal-dialog {
        width: 80mm !important;
        margin: 0;
        padding: 0;
    }

    #monthlyReportModal .modal-content {
        border: none;
        box-shadow: none;
    }

    #monthlyReportModal .modal-body {
        padding: 0;
        width: 80mm !important;
    }

    #monthlyReportModal .no-print {
        display: none !important;
    }

    /* Reset any Bootstrap modal styles that might affect printing */
    .modal {
        position: absolute !important;
        left: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .modal-backdrop {
        display: none !important;
    }

    .print-header {
        display: block;
        margin-bottom: 20px;
        text-align: center;
    }

    .print-header h2 {
        margin: 0;
        padding: 0;
    }

    .status-dropdown {
        display: none !important;
    }

    .status-text {
        display: inline !important;
    }

    .attendance_table_100 {
        border-collapse: collapse;
    }

    .attendance_table_100 th,
    .attendance_table_100 td {
        border: 1px solid #ddd;
    }

    /* Reset any background colors for better printing */
    * {
        background: white !important;
        color: black !important;
    }

    /* Ensure table fits on the page */
    table {
        page-break-inside: auto;
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    thead {
        display: table-header-group;
    }
}

/* Hide print-only elements when not printing */
@media screen {
    .print-header {
        display: none;
    }
    #monthlyReportModal .modal-dialog {
        margin: 30px auto;
    }
    
    #monthlyReportModal .thermal-report {
        background-color: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .status-text {
        display: none;
    }
}
</style>

<?php $this->load->view("partial/footer"); ?>