<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$this->load->library('authex');
    }
	
	public function index(){
		$this->load->view('login');
	}
        
	public function login(){
		//var_dump($_POST);
		$auth = $this->authex->login($_POST['key'], $_POST['password']);
		//var_dump($auth, $this->session->userdata());
		//die;
		if($auth){
			redirect('dashboard1');			
		}else{
			redirect(site_url(''));
		}
	}
	
	public function logout(){
		$this->authex->logout();
		redirect(site_url(''));
	}
}
