<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//user Routes
$route['home.html']='user_cons/user';
$route['panduan.html']='user_cons/user/panduan';
$route['halaman-daftar.html']='user_cons/registrasi';
$route['halaman-login.html']='user_cons/login';
$route['daftar.html']='user_cons/registrasi/daftar';
$route['login.html']='user_cons/login/auth';
$route['logout.html']='Logout';
$route['paket-pagi.html']='user_cons/user/paket_menu/pagi';
$route['paket-siang.html']='user_cons/user/paket_menu/siang';
$route['paket-malam.html']='user_cons/user/paket_menu/malam';
$route['paket-ekonomis.html']='user_cons/user/paket_menu/ekonomis';
$route['tambah-cart']='user_cons/cart/add_to_cart';
$route['hapus-cart']='user_cons/cart/remove_from_cart';
$route['perbaharui-cart']='user_cons/cart/update_cart';
$route['lihat-keranjang.html']='user_cons/cart/update_cart';
$route['proses_pesanan.html']='user_cons/order/proses_pesanan';
$route['update-data-diri.html']='user_cons/registrasi/isi_data_diri';
$route['edit_profile.html']='user_cons/user/view_profile';
$route['prosesed.html']='user_cons/order/record_pesanan';
$route['lihat-pesanan']='user_cons/order/lihat_pesanan';
$route['lihat-menu.html']='user_cons/user/menu';
$route['upload-bukti-pembayaran.html']='user_cons/order/bukti_pembayaran_form';
$route['upload-tiket.html']='user_cons/order/bukti_pembayaran_proses';

$route['administrator/login.html']='login';

