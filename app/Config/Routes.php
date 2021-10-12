<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('RegistrationController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'RegistrationController::index');

$routes->post('/registration', 'RegistrationController::create');
$routes->get('/amplop/(:segment)', "AmplopPublicController::view_show/$1");


$routes->get('/form-login-kp4', 'UserController::view_login');
$routes->post('/form-login-kp4', 'UserController::api_check_login');


$routes->get("/id-pan/(:segment)", "IdcardController::print_kartu/1/$1");
$routes->get("/id-t/(:segment)", "IdcardController::print_kartu/2/$1");
$routes->get("/id-p/(:segment)", "IdcardController::print_kartu/3/$1");

$routes->get("/cert-pan/(:segment)", "CertificateController::print/1/$1");
$routes->get("/cert-t/(:segment)", "CertificateController::print/2/$1");
$routes->get("/cert-p/(:segment)", "CertificateController::print/3/$1");


// admin peserta view
$routes->get('/admin', 'AdminController::view_index');
$routes->get('/admin/view_index', 'AdminController::view_index');
// $routes->get('/admin/view_form', 'AdminController::view_index');

// admin peserta API
$routes->get('/admin/peserta', 'AdminController::index');
$routes->get('/admin/peserta/(:num)', 'AdminController::show/$1');
// $routes->post('/admin/peserta', 'AdminController::create');
$routes->put('/admin/peserta/(:num)', 'AdminController::update/$1');
$routes->delete('/admin/peserta/(:num)', 'AdminController::delete/$1');



// admin peserta view
$routes->get('/admin/panitia', 'PanitiaController::view_index');
$routes->get('/admin/panitia/form', 'PanitiaController::view_form');
$routes->get('/admin/panitia/form/(:num)', 'PanitiaController::view_form/$1');

// admin panitia API
$routes->get('/admin/panitia/all', 'PanitiaController::index');
$routes->get('/admin/panitia/(:num)', 'PanitiaController::show/$1');
$routes->post('/admin/panitia', 'PanitiaController::create');
$routes->post('/admin/panitia/(:num)', 'PanitiaController::update/$1');
$routes->delete('/admin/panitia/(:num)', 'PanitiaController::delete/$1');

// admin pembayaran
$routes->get('/admin/pembayaran', 'PembayaranController::view_index');
$routes->get('/admin/pembayaran/form', 'PembayaranController::view_form');
$routes->get('/admin/pembayaran/form/(:num)', 'PembayaranController::view_form/$1');
$routes->get('/admin/pembayaran/nota/(:num)', 'PembayaranController::view_nota/$1');
$routes->get('/admin/pembayaran/detail/(:num)', 'PembayaranController::view_detail/$1');

// admin pembayaran API
$routes->get('/admin/pembayaran/all', 'PembayaranController::index');
$routes->get('/admin/pembayaran/(:num)', 'PembayaranController::show/$1');
$routes->post('/admin/pembayaran', 'PembayaranController::create');
$routes->post('/admin/pembayaran/(:num)', 'PembayaranController::update/$1');
$routes->delete('/admin/pembayaran', 'PembayaranController::remove');


// admin view kegiatan
$routes->get('/admin/kegiatan', 'KegiatanController::view_index');
$routes->get('/admin/kegiatan/form', 'KegiatanController::view_form');
$routes->get('/admin/kegiatan/form/(:num)', 'KegiatanController::view_form/$1');

// admin kegiatan API
$routes->get('/admin/kegiatan/all', 'KegiatanController::index');
$routes->get('/admin/kegiatan/(:num)', 'KegiatanController::show/$1');
$routes->post('/admin/kegiatan', 'KegiatanController::create');
$routes->post('/admin/kegiatan/(:num)', 'KegiatanController::update/$1');
$routes->delete('/admin/kegiatan/(:num)', 'KegiatanController::remove/$1');


// admin cek tiket
$routes->get('/admin/cek-tiket', 'CektiketController::view_index');
$routes->get('/admin/cek-tiket/data', 'CektiketController::index');
$routes->post('/admin/cek-tiket', 'CektiketController::validation/$1');


// admin amplop
$routes->get('/admin/amplop', 'AmplopController::view_index');
$routes->get('/admin/amplop/print-qrcode', 'AmplopController::view_genqrcode');
$routes->get('/admin/amplop/print-amplop', 'AmplopController::print_amplop');
$routes->get('/admin/amplop/keluar', 'AmplopController::view_keluar');
$routes->get('/admin/amplop/masuk', 'AmplopController::view_masuk');

// admin amplop api
$routes->get('/admin/amplop/all', 'AmplopController::index');
$routes->get('/admin/amplop/cek/(:segment)', 'AmplopController::api_cek/$1');
$routes->post('/admin/amplop/keluar', 'AmplopController::api_keluar');
$routes->post('/admin/amplop/masuk', 'AmplopController::api_masuk');


// admin 
$routes->get('/admin/ganti_password', 'UserController::view_change_password');
$routes->post('/admin/ganti_password', 'UserController::api_change_password');
$routes->get('/admin/logout', 'UserController::logout');






/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
