<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('cashier_model');
		$this->load->model('report_model');
		$this->load->library('authex');
		$login = $this->authex->logged_in();
		if(!$login){
			redirect(site_url(''));
		}
    }
	
	
	public function get_type_by_cat(){
		//var_dump($_POST);die;
		$type = $this->cashier_model->getTypeByCat($_POST['category_id']);
		
		$result = json_encode($type);
		echo $result;
		exit;
		
	}
	
	public function inv_print($id){
		if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){
			$data['inv'] = $this->cashier_model->getInvDetailByInvNumber($id);		
			$data['inv_detail'] = $this->cashier_model->getInvDetail($data['inv']->order_id);
			//var_dump($data);die;
			$this->load->view('admin/cashier/print', $data);
		}else{
			redirect(site_url(''));
		}	
		
	}
	
	public function daily_list(){
		if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2 || $this->session->userdata('level') == 3){
			$filter = array(
				'user'=>'all'
			);
			// var_dump($_POST);die;
			if(!empty($_POST)){
				if($_POST['date'] == '1970-01-01'){
					$date = null;
				}else{
					$date = $_POST['date'];
				}
				$filter = array(
					'date'=> date('Y-m-d', strtotime($date)),
					'user'=>$_POST['user']
				);
				$data['post'] = $filter;
			}
			
			$data['invoice'] = $this->report_model->getTransactionByDate($filter);
			// var_dump($this->db->last_query());
			$data['user'] = $this->report_model->getUser();
			//var_dump($data);die;
			
			$this->load->view('admin/report/list', $data);
		}else{
			redirect(site_url(''));
		}			
	}
	
	public function get_detail_invoice(){
		
		$result = $this->cashier_model->getDetailInvoiceByInvoiceCode($_POST['invo_number']);
		//var_dump($result);die;
		echo json_encode($result);
		exit;
	}
	
	public function printPdf(){
		
	}
	
}
