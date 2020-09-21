<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
			parent::__construct();
			if ($this->session->userdata('level')!='admin') {
				header("Location:".base_url());
			}
			$this->load->model('admin_data');
	}

	/*view controller for dashboard*/
	public function index(){
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$data['jml_menu']	=$this->admin_data->getcount_menu();
		$data['jml_usr']	=$this->admin_data->getcount_data_pengguna();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/home_admin');
		$this->load->view('admin_vw/tambah_menu_admin');
		$this->load->view('admin_vw/jscon_admin');
	}

	/*
	###view controller for pesanan masuk
	*/
	public function pesanan_masuk(){
		$limit=30;
		$total_rows=$this->admin_data->getcount_pesanan_masuk();
		$paging_url=base_url('admin/pesanan_masuk?');
		$page=$this->paging($this->input->get('per_page'),$limit,$total_rows,$paging_url);
		$data['pesanan']=$this->admin_data->get_pesanan_masuk($limit,$page['page']);
		$data['link']=$page['link'];
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/pesanan_masuk_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	public function search_pesanan_masuk(){
		$no_pesanan=$this->input->get('no_pesanan');
		$data['pesanan']=$this->admin_data->get_search_pesanan($no_pesanan);
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/pesanan_masuk_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	public function update_status_pesanan(){
		$no_pesanan=$this->input->get('no');
		$status_pembayaran=$this->input->get('stat_bayar');
		$status_pesanan=$this->input->get('stat_kerja');
		if (!empty($no_pesanan) or !empty($status_pembayaran) or !empty($status_pesanan)) {
			$data = array('status_pesanan' => $status_pesanan ,'status_pembayaran' => $status_pembayaran );
			$update=$this->admin_data->get_update_pesanan($data,$no_pesanan);
			if ($status_pembayaran==1){
				if ($this->admin_data->is_aleady_exis($no_pesanan)==false) {
					$total_bayar=$this->admin_data->get_total_price($no_pesanan);
					$modal=$total_bayar-(25/100*$total_bayar);
					$keuntungan=25/100*$total_bayar;
					$penjualan['no_pesanan']=$no_pesanan;
					$penjualan['tgl_masukan']=date("Y-m-d");
					$penjualan['modal']=$modal;
					$penjualan['keuntungan']=$keuntungan;
					$this->admin_data->tambah_data_penjualan($penjualan);
				}
			}
			if ($update) {
				header("Location:".base_url('admin/pesanan_masuk'));
			}else{
				header("Location:".base_url('admin/pesanan_masuk?error=gagal_update!'));
			}
		}else{
			header("Location:".base_url('admin/pesanan_masuk?error=gagal_update!'));
		}
		
	}
	/*use by ajax*/
	public function lihat_detail_pesanan($no){
		$data=$this->admin_data->getdetail_pesanan($no);
		$pengambilan=($data[0]->metode_pengambilan==0)?'Ambil Sendiri':'Antar';
		$no_pesanan=$no;
		$id_user=$this->input->get("id_user");
		$user=$this->admin_data->get_nama_user($id_user);
		$total=0;
		echo "<table class='table table-stripped table-hover'>"
                ."<tr>"
                	."<td>"
                		."Nomor Pesanan"
                	."</td>"
                	."<td>"
                		.$no_pesanan
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Atas Nama"
                	."</td>"
                	."<td class='text-capitalize'>"
                		.$user[0]->nama
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Alamat"
                	."</td>"
                	."<td class='text-capitalize'>"
                		.$user[0]->alamat
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Kode POS"
                	."</td>"
                	."<td class=''>"
                		.$user[0]->kd_pos
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Pengambilan"
                	."</td>"
                	."<td class=''>"
                		.$pengambilan
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Pesanan"
                	."</td>"
                	."<td class=''>";
        foreach ($data as $pesanan) {
        	echo $pesanan->nama." x ".$pesanan->qty.' bks<br>';
        }
        	echo "</td></tr>"
	        	."<tr>"
                	."<td>"
                		."Total Harga"
                	."</td>"
                	."<td class=''>";
        foreach ($data as $pesanan) {
        	$total+=$pesanan->harga_total;
        }
        	echo "Rp. ".number_format($total, 0, '','.').',-';
    	echo "</td></tr></table>";

	}

	/*use by ajax*/
	public function delete_pesanan($no_pesanan){
		echo $this->admin_data->delete_pesanan($no_pesanan);
	}


	/*
	###view controller for konfirmasi pesanan
	*/
	public function konfirmasi_pesanan(){
		$limit=30;
		$total_rows=$this->admin_data->getcount_pesanan_masuk();
		$paging_url=base_url('admin/pesanan_masuk?');
		$page=$this->paging($this->input->get('per_page'),$limit,$total_rows,$paging_url);
		$data['konfirmasi']=$this->admin_data->get_data_konfirmasi($limit,$page['page']);
		$data['link']=$page['link'];
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/konfirmasi_pesanan_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	/*search data konfirmasi pesanan*/
	public function search_konfirmasi_pesanan(){
		$no_pesanan=$this->input->get('no_pesanan');
		$data['konfirmasi']=$this->admin_data->getsearch_data_pembayaran($no_pesanan);
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/konfirmasi_pesanan_admin');
		$this->load->view('admin_vw/jscon_admin');
	}

	/*delete konfirmasi pesanan ajax*/
	public function delete_konfirmasi_pesanan($id){
		$path=$this->input->get('path');
		if (!empty($path)) {
			if (unlink($path)) {
        		echo $this->admin_data->delete_konfirmasi($id);
	      	}else{
	        	echo false;
	      	}
		}else
			echo false;	
	}
	/*update konfirmasi pesanan*/
	public function periksa_konfirmasi_pesanan($id){
		echo $this->admin_data->update_konfirmasi($id);
	}

	/*
	###view controller for Riwayat bukti pembayaran
	*/
	public function riwayat_konfirmasi_pesanan(){
		$limit=30;
		$total_rows=$this->admin_data->getcount_pesanan_masuk();
		$paging_url=base_url('admin/pesanan_masuk?');
		$page=$this->paging($this->input->get('per_page'),$limit,$total_rows,$paging_url);
		$data['konfirmasi']=$this->admin_data->get_data_pembayaran($limit,$page['page']);
		$data['link']=$page['link'];
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/konfirmasi_pesanan_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	/*search data konfirmasi pesanan*/
	public function search_riwayat_konfirmasi_pesanan(){
		$no_pesanan=$this->input->get('no_pesanan');
		$data['konfirmasi']=$this->admin_data->getsearch_data_pembayaran($no_pesanan);
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/konfirmasi_pesanan_admin');
		$this->load->view('admin_vw/jscon_admin');
	}

	/*delete konfirmasi pesanan ajax*/
	public function delete_riwayat_konfirmasi_pesanan($id){
		$path=$this->input->get('path');
		if (!empty($path)) {
			if (unlink($path)) {
        		echo $this->admin_data->delete_konfirmasi($id);
	      	}else{
	        	echo false;
	      	}
		}else
			echo false;	
	}
	/*update konfirmasi pesanan*/
	public function periksa_riwayat_konfirmasi_pesanan($id){
		echo $this->admin_data->update_konfirmasi($id);
	}

	/*
	 *view controller for kelola menu
	 */

	public function kelola_menu(){
		$limit=30;
		$total_rows=$this->admin_data->getcount_menu();
		$paging_url=base_url('admin/kelola_menu?');
		$page=$this->paging($this->input->get('per_page'),$limit,$total_rows,$paging_url);
		$data['menu']=$this->admin_data->get_data_menu($limit,$page['page']);
		$data['link']=$page['link'];
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/menu_admin');
		$this->load->view('admin_vw/tambah_menu_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	public function search_menu(){
		$nama_menu=$this->input->get('nm_menu');
		$data['menu']=$this->admin_data->get_search_menu($nama_menu);
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/menu_admin');
		$this->load->view('admin_vw/tambah_menu_admin');
		$this->load->view('admin_vw/jscon_admin'); 
	}
	public function tambah_menu(){
		$nama_menu =$this->input->post('nama_menu', true);
		$keterangan=$this->input->post('ket_menu', true);
		$harga_menu=$this->input->post('harga_menu', true);
		if (empty($harga_menu) or empty($harga_menu) or empty($keterangan)) {
			header("Location:".base_url('admin/kelola_menu?error=gagal menambah menu'));
		}else{
			$data['nama']=$nama_menu;
			$data['keterangan']=$keterangan;
			$data['harga']=$harga_menu;
			$config['allowed_types']        = 'jpg|jpeg|JPG|JPEG|PNG|png';
	        $config['max_size']             = 2000;
	        $config['upload_path']          = './asset/menu-pic';
	 		$config['file_name']            = $nama_menu.date('yyyy-mm-dd');	 		
	 		$this->load->library('upload', $config);
	 		if ($this->upload->do_upload('picture')){
	 			$data['pic']='asset/menu-pic/'.$this->upload->data()['file_name'];
	 			$this->admin_data->tambah_menu($data);
	 			header("Location:".base_url('admin/kelola_menu'));
	 		}else{
	 			header("Location:".base_url('admin/kelola_menu?error=gagal menambah menu'));
	 		}
		}
	}
	public function delete_menu($kd_menu){
		$path=$this->admin_data->select_pic($kd_menu);
		if (!empty($path)) {
			if (unlink($path)) {
        		echo $this->admin_data->delete_data_menu($kd_menu);
	      	}else{
	        	echo false;
	      	}
		}else
			echo false;	
	}

	/*use by ajax*/
	public function lihat_detail_menu($kd_menu){
		$data=$this->admin_data->get_detail_menu($kd_menu);
		echo "<img style='max-height:20%;max-width:20%' src='".base_url($data[0]->pic)."'></img><br><br>";
		echo "<table class='table table-stripped table-hover'>"
                ."<tr>"
                	."<td>"
                		."Kode Menu"
                	."</td>"
                	."<td>"
                		.$kd_menu
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Nama Menu"
                	."</td>"
                	."<td class='text-left'>"
                		.$data[0]->nama
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Keterangan Menu"
                	."</td>"
                	."<td class='text-left'>"
                		.$data[0]->keterangan
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Harga"
                	."</td>"
                	."<td class=''>"
                		."Rp. ".number_format($data[0]->harga, 0, '','.').',-'
                	."</td>"
                ."</tr>"             
               ."</table>";
	}

	public function update_menu_form($kd_menu){
		$data=$this->admin_data->get_detail_menu($kd_menu);
		echo "<form action='".base_url('admin/update_menu')."' enctype='multipart/form-data' method='POST'>"
	        	."<div class='form-group'>"
	        		."<label>Nama Menu</label>"
	        		."<input name='kd_menu' value='".$data[0]->kd_menu."' class='hidden'>"
	        		."<input value='".$data[0]->nama."'type='text' name='nama_menu' class='form-control input-sm' required>"
	        	."</div>"
	        	."<div class='form-group'>"
	        		."<label>Harga</label>"
	        		."<input value='".$data[0]->harga."' type='number' name='harga_menu' class='form-control input-sm' required>"
	        	."</div>"
	        	."<div class='form-group'>"
	        		."<label>Keterangan Menu (<=100 karakter)</label>"
	        		."<textarea name='ket_menu' class='form-control input-sm' required>".$data[0]->keterangan."</textarea>"
	        	."</div>"
	        	."<div class='form-group'>"
	        		."<label>Picture</label>"
	        		."<input type='file' name='picture' class='form-control input-sm'>"
	        	."</div>"
	        	."<button type='submit' class='btn btn-info'>Update</button>"
	        	." <button type='button' class='btn btn-default' data-dismiss='modal'>batal</button>"
        		."</form>";
	}
	public function update_menu(){
		$kd_menu=$this->input->post('kd_menu', true);
		$nama_menu=$this->input->post('nama_menu', true);
		$harga_menu=$this->input->post('harga_menu', true);
		$keterangan=$this->input->post('ket_menu', true);
		if (!empty($kd_menu)) {
			if (!empty($nama_menu))
				$data['nama']=$nama_menu;
			if (!empty($harga_menu))
				$data['harga']=$harga_menu;
			if (!empty($keterangan)) 
				$data['keterangan']=$keterangan;
			//upload
			$config['allowed_types']        = 'jpg|jpeg|JPG|JPEG|PNG|png';
	        $config['max_size']             = 2000;
	        $config['upload_path']          = './asset/menu-pic';
	 		$config['file_name']            = $nama_menu.date('yyyy-mm-dd');	 		
	 		$this->load->library('upload', $config);
	 		if ($this->upload->do_upload('picture'))
	 			$data['pic']='asset/menu-pic/'.$this->upload->data()['file_name'];
	 		if ($this->admin_data->update_data_menu($data,$kd_menu))
	 			header("Location:".base_url('admin/kelola_menu'));
	 		else
	 			header("Location:".base_url('admin/kelola_menu?error=failed to updae data'));
		}else{
			//error
		}
	}
	/*view controller for data pengguna*/
	public function data_pengguna(){
		$limit=30;
		$total_rows=$this->admin_data->getcount_data_pengguna();
		$paging_url=base_url('admin/data_pengguna?');
		$page=$this->paging($this->input->get('per_page'),$limit,$total_rows,$paging_url);
		$data['pengguna']=$this->admin_data->get_data_pengguna($limit,$page['page']);
		$data['link']=$page['link'];
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/data_pengguna_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	public function search_data_pengguna(){
		$id_user=$this->input->get('id_user');
		$data['pengguna']=$this->admin_data->search_data_pengguna($id_user);
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/data_pengguna_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	public function lihat_detail_pengguna($id_user){
		$data=$this->admin_data->getdetail_data_pengguna($id_user);
		echo "<img style='max-height:20%;max-width:20%' src='".base_url($data[0]->profile)."'></img><br><br>";
		echo "<table class='table table-stripped table-hover'>"
                ."<tr>"
                	."<td>"
                		."User Id"
                	."</td>"
                	."<td>"
                		.$data[0]->id_user
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Email"
                	."</td>"
                	."<td class='text-left'>"
                		.$data[0]->email
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Nama"
                	."</td>"
                	."<td class='text-left'>"
                		.$data[0]->nama
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Level"
                	."</td>"
                	."<td class='text-left'>"
                		.$data[0]->level
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Alamat"
                	."</td>"
                	."<td class='text-left'>"
                		.$data[0]->alamat
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."Kode Pos"
                	."</td>"
                	."<td class='text-left'>"
                		.$data[0]->kd_pos
                	."</td>"
                ."</tr>"
                ."<tr>"
                	."<td>"
                		."No Telpon"
                	."</td>"
                	."<td class='text-left'>"
                		.$data[0]->no_telp
                	."</td>"
                ."</tr>"        
               ."</table>";
	}

	/*view controller for data penjualan*/
	public function data_penjualan(){
		$limit=30;
		$total_rows=$this->admin_data->get_count_data_penjualan();
		$paging_url=base_url('admin/data_pengguna?');
		$page=$this->paging($this->input->get('per_page'),$limit,$total_rows,$paging_url);
		$data['penjualan']=$this->admin_data->get_data_penjualan($page['page'], $limit);
		$data['link']=$page['link'];
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/data_penjualan_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	public function delete_data_penjualan($no_pesanan){
		echo $this->admin_data->delete_data_penjualan($no_pesanan);
	}
	public function update_data_penjualan($no){
		$no=$this->input->get('id');
		$no_pesanan=$this->input->get('no');
		$tgl_masukan=$this->input->get('tgl_masukan');
		$modal=$this->input->get('modal');
		$keuntungan=$this->input->get('keuntungan');
		if (!empty($no)) {
			if (!empty($no_pesanan))
				if (!empty($tgl_masukan))
					$data['tgl_masukan']=$tgl_masukan;
				if (!empty($modal))
					$data['modal']=$modal;
				if (!empty($keuntungan))
					$data['keuntungan']=$keuntungan;
			if ($this->admin_data->update_data_penjualan($data,$no)) 
				header("Location:".base_url("admin/data_penjualan?succes=1"));
			else
				header("Location:".base_url("admin/data_penjualan?error=1"));
		}else{
			header("Location:".base_url("admin/data_penjualan?error=null"));	
		}
	}
	public function search_data_penjualan(){
		$date=$this->input->get('tgl_masuk');
		$limit=30;
		$total_rows=$this->admin_data->get_count_total_search($date);
		$paging_url=base_url('admin/search_data_penjualan?');
		$page=$this->paging($this->input->get('per_page'),$limit,$total_rows,$paging_url);
		$data['penjualan']=$this->admin_data->search_data_penjualan($date,$page['page'],$limit);
		$data['link']=$page['link'];
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/data_penjualan_admin');
		$this->load->view('admin_vw/jscon_admin');
	}
	public function tambah_data_penjualan(){
		$no_pesanan=$this->input->get('no');
		$tgl_masukan=$this->input->get('tgl_masukan');
		$modal=$this->input->get('modal');
		$keuntungan=$this->input->get('keuntungan');
		if (empty($no_pesanan) or empty($tgl_masukan) or empty($modal) or empty($keuntungan)) {
			header("Location:".base_url('admin/data_penjualan?error=1'));
		}else{
			$data['no_pesanan']=$no_pesanan;
			$data['tgl_masukan']=$tgl_masukan;
			$data['modal']=$modal;
			$data['keuntungan']=$keuntungan;
			if ($this->admin_data->tambah_data_penjualan($data)) {
				header("Location:".base_url('admin/data_penjualan'));
			}else{
				header("Location:".base_url('admin/data_penjualan?error=2'));
			}
		}
	}

	/*view controller for laporan penjualan*/
	public function lihat_laporan_penjualan(){
		$month=$this->input->get("bln");
		$year=$this->input->get("tahun");
		if (empty($month) or empty($year)) {
			$month=date("m");
			$year=date("Y");
		}
		$data['penjualan']=$this->admin_data->get_laporan_penjualan($month,$year);
		$data['total_transaksi']=$this->admin_data->total_transaksi_penjualan($month,$year);
		$data['total_keuntungan']=$this->admin_data->total_keuntungan($month,$year);
		$data['total_permodalan']=$this->admin_data->total_permodalan($month,$year);
		$data['jml_psn_msk']=$this->admin_data->getcount_pesanan_masuk();
		$data['jml_knfr_msk']=$this->admin_data->getcount_konfirm();
		$this->load->view('admin_vw/meta_admin');
		$this->load->view('admin_vw/js_admin');
		$this->load->view('admin_vw/navbar_admin');
		$this->load->view('admin_vw/sidebar_admin',$data);
		$this->load->view('admin_vw/laporan_penjualan');
		$this->load->view('admin_vw/jscon_admin');
	}

	/*
	*this method used by many controller view
	*
	*/
	/*paging*/
	public function paging($input,$limit,$total_rows,$base_url){
		if (empty($input))
			$page=0;
		else
			$page=$input;
		$this->load->library('pagination');
		$jml_pesanan=$total_rows;
		$config = array();
		$config["base_url"] = $base_url;
		$config["total_rows"] = $jml_pesanan;
		$config["per_page"] = $limit;
		$config['page_query_string']= TRUE;
		$config['num_links'] = 10;
		$config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
        $config['full_tag_close'] ="</ul>";
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
	    $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
	    $config['next_tag_open'] = "<li>";
	    $config['next_tagl_close'] = "</li>";
	    $config['prev_tag_open'] = "<li>";
	    $config['prev_tagl_close'] = "</li>";
	    $config['first_tag_open'] = "<li>";
	    $config['first_tagl_close'] = "</li>";
	    $config['last_tag_open'] = "<li>";
	    $config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config);
		$data['link']=$this->pagination->create_links();
		$data['page']=$page;
		return $data;
	}



	/*
	*method data view controller pesanan masuk
	*code bellow
	*/
	/*
	*method data view controller konfirmasi pesanan
	*code bellow
	*/

	/*
	*method data view controller kelola menu
	*code bellow
	*/
	/*
	*method data view controller data pengguna
	*code bellow
	*/
	/*
	*method data view controller data penjualan
	*code bellow
	*/
	/*
	*method data view controller laporan penjualan
	*code bellow
	*/
	public function test(){
		
		echo $this->admin_data->total_keuntungan('12','2016')."<br>";
		echo $this->admin_data->total_transaksi_penjualan('12','2016');

	}
	
	
}