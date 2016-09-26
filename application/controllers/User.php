<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->model('user_model');
		$this->load->library('authex');
		$this->load->library('foto_upload');
		
		$login = $this->authex->logged_in();
		if(!$login){
			redirect(site_url(''));
		}
		
    }
	
	public function index()
	{	
		if($this->session->userdata('level') == 1 ){
			if(isset($_GET['msg'])){
				$data['message'] = $this->getMessage($_GET['msg']);
			}
			$data['list'] = $this->user_model->getUser();
			//var_dump($data);die;
			$this->load->view('admin/user/list', $data);
		}else{
			redirect(site_url(''));
		}	
	}
	
	public function add(){
		if($this->session->userdata('level') == 1  ){
			$data['level'] = $this->user_model->getUserLevel();
			//var_dump($data);die;
			$this->load->view('admin/user/add', $data);
		}else{
			redirect(site_url(''));
		}		
	}
	
	public function edit($id){
		if($this->session->userdata('level') == 1  ){
			$data['level'] = $this->user_model->getUserLevel();	
			$data['detail'] = $this->user_model->getDetailUser($id);
			// var_dump($data);die;
			$this->load->view('admin/user/edit', $data);

		}else{
			redirect(site_url(''));
		}	
		
	}
	
	public function doAdd(){
		if($this->session->userdata('level') == 1  ){
			var_dump($_POST, $_FILES);
			if(!empty($_POST)){
				$this->db->trans_start();
				$password = md5($_POST['username']);	
				$foto_name = $_POST['full_name'].'-'.$_POST['level'].'.jpeg';
				$param = array(
					'user_full_name'=>$_POST['full_name'],
					'user_username'=>$_POST['username'],
					'user_email'=>$_POST['email'],
					'user_level_id'=>$_POST['level'],
					'user_desc'=>$_POST['deskripsi'],
					'user_photo_name'=>$foto_name,
					'user_password'=>$password
				);
				$result = $this->user_model->insertUser($param);
				// var_dump($_FILES);die;
				if($result && $_FILES['photo']['error'] != 4){				
					
					$result = $result && $this->foto_upload->process_image($_FILES['photo']['tmp_name'], $foto_name);	
				}
				$this->db->trans_complete($result);
				
				if($result){
				redirect(base_url('index.php/user/index?msg=Am1'));
				}else{
					redirect(base_url('index.php/user/index?msg=Am0'));
				}
			}else{
				redirect(site_url('user/add'));
			}
			

		}else{
			redirect(site_url(''));
		}
		
	}
	
	public function doEdit(){
		if($this->session->userdata('level') == 1  ){
			$this->db->trans_start();
			$param = array(
				'user_full_name'=>$_POST['user_full_name'],
				'user_username'=>$_POST['user_username'],
				'user_email'=>$_POST['user_email'],
				'user_level_id'=>$_POST['level'],
				'user_desc'=>$_POST['deskripsi'],
				'user_photo_name'=>$foto_name
			);
			$id=$_POST['id'];
			$result = $this->user_model->updateUser($param, $id);
			// var_dump ($result, $this->db->last_query()); die;
			if($result && $_FILES['photo']['error'] != 3){				
					
					$result = $result && $this->foto_upload->process_image($_FILES['photo']['tmp_name'], $foto_name);	
				}
			$this->db->trans_complete($result);
			if($result == true){
				redirect(base_url('index.php/user/index?msg=Em1'));
			}else{
				redirect(base_url('index.php/user/index?msg=Em0'));
			}

		}else{
			redirect(site_url(''));
		}
	}
	
	public function doDelete($id){
		if($this->session->userdata('level') == 1  ){
			$result = $this->user_model->deleteInv($id);
			if($result == true){
				redirect(site_url('user/index?msg=Dm1'));
			}else{
				redirect(site_url('user/index?msg=Dm0'));			
			}

		}else{
			redirect(site_url(''));
		}		
	}
	
	private function getMessage($idx){
		if($idx == 'Em1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Edit Data user Sukses.
				</div>
			';
		}elseif($idx == 'Em0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Edit Data user Gagal.
				</div>
			';
		}elseif($idx == 'Am1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Tambah Data user Sukses.
				</div>
			';
		}elseif($idx == 'Am0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Tambah Data user Gagal.
				</div>
			';
		}elseif($idx == 'Dm1'){
			return '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
					Hapus Data user Sukses.
				</div>
			';
		}elseif($idx == 'Dm0'){
			return '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Gagal!</h4>
					Hapus Data user Gagal.
				</div>
			';
		}
	}
}
