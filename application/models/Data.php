<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
class Data extends CI_Model{
	function insert_into($data=array(),$tablename){
		$this->db->insert($tablename,$data);
	}
	function user_login($key,$password){
	   $this->db-> select('u.no, u.id_user,u.email, u.level, d.profile');
	   $this->db-> from('user as u');
	   $this->db-> join('user_data as d','u.id_user=d.id_user');
	   $this->db-> where('email', $key);
	   $this->db-> where('password', MD5($password));
	   $this->db-> limit(1);
	   $query=$this->db->get();
	   if($query -> num_rows() == 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	}

	// get data menu random in
	function get_menu_rand(){
		return $this->db->query("SELECT m.* FROM menu m JOIN (SELECT kd_menu FROM menu WHERE RAND() < (SELECT ((4 / COUNT(*)) * 10) FROM menu) ORDER BY RAND()
						  LIMIT 4) AS z ON z.kd_menu = m.kd_menu")->result();
	}
	// data lihat menu
	function get_menu($limit,$last_id){
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->limit($limit);
		$this->db->offset($last_id);
		$query=$this->db->get();
		return $query->result();
	}
	// select data menu pagi
	function get_menu_pagi(){
		return $this->db->query("SELECT m.* FROM menu m JOIN (SELECT kd_menu FROM menu WHERE RAND() < (SELECT ((8 / COUNT(*)) * 10) FROM menu) ORDER BY RAND()
						  LIMIT 8) AS z ON z.kd_menu = m.kd_menu")->result();
	}
	// select data menu siang
	function get_menu_siang(){
		return $this->db->query("SELECT m.* FROM menu m JOIN (SELECT kd_menu FROM menu WHERE RAND() < (SELECT ((8 / COUNT(*)) * 10) FROM menu) ORDER BY RAND()
						  LIMIT 8) AS z ON z.kd_menu = m.kd_menu")->result();
	}
	// select data menu malam
	function get_menu_malam(){
		return $this->db->query("SELECT m.* FROM menu m JOIN (SELECT kd_menu FROM menu WHERE RAND() < (SELECT ((8 / COUNT(*)) * 10) FROM menu) ORDER BY RAND()
						  LIMIT 8) AS z ON z.kd_menu = m.kd_menu")->result();
	}
	// select data menu ekonomis
	function get_menu_ekonomis(){
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->where('harga <=',10000);
		$this->db->limit(8);
		$query=$this->db->get();
		return $query->result();
	}
	//take menu picture
	function get_menu_pic($kd_menu){
		$this->db->select('pic');
		$this->db->from('menu');
		$this->db->where('kd_menu',$kd_menu);
		$query=$this->db->get();
		$url=$query->result();
		return $url[0]->pic;
	}
	//cekprofile
	function cek_data_diri($id_user){
		$this->db->select('nama, alamat, kd_pos');
		$this->db->from('user_data');
		$this->db->where('id_user',$id_user);
		$result=$this->db->get()->result();
		if (is_null($result[0]->nama) or is_null($result[0]->alamat) or is_null($result[0]->kd_pos)) {
			return false;
		}else{
			return true;
		}
	}
    function update_profile($data,$table,$selector,$selectorvalue){
    	if ($this->db->update($table, $data, array($selector => $selectorvalue))) {
    		return true;
    	}else{
    		return false;
    	}
    }
    function get_data_diri($id_user){
    	$this->db->select('nama, alamat, kd_pos');
    	$this->db->from('user_data');
    	$this->db->where('id_user',$id_user);
    	return $this->db->get()->result();
    }
    function get_riwayat_pesanan($id_user,$limit,$offset){
    	$this->db->select("t.id, t.no_pesanan, t.tgl_pesan, t.tgl_ambil, t.status_pesanan, t.status_pembayaran, t.metode_pengambilan, t.qty, t.harga_total, m.nama");
    	$this->db->from('tpesanan as t');
    	$this->db->join('menu as m', 't.kd_menu=m.kd_menu');
    	$this->db->where('id_user',$id_user);
    	$this->db->offset($offset);
    	$this->db->limit($limit);
    	$this->db->order_by('tgl_pesan','DESC');
    	return $this->db->get()->result();
    }
    function count_data_pesanan($id_user){
    	$this->db->select('count(id) as row');
    	$this->db->from('tpesanan');
    	$this->db->where('id_user',$id_user);
    	$data=$this->db->get()->result();
    	return $data[0]->row;
    }
    function cek_no_pesanan($no_pesanan){
    	$this->db->select('no_pesanan');
    	$this->db->from('tpesanan');
    	$this->db->where('no_pesanan',$no_pesanan);
    	if ($this->db->get()->num_rows()>0) {
    		return true;
    	}else{
    		return false;
    	}
    }
}