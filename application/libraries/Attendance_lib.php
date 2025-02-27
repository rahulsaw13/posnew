<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Attendance library
 *
 * Library with utilities to manage sales
 */

class Attendance_lib
{
	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
         
	}



	public function clear_all()
	{
	
	
		//$this->delete_attendance_date();
		$this->delete_attendance_data();
	
	}
    public function get_attendance_date()
	{
		$var=$this->CI->session->userdata('attendance_date');
		if(!$this->CI->session->userdata('attendance_date'))                                                                                                                                                                                                                     
		{                                                                                                                                                                                                                                                                   
			return;                                                                                                                                                                                                                           
		}      
		return $this->CI->session->userdata('attendance_date');
	}

	public function set_attendance_date($attendance_date)
	{
		$this->CI->session->set_userdata('attendance_date', $attendance_date);
		$this->delete_attendance_data();
	}
	public function delete_attendance_date()
	{
		$this->CI->session->unset_userdata('attendance_date');
	}

    public function get_attendance_data()
	{
		
		if(!$this->CI->session->userdata('attendance_data'))                                                                                                                                                                                                                     
		{                                                                                                                                                                                                                                                                   
			$this->set_attendance_data($data=array());                                                                                                                                                                                                                            
		}      
		return $this->CI->session->userdata('attendance_data');
	}

	public function set_attendance_data($attendance_data)
	{
		$this->CI->session->set_userdata('attendance_data', $attendance_data);
	}

    public function delete_attendance_data()
	{
		$this->CI->session->unset_userdata('attendance_data');
	}

	public function update_attendance($Attendance_id,$payment_status,$status,$remark,$advance_payment)
	{
		$Attendances = $this->get_attendance_data();
		if(!$Attendances)
		{
			$Attendances = array();
		}
		if(isset($Attendances[$Attendance_id]))
		{
			//Attendance_method already exists, add to Attendance_amount
			$Attendances[$Attendance_id]['payment_status'] = $payment_status;
			$Attendances[$Attendance_id]['status'] = $status;
			$Attendances[$Attendance_id]['advance_payment'] = $advance_payment;
			$Attendances[$Attendance_id]['remarks'] = $remark;
		}
		else
		{
			//add to existing array
			if($Attendance_id!="")
			{
			$Attendance = array($Attendance_id => array('employee_id'=>$Attendance_id,'advance_payment' => $advance_payment,'payment_status' => $payment_status,'status' => $status,'remarks'=>$remark));

			$Attendances += $Attendance;
			}
		}
		$this->set_attendance_data($Attendances);
	}

	

	
	
	

	
	

	


}

?>
