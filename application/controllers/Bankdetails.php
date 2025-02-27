<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('Secure_Controller.php');

class Bankdetails extends Secure_Controller
{
	private $controller_name="bankdetails";

	public function __construct()
	{
		parent::__construct();
			$this->load->model('Bankinfo');
	
	}

	public function index()
	{
		$this->session->set_userdata('allow_temp_bankdetails', 0);
         $data['table_headers'] = $this->xss_clean(get_bankdetails_manage_table_headers());
		 $data['controller_name'] = $this->controller_name;

		//Filters that will be loaded in the multiselect dropdown
		$data['filters'] = array(
			'is_active' => $this->lang->line('is_deleted'),
			'is_primary' => $this->lang->line('is_primary'));
		
			$this->load->view('bankdetails/manage', $data);
	}

	/*
	 * Returns Items table data rows. This will be called with AJAX.
	 */
	public function search()
	{
		$search = $this->input->get('search');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort = $this->input->get('sort');
		$order = $this->input->get('order');

		$filters = array(
			'start_date' => $this->input->get('start_date'),
			'end_date' => $this->input->get('end_date'),
			'is_active' => ($this->input->get('is_active')),
			'is_primary' => $this->input->get('is_primary'));

		//Check if any filter is set in the multiselect dropdown
		$filledup = array_fill_keys($this->input->get('filters'), TRUE);
		$filters = array_merge($filters, $filledup);
		$bankdetails = $this->Bankinfo->search($search, $filters, $limit, $offset, $sort, $order);
		$total_rows = $this->Bankinfo->get_found_rows($search, $filters);
		$data_rows = [];

		foreach($bankdetails->result() as $bankdetail)
		{
			$data_rows[] = $this->xss_clean(get_bankdetail_data_row($bankdetail));

		
		}

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
	}

	public function view($bank_id = NEW_BANK_DETAIL)
	{
		if($bank_id === NEW_BANK_DETAIL)
		{
			$data = [];
		}
		$data['controller_name'] = $this->controller_name;
        $data['allow_temp_bankdetails'] = $this->session->userdata('allow_temp_bankdetails');
		$bank_info = $this->Bankinfo->get_info($bank_id);
		foreach(get_object_vars($bank_info) as $property => $value)
		{
			$bank_info->$property = $this->xss_clean($value);
		}


		$data['bank_info'] = $bank_info;
		$this->load->view('bankdetails/form', $data);
	}

	public function delete()
	{
		$bankdetails_to_delete = $this->input->post('ids');
		if($this->Bankinfo->delete_list($bankdetails_to_delete))
		{
			$message = $this->lang->line('bankdetails_successful_deleted') . ' ' . count($bankdetails_to_delete) . ' ' . $this->lang->line('bankdetails_one_or_multiple');
			echo json_encode(array('success' => TRUE, 'message' => $message));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('bankdetails_cannot_be_deleted')));
		}
	}
	
	public function save($bank_id = NEW_BANK_DETAIL)
	{
		//$upload_data = $this->upload->data();
         
		//Save item data
		$bank_data = array(
			'bank_account_number' => $this->input->post('bank_account_number'),
			'bank_account_holder_name' => $this->input->post('bank_account_holder_name'),
			'bank_ifsc' => $this->input->post('bank_ifsc'),
			'upi_id' => $this->input->post('upi_id'),
		    'is_active' =>($this->input->post('is_active')? 1 : 0),
			'is_primary' =>($this->input->post('is_primary')? 1: 0)
		);
		$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		if($this->Bankinfo->save($bank_data,$bank_id))
		{
			$success = TRUE;
			$new_account = FALSE;

			if($bank_id == NEW_BANK_DETAIL)
			{
				$bank_id = $bank_data['bank_id'];
				$new_account = TRUE;
			}

			

			if($success)
			{
				$message = $this->xss_clean($this->lang->line('bankdetails_successful_' . ($new_account ? 'adding' : 'updating')) . ' ' . $item_data['name']);

				echo json_encode(array('success' => TRUE, 'message' => $message, 'Bank Account No.' =>$bank_data['bank_account_number']));
			}
		}
		else
		{
			$message = $this->xss_clean($this->lang->line('bankdetails_error_adding_updating') . ' ' . $bank_data['bank_account_number']);

			echo json_encode(array('success' => FALSE, 'message' => $message, 'Bank Account No.' =>$bank_data['bank_account_number']));
		}
	}

}

?>
