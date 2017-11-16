<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {
	public function __construct(){
			parent::__construct();
			$this->load->model('data');
			$this->load->helper('form');
			$this->load->library('form_validation');
	}
	public function index(){
		// validasi form
		$this->form_validation->set_rules('id_user', 'User Id', 'trim|required|is_unique[user.id_user]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('notelp', 'Nomor Telpon', 'trim|required|max_length[15]');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|max_length[16]');
		$this->form_validation->set_rules('repwd', 're-Password', 'trim|required');

		$id_user	=$this->input->post('id_user');
		$email  	=$this->input->post('email');
		$no_telp	=$this->input->post('notelp');
		$password	=$this->input->post('pwd');
		$repassword	=$this->input->post('repwd');

		if ($this->form_validation->run() == FALSE){
				 	$pass['error']="<div class='alert alert-danger col-sm-11'>
				 	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".validation_errors()."</div>";
				 	$this->load->view('user_vw/meta');
				 	$this->load->view('user_vw/js');
					$kirim['itemcart']=$this->cart->total_items();
					$this->load->view('user_vw/navbar',$kirim);
					$this->load->view('user_vw/daftar',$pass);
					$this->load->view('user_vw/footer');
					
			}else{

				if ($password==$repassword) {
					//masuk database
					$data = array('id_user' =>$id_user , 
					  		  'email'   =>$email,
							  'password'=>md5($password));
					$data2= array('id_user' =>$id_user,
								  'no_telp' =>$no_telp,
								  'profile' =>'asset/img/profile.png'
								  );
					$this->data->insert_into($data,'user');
				 	$this->data->insert_into($data2,'user_data');
				 	//load success view
				 	$this->load->view('user_vw/meta');
				 	$this->load->view('user_vw/js');
				 	$kirim['itemcart']=$this->cart->total_items();
				 	$this->load->view('user_vw/navbar',$kirim);
				 	$this->load->view('user_vw/success');
				 	$this->load->view('user_vw/footer');
				 	
				}else{
					$pass['error']="<div class='alert alert-danger col-sm-11'>re-Password salah!</div>";
					$this->load->view('user_vw/meta');
					$this->load->view('user_vw/js');
					$kirim['itemcart']=$this->cart->total_items();
					$this->load->view('user_vw/navbar',$kirim);
					$this->load->view('user_vw/daftar',$pass);
					$this->load->view('user_vw/footer');
					
				}
			}
	}
	public function daftar(){
		if ($this->session->userdata('login')==true) {
			header("location:/".base_url());
		}
		//daftar link
		$pass['error']="";
		$this->load->view('user_vw/meta');
		$this->load->view('user_vw/js');
		$kirim['itemcart']=$this->cart->total_items();
		$this->load->view('user_vw/navbar',$kirim);
		$this->load->view('user_vw/daftar',$pass);
		$this->load->view('user_vw/footer');
		
	}
	public function isi_data_diri(){
		
		$this->form_validation->set_rules('id_user', 'Nama Pengguna', 'trim|is_unique[user.id_user]');
		$this->form_validation->set_rules('nama', 'Nama Asli', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('kd_pos', 'Kode Pos', 'trim|required|max_length[10]');
	
		$photo=$this->input->post("photo");
		$id_user=$this->input->post("id_user");
		$email=$this->input->post("email");
		$nama=$this->input->post("nama");
		$alamat=$this->input->post("alamat");
		$kd_pos=$this->input->post("kd_pos");

		if ($this->form_validation->run() == FALSE){
			$pass['error']="<div class='alert alert-danger col-sm-offset-1 col-sm-11'>"
				 	         ."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".validation_errors()
				 		   ."</div>";
			if ($this->data->cek_data_diri($this->session->userdata('id_user'))) {
					$pass['datadiri']=$this->data->get_data_diri($this->session->userdata('id_user'));
			}
			$this->load->view('user_vw/meta');
			$this->load->view('user_vw/js');
			$kirim['itemcart']=$this->cart->total_items();
			$this->load->view('user_vw/navbar',$kirim);
			$this->load->view('user_vw/profile_form',$pass);
			$this->load->view('user_vw/footer');
		}else{
				//update profile table user
				if (!empty($id_user)){
					$user['id_user']=$id_user;
					$user_data['id_user']=$id_user;
					$this->data->update_profile($user,'user','no',$this->session->userdata('no'));
					$this->data->update_profile($user_data,'user_data','id_user',$this->session->userdata('id_user'));
					$newses = array('id_user'	=> $id_user);
					$this->session->set_userdata($newses);

				}
				if (!empty($email)){
					$user['email']=$email;
					$this->data->update_profile($user,'user','no',$this->session->userdata('no'));
					$newses = array('email'	=> $email);
					$this->session->set_userdata($newses);	
				}

				$config['allowed_types']        = 'jpg|png|JPG|PNG';
	            $config['max_size']             = 500;
	            $config['upload_path']          = './asset/profile-pic';
	 			$config['file_name']            = $this->session->userdata('id_user');
	 			$this->load->library('upload', $config);
                if ($this->upload->do_upload('photo')){
                	$userdata['profile']='asset/profile-pic/'.$this->upload->data()['file_name'];
                	$newses =array('profile'=>$userdata['profile']);
                	$this->session->set_userdata($newses);
                }else{
                	$lala['upload']="<p class='text-danger'>upload gagal!</p>";
                }

                $userdata['nama']=$nama;
                $userdata['alamat']=$alamat;
                $userdata['kd_pos']=$kd_pos;
                if (!empty($id_user)) {
                	$this->data->update_profile($userdata,'user_data','id_user',$id_user);	
                }else{
                	$this->data->update_profile($userdata,'user_data','id_user',$this->session->userdata('id_user'));
                }
                if ($this->data->cek_data_diri($this->session->userdata('id_user'))) {
					$lala['datadiri']=$this->data->get_data_diri($this->session->userdata('id_user'));
				}
				$lala['error']="<div class='alert alert-success col-sm-offset-1 col-sm-11'>"
				 	         ."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
				 	         ."Data berhasil disimpan"
				 		   ."</div>";
				$this->load->view('user_vw/meta');
				$this->load->view('user_vw/js');
				$kirim['itemcart']=$this->cart->total_items();
				$this->load->view('user_vw/navbar',$kirim);
				$this->load->view('user_vw/profile_form',$lala);
				$this->load->view('user_vw/footer');
                
		}

	}
}