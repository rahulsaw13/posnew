<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

 if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sale class
 */
class Attendance extends CI_Model
{

	/**
	 * 	find list of employee
	 */
	public function get_employees()
	{
		$this->db->select("e.person_id as id, CONCAT(p.first_name, ' ', p.last_name) AS full_name, es.employee_daily_salary");
		$this->db->from('people p');
		$this->db->join('employees e', 'p.person_id = e.person_id');  // Join the people and employee tables
		$this->db->join('employee_salary es', 'es.person_id = e.person_id','left');  // Join the people and employee tables
		$this->db->where('e.deleted', 0);  // Filter to get employees who are not deleted
		$this->db->where('e.person_id!=',1);
		return $this->db->get()->result();  // Fetch results as an array of object
	}

	
 
	

	public function is_data_exits($id,$date)
	{
           return $this->db->where("person_id", $id)
		   ->where("date", $date)
		   ->from("attendances") // Replace 'your_table_name' with the actual table name
		   ->count_all_results();
	}
	/**
	 * 	Update Bills
	 */
	public function save($Attendances,$date)
	{
		foreach ($Attendances as $key => $value) {
			$Attendances_data = array(
				'person_id'		  => $value['employee_id'],
				'date'	  => $date,
				'status'  => $value['status'],
				'payment_status'  => $value['payment_status'],
				'remarks'	  => $value['remarks'],
				'advance_payment' => $value['advance_payment'],
				'editable' => 1,
			);
			$return = $this->db->set('employee_advance_salary', 'employee_advance_salary + ' . (int)$value['advance_payment'], FALSE)
			->where("person_id", $value['employee_id'])
			->update('employee_salary');
			if($return && $this->is_data_exits($value['employee_id'],$date))
			{
				$this->db->where("person_id", $value['employee_id'])
         		->where("date", $date)
         		->update('attendances', array("status" => $value['status'], 'advance_payment' => $value['advance_payment'],'payment_status'  => $value['payment_status'], 'remarks' => $value['remarks']));
			}
			$return = $this->db->insert('attendances', $Attendances_data);
		}
		
	}


	public function no_of_days_worked($employee_id)
	{
		$this->db->select("count(*) as total_count");
		$this->db->from('attendances');
		$this->db->where('status', 1);
		$this->db->where('person_id', $employee_id);

		// Filter for current month (you can adjust 'attendance_date' to match your column name)
		$this->db->where('MONTH(date)', date('m')); // Get current month
		$this->db->where('YEAR(date)', date('Y')); // Get current year

		$return = $this->db->get()->row(); // Fetch a single row
        
		return $return->total_count;
		
		
	}

	public function get_employee_attendance_range($employee_id,$start_date, $end_date)
	{
		$this->db->select("*");
		$this->db->from('attendances');
		$this->db->where('date>=', $start_date);
		$this->db->where('date<=', $end_date);
		$this->db->where('person_id', $employee_id);

		return $this->db->get()->result_array(); // Fetch a single row
		
	}

	public function get_attendance_data($date)
	{
		$this->db->select("person_id,payment_status,status,remarks,advance_payment");
		$this->db->from('attendances');
		$this->db->where('date',$date);
		$data=$this->db->get()->result();  // Fetch results as an array of object
		$res = array();
		foreach ($data as $row) {
			$res[$row->person_id] = array("employee_id"=>$row->person_id,"advance_payment"=>$row->advance_payment,"payment_status"=>$row->payment_status,"status"=>$row->status,"remarks"=>$row->remarks);
		}		
		return $res;
	}

	


	
}
?>
