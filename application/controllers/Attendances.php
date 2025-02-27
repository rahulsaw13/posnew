<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Attendances extends Secure_Controller
{
	public function __construct()
	{
		parent::__construct('Attendances');

		$this->load->helper('file');
		$this->load->library('Attendance_lib');
	}

	private function _reload($data = array())
	{
		$data['selected_date'] = $this->attendance_lib->get_attendance_date();
		// if($data['selected_date'])
		// {
		// 	if($this->attendance_lib->get_attendance_data())
		// 	{
		// 		$data['attendance_records']=$this->attendance_lib->get_attendance_data();
		// 	}
		//     else 
		// 	{
		// 		$data['attendance_records'] = $this->Attendance->get_attendance_data($data['selected_date']);
		// 	}
		// }
		if($data['selected_date']) {
			// Initialize empty array for attendance records
			$data['attendance_records'] = array();
			
			// Get attendance data from library
			$lib_attendance = $this->attendance_lib->get_attendance_data();
			
			// Get attendance data from database
			$db_attendance = $this->Attendance->get_attendance_data($data['selected_date']);
			
			// If library has data, start with that
			if($lib_attendance) {
				$data['attendance_records'] = $lib_attendance;
			}
			
			// If database has data, merge it with library data
			if($db_attendance) {
				foreach($db_attendance as $employee_id => $attendance) {
					// Only add if not already present in library data
					if(!isset($data['attendance_records'][$employee_id])) {
						$data['attendance_records'][$employee_id] = $attendance;
					}
				}
			}
		}
		
		$data['employees']=$this->Attendance->get_employees();
		$this->load->view("Attendance/register", $data);
	}

	public function index()
	{
		$this->session->set_userdata('allow_temp_items', 1);
		$this->_reload();
	}


	
	public function select_date()
	{
		$attendance_date = $this->input->post('attendance_date');
		if($attendance_date){
		   $this->attendance_lib->set_attendance_date($attendance_date);
		}
		$this->_reload();
	}
	public function update_attendance($id)
	{
	    $date=$this->attendance_lib->get_attendance_date();	
		$status=$this->input->post('status');
		if($status=="")
		{
			$status=$this->input->post('status_value');
		}
		$payment_status=$this->input->post('payment_status');
		if($payment_status=="")
		{
			$payment_status=$this->input->post('payment_status_value');
		}
		$advance_payment=$this->input->post('advance_payment');
		$remark=$this->input->post('remarks');
		$date=$this->attendance_lib->get_attendance_date();
		$this->attendance_lib->update_attendance($id,$payment_status,$status,$remark,$advance_payment);
		$this->_reload();
	}
	public function cancel()
	{
		$this->attendance_lib->clear_all();
		$this->_reload();
	}

	public function complete()
	{
		$data = $this->attendance_lib->get_attendance_data();
		$date =$this->attendance_lib->get_attendance_date();
		$this->Attendance->save($data,$date);
		$this->attendance_lib->clear_all();
		$this->_reload();

	}
    
	public function get_monthly_report()
	{
		$employee_id = $this->input->post('employee_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		
		// Get employee details
		$employee = $this->Employee->get_employee_and_salary_info($employee_id);
		
		// Get all attendance records for the specified month
		// $start_date = date('Y-m-d', strtotime("$year-$month-01"));
		// $end_date = date('Y-m-t', strtotime($start_date));
		
		$monthly_attendance = $this->Attendance->get_employee_attendance_range(
			$employee_id,
			$start_date,
			$end_date
		);
		// Calculate statistics
		$total_present = 0;
		$total_absent = 0;
		$total_advance = 0;
		
		foreach ($monthly_attendance as $record) {
			if ($record['status'] == '1') {
				$total_present++;
			} else if ($record['status'] == '0') {
				$total_absent++;
			}
			$total_advance += floatval($record['advance_payment']);
		}
	
		$total_salary = $total_present * $employee->employee_daily_salary;
	
		// Generate HTML for the report
		$html = '
		<div class="thermal-report">
			<div class="text-center company-header">
				<h4 class="mb-2">Monthly Attendance Report</h4>
				<div class="border-bottom pb-2 mb-3"></div>
			</div>
	
			<div class="employee-info mb-3">
				<div class="row">
					<div class="col-xs-12">
						<p class="mb-1"><strong>Name:</strong> ' . $employee->full_name . '</p>
						<p class="mb-1"><strong>Period:</strong> ' . date('F Y', strtotime($start_date)) . '</p>
					</div>
				</div>
			</div>
	
			<div class="summary-section mb-3">
				<h5 class="section-title">Attendance Summary</h5>
				<div class="table-responsive">
					<table class="table table-condensed table-bordered">
						<tr class="active">
							<th class="col-xs-6">Total Working Days</th>
							<td class="col-xs-6 text-right">' . count($monthly_attendance) . '</td>
						</tr>
						<tr>
							<th>Present Days</th>
							<td class="text-right">' . $total_present . '</td>
						</tr>
						<tr>
							<th>Absent Days</th>
							<td class="text-right">' . $total_absent . '</td>
						</tr>
						<tr class="info">
							<th>Total Salary</th>
							<td class="text-right">' . to_currency($total_salary) . '</td>
						</tr>
						<tr>
							<th>Total Advance</th>
							<td class="text-right">' . to_currency($total_advance) . '</td>
						</tr>
						<tr class="success">
							<th>Net Salary</th>
							<td class="text-right"><strong>' . to_currency($total_salary - $total_advance) . '</strong></td>
						</tr>
					</table>
				</div>
			</div>
	
			<div class="details-section">
				<h5 class="section-title">Daily Details</h5>
				<div class="table-responsive">
					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr class="active">
								<th class="col-xs-3">Date</th>
								<th class="col-xs-3">Status</th>
								<th class="col-xs-3">Advance</th>
								<th class="col-xs-3">Remarks</th>
							</tr>
						</thead>
						<tbody>';
	
		foreach ($monthly_attendance as $date => $record) {
			$status_class = $record['status'] == '1' ? 'text-success' : 'text-danger';
			$html .= '
							<tr>
								<td>' . date('d-m-y', strtotime($record['date'])) . '</td>
								<td class="' . $status_class . '">' . ($record['status'] == '1' ? 'Present' : 'Absent') . '</td>
								<td class="text-right">' . to_currency($record['advance_payment']) . '</td>
								<td class="small">' . $record['remarks'] . '</td>
							</tr>';
		}
	
		$html .= '
						</tbody>
					</table>
				</div>
			</div>
		</div>
	
		<style>
			@media print {
				.thermal-report {
					width: 80mm;
					padding: 5mm;
					margin: 0 auto;
					font-size: 12px;
					font-family: Arial, sans-serif;
				}
				
				.company-header h4 {
					font-size: 14px;
					font-weight: bold;
					margin-bottom: 5px;
				}
				
				.section-title {
					font-size: 13px;
					font-weight: bold;
					margin-bottom: 8px;
					background-color: #f5f5f5;
					padding: 3px;
				}
				
				.table {
					margin-bottom: 10px;
					font-size: 11px;
				}
				
				.table > thead > tr > th,
				.table > tbody > tr > th,
				.table > tbody > tr > td {
					padding: 4px;
					line-height: 1.3;
					border: 1px solid #ddd;
				}
				
				.table-condensed > thead > tr > th,
				.table-condensed > tbody > tr > th,
				.table-condensed > tbody > tr > td {
					padding: 3px;
				}
				
				.text-right {
					text-align: right;
				}
				
				.text-center {
					text-align: center;
				}
				
				.text-success {
					color: #3c763d;
				}
				
				.text-danger {
					color: #a94442;
				}
				
				.small {
					font-size: 10px;
				}
				
				.mb-1 { margin-bottom: 3px; }
				.mb-2 { margin-bottom: 6px; }
				.mb-3 { margin-bottom: 10px; }
				.mt-3 { margin-top: 10px; }
				.pb-2 { padding-bottom: 6px; }
				.pt-2 { padding-top: 6px; }
				
				.border-bottom {
					border-bottom: 1px solid #ddd;
				}
				
				.border-top {
					border-top: 1px solid #ddd;
				}
				
				/* Hide any unwanted elements when printing */
				.modal-footer,
				.close {
					display: none !important;
				}
			}
		</style>';
	
		echo $html;
	}

	// Multiple Attendances
	public function delete_Attendance($Attendance_id)
	{
		$this->Attendance_lib->delete_Attendance($Attendance_id);

		$this->_reload();
	}

	

	
}
?>