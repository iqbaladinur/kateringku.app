<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
			parent::__construct();
			if ($this->session->userdata('login')==true) {
				header("Location:/".base_url());
			}
			$this->load->model('data');
			
			$this->load->library('form_validation');
	}
	public function index(){
			//login page if error catching
			$pass['error']="<div class='alert alert-danger col-sm-11'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Silahkan login terlebih dahulu</div>";
			$this->load->view('user_vw/meta');
			$this->load->view('user_vw/js');
			$kirim['itemcart']=$this->cart->total_items();
			$this->load->view('user_vw/navbar',$kirim);
			$this->load->view('user_vw/login',$pass);
			$this->load->view('user_vw/footer');
	}
	public function auth(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$pass['error']="<div class='alert alert-danger col-sm-11'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".validation_errors()."</div>";
			$this->load->view('user_vw/meta');
			$this->load->view('user_vw/js');
			$kirim['itemcart']=$this->cart->total_items();
			$this->load->view('user_vw/navbar',$kirim);
			$this->load->view('user_vw/login',$pass);
			$this->load->view('user_vw/footer');
			
		}else{
			$email   =$this->input->post('email');
			$password=$this->input->post('pwd');
			$data=$this->data->user_login($email,$password);
			if ($data==false) {
				//load login view
				$pass['error']="<div class='alert alert-danger col-sm-11'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password atau email salah, silahkan cek kembali!</div>";
				$this->load->view('user_vw/meta');
				$this->load->view('user_vw/js');
				$kirim['itemcart']=$this->cart->total_items();
				$this->load->view('user_vw/navbar',$kirim);
				$this->load->view('user_vw/login',$pass);
				$this->load->view('user_vw/footer');
				
			}else{
				$user = array('login'	=> true,
							  'email'	=> $data{0}->email,
							  'no'		=> $data{0}->no,
							  'id_user' => $data{0}->id_user,
							  'level'	=> $data{0}->level,
							  'profile' => $data{0}->profile
				);
				$this->session->set_userdata($user);
				header("Location:home.html");
			}
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		header("Location:home.html");
	}
}