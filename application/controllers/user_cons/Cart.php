<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
	public function __construct(){
			parent::__construct();
			error_reporting(E_ALL ^ (E_NOTICE));
			$this->load->model('data');
			$this->load->library('table');
	}
	//cart
	public function add_to_cart(){
		//from table menu
		$id		=$this->input->get('id');
		$name	=$this->input->get('nm');
		$price	=$this->input->get('hrg');
		if (empty($id) or empty($name) or empty($price)) {
			echo "this exception";
		}else{
			$data = array(
		        'id'      => $id,
		        'qty'     => 1,
		        'price'   => $price,
		        'name'    => $name,
		        'options' => array('pic' => $this->data->get_menu_pic($id))
			);
			$this->cart->insert($data);
			$this->view_cart();
		}
	}
	public function remove_from_cart(){
			$rowid=$this->input->get('rowid');
			$data = array(
				'rowid' => $rowid,
        		'qty'   => 0
			);
			$this->cart->update($data);
			$this->view_cart();
	}
	public function update_cart(){
			$rowid=$this->input->get('rowid');
			$qty  =$this->input->get('qty');
			$data = array(
				'rowid' => $rowid,
        		'qty'   => $qty
			);
			$this->cart->update($data);
			$this->view_cart();
	}
	public function view_cart(){
		$kirim['itemcart']=$this->cart->total_items();
		$kirim['total_harga']=$this->cart->total();
		$this->load->view('user_vw/meta');
		$this->load->view('user_vw/js');
		$this->load->view('user_vw/navbar',$kirim);
		$this->table->set_heading('No', 'Nama Menu', 'Qty', 'Total Harga', 'Update');
		$no=1;
		if ($this->cart->contents()==NULL) {
			$this->table->add_row("<p style='text-align:center'>Keranjang Kosong</p>");
			$template = array(
			        'table_open'            => "<table class='table table-striped table-hover'>",
			        'thead_open'            => '<thead style="text-align:center; vertical-align:middle"">',
			        'thead_close'           => '</thead>',
			        'heading_row_start'     => '<tr>',
			        'heading_row_end'       => '</tr>',
			        'heading_cell_start'    => '<th style="text-align:center; vertical-align:middle">',
			        'heading_cell_end'      => '</th>',
			        'tbody_open'            => '<tbody>',
			        'tbody_close'           => '</tbody>',
			        'row_start'             => '<tr>',
			        'row_end'               => '</tr>',
			        'cell_start'            => '<td colspan="5">',
			);
		}else{
			//data
			foreach ($this->cart->contents() as $items) {
				
				$this->table->add_row(
					$no,
					$items['name'],
					"<input type='text' name='rowid' class='hidden col-xs-offset-5 col-xs-2' value='".$items['rowid']."'>".
					"<input onChange='active_button.call(this)' name='qty' class='col-xs-offset-4 col-xs-4' type='number' value='".$items['qty']."'>",
					'Rp. '.number_format($items['qty']*$items['price'], 0, '','.').',-',
					"<button type='submit' style='margin-top:0px' class='disabled btn btn-warning btn-sm btn-style'>"
						."<span class='glyphicon glyphicon-refresh'></span> perbaharui"
					."</button></form>"
					."<a href='hapus-cart?rowid=".$items['rowid']."' style='margin-top:0px' class='btn btn-danger btn-sm btn-style'>"
						."<span class='glyphicon glyphicon-trash'></span> hapus"
					."</a>"
				);
				$no++;
			}
			//theme
			$template = array(
		        'table_open'            => "<table class='table table-striped table-hover'>",
		       	'thead_open'            => '<thead style="text-align:center; vertical-align:middle">',
		        'thead_close'           => '</thead>',
		        'heading_row_start'     => '<tr>',
		        'heading_row_end'       => '</tr>',
		        'heading_cell_start'    => '<th style="text-align:center; vertical-align:middle">',
		        'heading_cell_end'      => '</th>',
		        'tbody_open'            => '<tbody>',
		        'tbody_close'           => '</tbody>',
		        'row_start'             => "<form action='perbaharui-cart' method='GET'><tr>",
		        'row_end'               => '</tr>',
		        'cell_start'            => '<td style="text-align:center; vertical-align:middle">',
		        'cell_end'              => '</td>',
		        'row_alt_start'         => "<form action='perbaharui-cart' method='GET'><tr>",
		        'row_alt_end'           => '</tr>',
		        'cell_alt_start'        => '<td style="text-align:center; vertical-align:middle">',
		        'cell_alt_end'          => '</td>',
		        'table_close'           => '</table>'
			);
		}
		$this->table->set_template($template);
		$kirim['table']=$this->table->generate();
		$this->load->view('user_vw/cart',$kirim);
		$this->load->view('user_vw/footer');
		
	}
}