<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
			parent::__construct();
			if ($this->session->userdata('level')=='admin') {
				header("Location:admin");
			}
			$this->load->model('data');
	}
	private function load_menu($data=array()){
		$this->load->view('user_vw/meta');
		$this->load->view('user_vw/js');
		$kirim['itemcart']=$this->cart->total_items();
		$this->load->view('user_vw/navbar',$kirim);
		$this->load->view('user_vw/paketmenu',$data);
		$this->load->view('user_vw/footer');

	}
	public function index(){
		//load data menu
		$data['menu']=$this->data->get_menu_rand();
		$this->load->view('user_vw/meta');
		$this->load->view('user_vw/js');
		$kirim['itemcart']=$this->cart->total_items();
		$this->load->view('user_vw/navbar',$kirim);
		$this->load->view('user_vw/home',$data);
		$this->load->view('user_vw/footer');
	}
	public function menu(){
		//load data menu
		$data['menu']=$this->data->get_menu(12,0);
		//first paging
		$data['count']=12;
		$this->load->view('user_vw/meta');
		$this->load->view('user_vw/js');
		$kirim['itemcart']=$this->cart->total_items();
		$this->load->view('user_vw/navbar',$kirim);
		$this->load->view('user_vw/menu',$data);
		$this->load->view('user_vw/footer');
		
	}
	public function load_more($lastid,$limit){
		$data=$this->data->get_menu($limit, $lastid);
		foreach ($data as $menu) {
			echo "<div class='menu col-xs-6 col-sm-3'>"
				    ."<div class='thumbnail'>"
				      ."<img class='img-responsive' src='".$menu->pic."' alt='test'>"
				      ."<div class='caption'>"
				        ."<h4 style='height:30px'>".$menu->nama."</h4>"
				        ."<p class='ket' style='height:100px'>".$menu->keterangan."</p>"
				        ."<h5>Rp. ".number_format($menu->harga, 0, '','.').',-'."</h5>"
				        ."<p class='text-center'>"
				            ."<a href='".'tambah-cart?id='.$menu->kd_menu.'&nm='.$menu->nama.'&hrg='.$menu->harga."' class='btn btn-warning btn-sm btn-style'>"
				             ."<span class='glyphicon glyphicon-shopping-cart'></span> Pesan Sekarang"
				            ."</a>"
				        ."</p>"
				      ."</div>"
				    ."</div>"
				  ."</div>";
		}
	}
	public function paket_menu($paket){
		switch ($paket) {
			case 'pagi':
				$data['menu'] =$this->data->get_menu_pagi();
				$data['jenis']="Paket Pagi";
				$this->load_menu($data);
				break;
			case 'siang':
				$data['menu'] =$this->data->get_menu_siang();
				$data['jenis']="Paket Siang";
				$this->load_menu($data);
				break;
			case 'malam':
				$data['menu'] =$this->data->get_menu_malam();
				$data['jenis']="Paket Malam";
				$this->load_menu($data);
				break;
			case 'ekonomis':
				$data['menu'] =$this->data->get_menu_ekonomis();
				$data['jenis']="Paket Ekonomis";
				$this->load_menu($data);
				break;
			default:
				echo "null exception";
				break;
		}
	}
	public function view_profile(){
			if ($this->session->userdata("login")!=true) {
				header("Location:halaman-login.html");
			}else{
				$this->load->view('user_vw/meta');
				$this->load->view('user_vw/js');
				$kirim['itemcart']=$this->cart->total_items();
				$this->load->view('user_vw/navbar',$kirim);
				if ($this->data->cek_data_diri($this->session->userdata('id_user'))) {
					$data['datadiri']=$this->data->get_data_diri($this->session->userdata('id_user'));
					$this->load->view('user_vw/profile_form',$data);
				}else{
					$this->load->view('user_vw/profile_form');
				}
				$this->load->view('user_vw/footer');
			}
	}
	public function panduan(){
		$this->load->view('user_vw/meta');
		$this->load->view('user_vw/js');
		$kirim['itemcart']=$this->cart->total_items();
		$this->load->view('user_vw/navbar',$kirim);
		$this->load->view('user_vw/panduan');
		$this->load->view('user_vw/footer');
	}
}