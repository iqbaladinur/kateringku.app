<?php
class Logout extends CI_Controller{
	public function index(){
		$loginLevel = $this->session->userdata("level");
		$this->session->sess_destroy();
		if($loginLevel === "admin")
			header("Location:".base_url('login'));
		else
			header("Location:".base_url());
	}
} 