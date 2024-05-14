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
$route['default_controller'] = 'beranda';
$route['404_override'] = 'error/page_not_found';
$route['auth'] = 'login';
$route['login/cek_login'] = 'login/login_pengguna';
$route['resetpasswords'] = 'lupapassword';
$route['resetpassword/kirim'] = 'lupapassword/lupa_password';
$route['cekkendaraan'] = 'beranda/kendaraan';
$route['liveuji'] = 'beranda/statusuji';
$route['cekuji'] = 'beranda/cekuji';
$route['ceksrt'] = 'beranda/ceksurat';
$route['info/pendaftaran'] = 'beranda/pendaftaran';
$route['info/retribusi'] = 'beranda/retribusi';
$route['bookingonline'] = 'beranda/booking';
$route['prosesbooking'] = 'beranda/prosesbooking';
$route['bookingonline/cek'] = 'beranda/cekantrian';
$route['bookingonline/kendaraan'] = 'beranda/get_kendaraan';
$route['bookingonline/sukses'] = 'beranda/booking_sukses';
$route['bookingonline/cetak'] = 'beranda/cetak_booking';
$route['bookingonline/cari'] = 'beranda/cari_booking';
$route['bookingonline/biaya'] = 'beranda/cekbiaya';
$route['bookingonline/getkendaraan'] = 'beranda/cekkendaraan';
$route['bookingonlinemobile'] = 'beranda/bookingmobile';
$route['cekkendaraanmobile'] = 'beranda/datakendaraan';
$route['informasimobile'] = 'beranda/informasimobile';
$route['webhook'] = 'app/webhook';
$route['formikm'] = 'app/formikm';
$route['prosesformikm'] = 'app/prosesikm';
$route['surveyikm'] = 'app/surveyikm';
$route['resendpendaftaran'] = 'beranda/kirimnotif_ulang';
$route['notifikasihabisuji'] = 'whatsapp/notifhabis';
$route['notifikasiuji'] = 'whatsapp/notifuji';
$route['translate_uri_dashes'] = FALSE;
