<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('login')==true) {
				header("Location:".base_url('admin'));
		}
		$this->load->model('admin_data');
		$this->load->library('form_validation');
	}
	public function index(){
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/login_admin');
	}
	public function auth(){
		$this->form_validation->set_rules('id_user', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['error']="<div class='alert alert-danger'>"
								."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".validation_errors()
						  ."</div>";
			$this->load->view('admin_vw/meta_admin');
			$this->load->view('admin_vw/js_admin');
			$this->load->view('admin_vw/navbar_admin');
			$this->load->view('admin_vw/login_admin',$data);
		}else{
			$id_user =$this->input->post('id_user');
			$password=$this->input->post('password');
			$login=$this->admin_data->admin_login($id_user,md5($password));
			if ($login==false) {
				$data['error']="<div class='alert alert-danger'>"
								."Username atau Password salah!"
						  ."</div>";
				$this->load->view('admin_vw/meta_admin');
				$this->load->view('admin_vw/js_admin');
				$this->load->view('admin_vw/navbar_admin');
				$this->load->view('admin_vw/login_admin',$data);
			}else{
				$user = array('login'	=> true,
							  'no'		=> $login[0]->no,
							  'id_user' => $login[0]->id_user,
							  'level'	=> $login[0]->level,
				);
				$this->session->set_userdata($user);
				header("Location:".base_url('admin'));
			}		
		}
	}
}