<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['assesment'] = 'assesment';
$route['assesment_edit/(:num)'] = 'assesment/assesment_pekerjaan_edit/$1';
$route['assessment_supplier'] = 'home/assessment_supplier';
$route['summaryachiement'] = 'assesment/summaryachiement';

$route['material_edit/(:num)'] = 'assesment/material_edit/$1';

$route['qsia_admin'] = 'home/qsia_admin';
$route['qsia_detail'] = 'home/qsia_detail';
$route['qsia_add'] = 'qsia/add';

$route['css'] = 'css/index';
$route['css_detail'] = 'home/css_detail';

$route['nc_detail'] = 'home/nc_detail';
$route['list_laporan_detail'] = 'home/list_laporan_detail';
$route['cari_nc'] = 'nc/cari_nc';
$route['list_laporan'] = 'nc/list_laporan';
$route['cari_nc_detail'] = 'nc/cari_nc_detail';

$route['observasi'] = 'home/observasi';
$route['observasi_detail'] = 'home/observasi_detail';

$route['bank'] = 'home/bank';
$route['bank_detail'] = 'home/bank_detail';

$route['personal'] = 'home/user';
$route['add'] = '/user/save/';

$route['master_nc'] = 'home/master_nc';

$route['inspeksi'] = 'inspeksi/index';
$route['validasi'] = 'inspeksi/validasi';

$route['profile'] = 'home/profile';

$route['general'] = 'home/general';

$route['nc_user'] = 'nc/nc_user';
$route['nc_admin'] = 'nc/nc_admin';

$route['monitoring'] = 'monitoring';