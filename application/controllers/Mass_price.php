<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mass_price extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('MassPrice_model');
			
    }
	
	public function listing($id=null, $mspr_id=null)
	{
		//var_dump($id, $mspr_id);die;
		if(isset($_GET['msg'])){
			$data['message'] = $this->getMessage($_GET['msg']);
		}
		if($mspr_id !== null){
			$data['detail'] = $this->MassPrice_model->getMassPriceById($mspr_id);
		}
		$data['list'] = $this->MassPrice_model->getMassPrice($id);
		
		var_dump($data);die;
		$this->load->view('admin/mass_price/list', $data);
	}
	
	public function add(){
		$data['type'] = $this->MassPrice_model->getinventoryType();
		$data['category'] = $this->MassPrice_model->getinventoryCategory();
		//var_dump($data);die;
		$this->load->view('admin/mass_price/add', $data);
	}
	
	public function edit($id){
		$data['type'] = $this->MassPrice_model->getinventoryType();
		$data['category'] = $this->MassPrice_model->getinventoryCategory();		
		$data['detail'] = $this->MassPrice_model->getInvDetailById($id);
		//var_dump($data);die;
		$this->load->view('admin/mass_price/edit', $data);
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
		$result = $this->MassPrice_model->insertInventory($param_inv);
		
		if($result == true){
			redirect(base_url('index.php/inventory/index?msg=Am1'));
		}else{
			redirect(base_url('index.php/inventory/index?msg=Am0'));
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
		$result = $this->MassPrice_model->UpdateInventory($param_inv, $id);
		
		if($result == true){
			redirect(base_url('index.php/inventory/index?msg=Em1'));
		}else{
			redirect(base_url('index.php/inventory/index?msg=Em0'));
		}
	}
	
	public function doDelete($id){
		$result = $this->MassPrice_model->deleteInv($id);
		if($result == true){
			redirect(site_url('inventory/index?msg=Dm1'));
		}else{
			redirect(site_url('inventory/index?msg=Dm0'));			
		}
	}
	
	private function getMessage($idx){
		if($idx == 'Em1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Edit Data Inventory Sukses.
				</div>
			';
		}elseif($idx == 'Em0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Edit Data Inventory Gagal.
				</div>
			';
		}elseif($idx == 'Am1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Tambah Data Inventory Sukses.
				</div>
			';
		}elseif($idx == 'Am0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Tambah Data Inventory Gagal.
				</div>
			';
		}elseif($idx == 'Dm1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Hapus Data Inventory Sukses.
				</div>
			';
		}elseif($idx == 'Dm0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Hapus Data Inventory Gagal.
				</div>
			';
		}
	}
}
