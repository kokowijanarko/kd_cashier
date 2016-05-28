<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('cashier_model');
    }
	
	public function index()
	{
		if(isset($_GET['msg'])){
			$data['message'] = $this->getMessage($_GET['msg']);
		}
		$data['order_code'] = $this->orderCodeGenerator();
		$data['produk'] = $this->cashier_model->getinventory();
		$this->load->view('admin/cashier/add', $data);
		
	}
	
	private function orderCodeGenerator(){
		//loc = last order code
		$last_order_code = $this->cashier_model->getLastOrderCode();
		if($last_order_code == null){
			$new_order_code = 'INV.1/'.date('d').'/'.date('M').'/'.date('Y');
		}else{
			$loc_explode = explode('/', $last_order_code);
			$loc_identifier = explode('.', $loc_explode[0]);
			$loc_prefix = $loc_identifier[0];
			$loc_index = $loc_identifier[1];
			$loc_date = $loc_identifier[1];
			$loc_month = $loc_identifier[2];
			$loc_year = $loc_identifier[3];
			$loc_datestamp = $loc_date.$loc_month.$loc_year;
			
			if(date('d-M-Y') == $loc_datestamp){
				$new_loc_index = $loc_index +  1;
			}else{
				$new_loc_index = 1;
			}
			
			$new_order_code = 'INV.'.$new_loc_index.'/'.date('d').'/'.date('M').'/'.date('Y');
		}
		return $new_order_code;
		
	}
	
	public function add(){
		$data['type'] = $this->cashier_model->getcashierType();
		$data['category'] = $this->cashier_model->getcashierCategory();
		//var_dump($data);die;
		$this->load->view('admin/cashier/add', $data);
	}
	
	public function edit($id){
		$data['type'] = $this->cashier_model->getcashierType();
		$data['category'] = $this->cashier_model->getcashierCategory();		
		$data['detail'] = $this->cashier_model->getInvDetailById($id);
		//var_dump($data);die;
		$this->load->view('admin/cashier/edit', $data);
	}
	
	public function doAdd(){
		//var_dump($_POST);//die;
		$param_inv = array(
			'inv_name' => $_POST['produk'],
			'inv_type_id' => $_POST['type'],
			'inv_category_id' => $_POST['category'],
			'inv_price' => $_POST['harga'],
			'inv_stock' => $_POST['stok'],
			'inv_desc' => $_POST['deskripsi']
		);
		//var_dump($param_inv);die;
		$result = $this->cashier_model->insertcashier($param_inv);
		
		if($result == true){
			redirect(base_url('index.php/cashier/index?msg=Am1'));
		}else{
			redirect(base_url('index.php/cashier/index?msg=Am0'));
		}
	}
	
	public function doEdit(){
		//var_dump($_POST);die;
		$param_inv = array(
			'inv_name' => $_POST['produk'],
			'inv_type_id' => $_POST['type'],
			'inv_category_id' => $_POST['category'],
			'inv_price' => $_POST['harga'],
			'inv_stock' => $_POST['stok'],
			'inv_desc' => $_POST['deskripsi']
		);
		$id=$_POST['id'];
		$result = $this->cashier_model->Updatecashier($param_inv, $id);
		
		if($result == true){
			redirect(base_url('index.php/cashier/index?msg=Em1'));
		}else{
			redirect(base_url('index.php/cashier/index?msg=Em0'));
		}
	}
	
	public function doDelete(){
		$this->load->view('add');
	}
	
	private function getMessage($idx){
		if($idx == 'Em1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Edit Data cashier Sukses.
				</div>
			';
		}elseif($idx == 'Em0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Edit Data cashier Gagal.
				</div>
			';
		}elseif($idx == 'Am1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Tambah Data cashier Sukses.
				</div>
			';
		}elseif($idx == 'Am0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Tambah Data cashier Gagal.
				</div>
			';
		}elseif($idx == 'Dm1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Hapus Data cashier Sukses.
				</div>
			';
		}elseif($idx == 'Dm0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Hapus Data cashier Gagal.
				</div>
			';
		}
	}
}
