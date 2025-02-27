<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Persons.php");

class Outlets extends Persons
{
	public function __construct()
	{
		parent::__construct('outlets');
		$this->load->model('outlet');
	}
	public function add(){
		
		$this->load->view('outlets/add');
	}
	public function index($employee_id = -1)
	{
		
		$person_info = $this->Employee->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		$data['person_info'] = $person_info;
		$data['employee_id'] = $employee_id;

		$modules = array();
		foreach($this->Module->get_all_modules()->result() as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));
			$module->menu_group = $this->xss_clean($this->Employee->get_menu_group($module->module_id, $person_info->person_id));

			$modules[] = $module;
		}
		$data['all_modules'] = $modules;

		$permissions = array();
		foreach($this->Module->get_all_subpermissions()->result() as $permission)
		{
			$permission->module_id = $this->xss_clean($permission->module_id);
			$permission->permission_id = str_replace(' ', '_', $this->xss_clean($permission->permission_id));
			$permission->grant = $this->xss_clean($this->Employee->has_grant($permission->permission_id, $person_info->person_id));

			$permissions[] = $permission;
		}
		$data['all_subpermissions'] = $permissions;

		$this->load->view('outlets/form', $data);
	}
	/*
	Inserts/updates an outlets
	*/
	public function save($employee_id = -1)
	{
        
		$branch_name = $this->xss_clean($this->input->post('branch_name'));
		/* $last_name = $this->xss_clean($this->input->post('last_name'));
		$email = $this->xss_clean(strtolower($this->input->post('email')));

		// format first and last name properly
		$first_name = $this->nameize($first_name);
		$last_name = $this->nameize($last_name); */

		$person_data = array(
			'branch_name' => $branch_name,
			
		);

		/* $grants_array = array();
		foreach($this->Module->get_all_permissions()->result() as $permission)
		{
			$grants = array();
			$grant = $this->input->post('grant_'.$permission->permission_id) != NULL ? $this->input->post('grant_'.$permission->permission_id) : '';
			if($grant == $permission->permission_id)
			{
				$grants['permission_id'] = $permission->permission_id;
				$grants['menu_group'] = $this->input->post('menu_group_'.$permission->permission_id) != NULL ? $this->input->post('menu_group_'.$permission->permission_id) : '--';
				$grants_array[] = $grants;
			}
		} */

		//Password has been changed OR first time password set
		if($this->input->post('password') != '' && ENVIRONMENT != 'testing')
		{
			$exploded = explode(":", $this->input->post('language'));
			$employee_data = array(
				'username' 	=> $this->input->post('username'),
				'outlet_id' => strtoupper(bin2hex(random_bytes(4))),
				'user_type' => "outlet",
				'password' 	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'hash_version' 	=> 2,
				'language_code' => $exploded[0],
				'language' 	=> $exploded[1]
			);
		}
		else //Password not changed
		{
			$exploded = explode(":", $this->input->post('language'));
			$employee_data = array(
				'username' 	=> $this->input->post('username'),
				'language_code'	=> $exploded[0],
				'language' 	=> $exploded[1]
			);
		}
        
		if($this->outlet->save_outlet_data($person_data, $employee_data, $employee_id))
		{
			// New employee
			if($employee_id == -1)
			{
				echo json_encode(array('success' => TRUE,
								'message' => 'Outlet '. $branch_name . 'has beedn added succefully',
								'id' => $this->xss_clean($employee_data['person_id'])));
			}
			else // Existing employee
			{
				/* echo json_encode(array('success' => TRUE,
								'message' => $this->lang->line('employees_successful_updating') . ' ' . $first_name . ' ' . $last_name,
								'id' => $employee_id)); */
			}
		}
		else // Failure
		{
			echo json_encode(array('success' => FALSE,
							'message' => "Something went wrong .Please try again later !",'id' => -1));
		}
	}

	/*
	This deletes employees from the employees table
	*/
	public function delete()
	{
		$employees_to_delete = $this->xss_clean($this->input->post('ids'));

		if($this->Employee->delete_list($employees_to_delete))
		{
			echo json_encode(array('success' => TRUE,'message' => $this->lang->line('employees_successful_deleted') . ' ' .
							count($employees_to_delete) . ' ' . $this->lang->line('employees_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('employees_cannot_be_deleted')));
		}
	}

	public function check_username($employee_id)
	{
		$exists = $this->Employee->username_exists($employee_id, $this->input->get('username'));
		echo !$exists ? 'true' : 'false';
	}
}
?>
