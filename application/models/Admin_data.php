<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_data extends CI_Model{
  	/*
  		Login Admin, kumpulan method untuk kasus login user admin 
  	*/

  	/*method login admin*/
  	function admin_login($key,$password){
  	   $this->db-> select('no, id_user, level');
  	   $this->db-> from('user');
  	   $this->db-> where('id_user', $key);
  	   $this->db-> where('password', $password);
  	   $query=$this->db->get();
  	   if($query -> num_rows() == 1){
  		   	if ($query->result()[0]->level=='admin') {
  		   	 	return $query->result();	
  		   	}else{
  		   	 	return false;
  		   	}
  	   }else{
  	     	return false;
  	   }
  	}

  	/*
  		*data pesanan, kumpulan method untuk kasus data pesanan
  	*/

  	/*method hitung pesanan masuk*/
  	function getcount_pesanan_masuk(){
  		$this->db->select('no_pesanan');
  		$this->db->from('tpesanan');
      $this->db->where('status_pembayaran',0);
  		$this->db->group_by('no_pesanan');
  		return $this->db->get()->num_rows();
  	}

  	/*method table pesanan*/
  	function get_pesanan_masuk($limit,$offset){
    	$this->db->select("no_pesanan, id_user, tgl_pesan, tgl_ambil, status_pembayaran, status_pesanan");
    	$this->db->from('tpesanan');
    	$this->db->offset($offset);
    	$this->db->limit($limit);
      $this->db->group_by('no_pesanan');
    	$this->db->order_by('status_pembayaran','ASC');
    	return $this->db->get()->result();
    }

    /*method data pesanan search*/
    function get_search_pesanan($no_pesanan){
    	$this->db->select("no_pesanan, id_user, tgl_pesan, tgl_ambil, status_pembayaran, status_pesanan");
      $this->db->from('tpesanan');
    	$this->db->like('no_pesanan',$no_pesanan);
      $this->db->group_by('no_pesanan');
    	return $this->db->get()->result();
    }
    /*atas nama*/
    function get_nama_user($id_user){
      $this->db->select('nama, alamat, kd_pos');
      $this->db->from('user_data');
      $this->db->where('id_user',$id_user);
      return $this->db->get()->result();
    }
    /*method untuk melihat detail pesanan*/
    function getdetail_pesanan($no_pesanan){
      $this->db->select('d.nama, p.qty, p.harga_total, p.metode_pengambilan');
      $this->db->from('tpesanan as p');
      $this->db->join('menu as d','p.kd_menu=d.kd_menu');
      $this->db->where('no_pesanan',$no_pesanan);
      return $this->db->get()->result();
    }
    function get_total_price($no_pesanan){
      $this->db->select('harga_total');
      $this->db->from('tpesanan');
      $this->db->where('no_pesanan',$no_pesanan);
      $data=$this->db->get()->result();
      $total=0;
      foreach ($data as $a) {
        $total+=$a->harga_total;
      }
      return $total;
    }
    /*method update data pesanan */
  	function get_update_pesanan($data = array(),$no_pesanan){
  		$this->db->where('no_pesanan', $no_pesanan);
  		$this->db->update('tpesanan', $data);
  		$retVal = ($this->db->affected_rows()!=0) ? true : false ;
     	return $retVal;
  		
    }
     	
   	/*method delete data pesanan*/
   	function delete_pesanan($no_pesanan){
   		$this->db->where('no_pesanan',$no_pesanan);
   		$this->db->delete('tpesanan');
   		$retVal = ($this->db->affected_rows()!=0) ? true : false ;
   		return $retVal;
   		
   	}

     	/*
     		*data pengguna
     	*/
     	/*method hitung data pengguna*/
    function getcount_data_pengguna(){
  		$this->db->select('no');
  		$this->db->from('user');
      $this->db->where('level','user');
  		return $this->db->get()->num_rows();
  	}

   	/*method lihat data pengguna*/
   	function get_data_pengguna($limit,$offset){
   		$this->db->select('id_user , email, level');
   		$this->db->from('user');
   		$this->db->where('level','user');
      $this->db->offset($offset);
      $this->db->limit($limit);
   		return $this->db->get()->result();
   	}

    function search_data_pengguna($id_user){
      $this->db->select('id_user , email, level');
      $this->db->from('user');
      $this->db->where('level','user');
      $this->db->like('id_user',$id_user);
      return $this->db->get()->result();
    }

   	/*method lihat data lengkap pengguna*/
   	function getdetail_data_pengguna($id_user){
   		$this->db->select('u.id_user, u.email, u.level, d.nama, d.alamat, d.kd_pos, d.profile, d.no_telp');
   		$this->db->from('user as u');
   		$this->db->join('user_data as d','u.id_user=d.id_user');
   		$this->db->where('u.id_user',$id_user);
   		return $this->db->get()->result();
   	}

   	/*method lihat data admin*/
   	function get_data_admin(){
   		$this->db->select('no, id_user, password, level');
   		$this->db->from('user');
   		$this->db->where('level','admin');
   		return $this->db->get()->result();
   	}

   	/*
		#method kasus data menu
   	*/

   	/*method tambah menu*/
   	function tambah_menu($data){
   		$this->db->insert('menu',$data);
   		$retVal = ($this->db->affected_rows()!=0) ? true : false ;
   		return $retVal;
   	}

   	/*method hitung jumlah menu*/
   	function getcount_menu(){
  		$this->db->select('kd_menu');
  		$this->db->from('menu');
  		return $this->db->get()->num_rows();
	  }

   	/*method lihat detail menu*/
   	function get_detail_menu($kd_menu){
   		$this->db->select('*');
   		$this->db->from('menu');
   		$this->db->where('kd_menu',$kd_menu);
   		$query=$this->db->get();
   		return $query->result();
   	}

   	/*method get data menu*/
   	function get_data_menu($limit, $offset){
   		$this->db->select('kd_menu, nama, harga');
   		$this->db->from('menu');
      $this->db->offset($offset);
      $this->db->limit($limit);
   		$query=$this->db->get();
   		return $query->result();
   	}

    function get_search_menu($nama_menu){
      $this->db->select('kd_menu, nama, harga');
      $this->db->from('menu');
      $this->db->like('nama',$nama_menu);
      $query=$this->db->get();
      return $query->result();
    }

   	/*method update data menu*/
   	function update_data_menu($data=array(),$kd_menu){
   		$this->db->where('kd_menu',$kd_menu);
   		$this->db->update('menu', $data);
   		$retVal = ($this->db->affected_rows()!=0) ? true : false ;
   		return $retVal;
   	}

   	/*method hapus menu*/
   	function delete_data_menu($kd_menu){
   		$this->db->where('kd_menu',$kd_menu);
   		$this->db->delete('menu');
   		$retVal = ($this->db->affected_rows()!=0) ? true : false ;
   		return $retVal;	
   	}	
    /*select pic*/
    function select_pic($kd_menu){
      $this->db->select('pic');
      $this->db->from('menu');
      $this->db->where('kd_menu',$kd_menu);
      return $this->db->get()->result()[0]->pic;
    }	


    /*
    *method kasus konfirmasi pesanan
    */		
    function getcount_konfirm(){
      $this->db->select('id');
      $this->db->from('pembayaran');
      $this->db->where('checked',0);
      return $this->db->get()->num_rows();
    }
    
    /*data konfirmasi*/
    function get_data_konfirmasi($limit, $offset){
      $this->db->select('*');
      $this->db->from('pembayaran');
      $this->db->limit($limit);
      $this->db->offset($offset);
      $this->db->where('checked',0);
      return $this->db->get()->result();
    }

    /*master*/
    function get_data_pembayaran($limit, $offset){
      $this->db->select('*');
      $this->db->from('pembayaran');
      $this->db->limit($limit);
      $this->db->offset($offset);
      $this->db->where('checked',1);
      return $this->db->get()->result();
    }

    /*search*/
    function getsearch_data_pembayaran($no_pesanan){
      $this->db->select('*');
      $this->db->from('pembayaran');
      $this->db->like('no_pesanan',$no_pesanan);
      return $this->db->get()->result();
    }

    /*update*/
    function update_konfirmasi($id){
      $data = array('checked' => 1);
      $this->db->where('id', $id);
      $this->db->update('pembayaran', $data);
      $retVal = ($this->db->affected_rows()!=0) ? true : false ;
      return $retVal;
    }
    /*delete ajx*/ 
    function delete_konfirmasi($id){
      $this->db->where('id',$id);
      $this->db->delete('pembayaran');
      $retVal = ($this->db->affected_rows()!=0) ? true : false ;
      return $retVal;
    }

    /*data Penjualan*/
    function get_data_penjualan($offset, $limit){
      $this->db->select('*');
      $this->db->from('penjualan');
      $this->db->offset($offset);
      $this->db->limit($limit);
      $this->db->order_by('tgl_masukan','DESC');
      return $this->db->get()->result();
    }
    function get_count_data_penjualan(){
      $this->db->select('no');
      $this->db->from('penjualan');
      $this->db->group_by('no_pesanan');
      return $this->db->get()->num_rows();
    }
    function get_count_total_search($date){
      $this->db->select('no');
      $this->db->from('penjualan');
      $this->db->where('tgl_masukan',$date);
      return $this->db->get()->num_rows();
    }
    function tambah_data_penjualan($data = array()){
      $this->db->insert('penjualan',$data);
      $retVal = ($this->db->affected_rows()!=0) ? true : false ;
      return $retVal;
    }
    function update_data_penjualan($data=array(),$no){
      $this->db->where('no',$no);
      $this->db->update('penjualan',$data);
      $retVal = ($this->db->affected_rows()!=0) ? true : false ;
      return $retVal;
    }
    function delete_data_penjualan($no){
      $this->db->where('no_pesanan',$no);
      $this->db->delete('penjualan');
      $retVal = ($this->db->affected_rows()!=0) ? true : false ;
      return $retVal;
    }
    function search_data_penjualan($date, $offset, $limit){
      $this->db->select('*');
      $this->db->from('penjualan');
      $this->db->offset($offset);
      $this->db->limit($limit);
      $this->db->where('tgl_masukan',$date);
      return $this->db->get()->result();
    }
    function is_aleady_exis($no_pesanan){
      $this->db->select("no_pesanan");
      $this->db->from("penjualan");
      if ($this->db->get()->num_rows()>0) {
        return true;
      }else{
        return false;
      }

    }

    /*laporan pejualan perbulan*/
    function get_laporan_penjualan($month,$year){
      $this->db->select('*');
      $this->db->from('penjualan');
      $this->db->where('MONTH(tgl_masukan)',$month);
      $this->db->where('YEAR(tgl_masukan)',$year);
      return $this->db->get()->result();
    }

    function total_transaksi_penjualan($month,$year){
      $this->db->from('penjualan');
      $this->db->where('MONTH(tgl_masukan)',$month);
      $this->db->where('YEAR(tgl_masukan)',$year);
      return $this->db->get()->num_rows();
    }

    function total_keuntungan($month,$year){
      $this->db->select('keuntungan');
      $this->db->from('penjualan');
      $this->db->where('MONTH(tgl_masukan)',$month);
      $this->db->where('YEAR(tgl_masukan)',$year);
      $total=0;
      $keuntungan=$this->db->get()->result();
      foreach ($keuntungan as $a) {
        $total+=$a->keuntungan;
      }
      return $total;
    }

    function total_permodalan($month,$year){
      $this->db->select('modal');
      $this->db->from('penjualan');
      $this->db->where('MONTH(tgl_masukan)',$month);
      $this->db->where('YEAR(tgl_masukan)',$year);
      $total=0;
      $modal=$this->db->get()->result();
      foreach ($modal as $a) {
        $total+=$a->modal;
      }
      return $total;
    }
}