<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Referrals extends Secure_Controller
{
	
	private $controller_name="referrals";

	public function __construct()
	{
		parent::__construct();
			$this->load->model('referral');
	
	}

	public function index()
	{
		$this->session->set_userdata('allow_temp_referrals', 0);
		$data['table_headers'] = $this->xss_clean(get_Referral_manage_table_headers());
		$data['controller_name'] = $this->controller_name;

		$this->load->view('referrals/manage', $data);
	}

	public function detailed_report($referral_id=NEW_REFERRAL_DETAIL)
	{
		$data['table_headers'] = $this->xss_clean(get_referral_detailed_report_table_headers());
		$data['controller_name'] = $this->controller_name;
        // $data['summary_data'] = $this->specific_referal_POS($referral_id);
		$this->load->view('referrals/detailed_report', $data);
	}

	/*
	 * Returns Referrals_commission_data table data rows. This will be called with AJAX.
	 */

	 public function specific_referal_POS($referral_id)
	{
		$inputs = array('referral_id' => $referral_id);

		$report_data = $this->Referral->get_referal_sales_Data($referral_id);

		$summary_data = array();
		$details_data = array();

		foreach($report_data as $key => $row)
		{
			$summary_data[] = $this->xss_clean(array(
				'Bill_no' => $row['sale_id'],
				'Bill_amount' => to_currency($row['sale_total']),
				'Commission' => to_currency($row['sale_commission']),
				'commission_paid_status' => to_currency($row['commission_paid_status']),
				'edit' => anchor('Referral/edit_detailed_referral_data/'. $row['sale_id'], '<span class="glyphicon glyphicon-edit"></span>',
					array('class'=>'modal-dlg print_hide', $button_key => $button_label, 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('sales_update')))
			));

		}
		echo json_encode(array('total' => count($summary_data), 'rows' => $summary_data));
		// return $summary_data;
	}


	public function search()
	{
		$search = $this->input->get('search');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort = $this->input->get('sort');
		$order = $this->input->get('order');
		//Check if any filter is set in the multiselect dropdown
		$filledup = array_fill_keys($this->input->get('filters'), TRUE);
		$filters = array_merge($filters, $filledup);
		$referrals = $this->Referral->search($search, $filters, $limit, $offset, $sort, $order);
		$total_rows = $this->Referral->get_found_rows($search, $filters);
		$data_rows = [];

		foreach($referrals->result() as $referral)
		{
			$data_rows[] = $this->xss_clean(get_referral_data_row($referral));

		
		}

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
	}


	public function view($referral_id = NEW_REFERRAL_DETAIL)
	{
		if($referral_id === NEW_REFERRAL_DETAIL)
		{
			$data = [];
		}
		$data['controller_name'] = $this->controller_name;
        $data['allow_temp_referrals'] = $this->session->userdata('allow_temp_referrals');
		$Referral = $this->Referral->get_info($referral_id);
		foreach(get_object_vars($Referral) as $property => $value)
		{
			$Referral->$property = $this->xss_clean($value);
		}


		$data['Referral'] =$Referral;
		$this->load->view('referrals/form', $data);
	}


	public function save($referral_id = NEW_REFERRAL_DETAIL)
	{
		//$upload_data = $this->upload->data();
         
		//Save item data
		$referral_data = array(
			'name' => $this->input->post('name'),
			'phone_no' => $this->input->post('phone_number'),
			'address' => $this->input->post('address')
			
		);
		$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		if($this->Referral->save($referral_data,$referral_id))
		{
			$success = TRUE;
			$new_account = FALSE;

			if($referral_id == NEW_BANK_DETAIL)
			{
				$referral_id = $referral_data['referral_id'];
				$new_account = TRUE;
			}

			

			if($success)
			{
				$message = $this->xss_clean($this->lang->line('referrals_successful_' . ($new_account ? 'adding' : 'updating')) . ' ' . $referral_data['name']);

				echo json_encode(array('success' => TRUE, 'message' => $message, 'Referral' =>$referral_data['name']));
			}
		}
		else
		{
			$message = $this->xss_clean($this->lang->line('referrals_error_adding_updating') . ' ' . $referral_data['name']);

			echo json_encode(array('success' => FALSE, 'message' => $message, 'Referral' =>$referral_data['name']));
		}
	}

	public function delete()
	{
		$referrals_to_delete = $this->input->post('ids');
		if($this->Referral->delete_list($referrals_to_delete))
		{
			$message = $this->lang->line('referrals_successful_deleted') . ' ' . count($referrals_to_delete) . ' ' . $this->lang->line('referrals_one_or_multiple');
			echo json_encode(array('success' => TRUE, 'message' => $message));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('referrals_cannot_be_deleted')));
		}
	}


}
?>
