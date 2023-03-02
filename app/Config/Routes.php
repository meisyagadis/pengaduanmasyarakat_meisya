<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['filter'=>'auth']);
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/register', 'LoginController::register');
$routes->post('/saveregister', 'LoginController::saveregister');

$routes->get('/masyarakat', 'MasyarakatController::index',['filter'=>'auth']);
$routes->post('/masyarakat', 'MasyarakatController::save');
$routes->get('masyarakat/hapus/(:segment)', 'MasyarakatController::delete/$1');
$routes->post('masyarakat/edit/(:segment)', 'MasyarakatController::edit/$1');

$routes->get('/petugas', 'PetugasController::index',['filter'=>'auth']);
$routes->post('/petugas', 'PetugasController::save');
$routes->get('petugas/hapus/(:segment)', 'PetugasController::delete/$1');
$routes->post('petugas/edit/(:segment)', 'PetugasController::edit/$1');

$routes->get('getTanggapan', 'TanggapanController::getTanggapan',['filter'=>'auth']);
$routes->post('tanggapi', 'TanggapanController::save');

$routes->get('/pengaduan', 'PengaduanController::index',['filter'=>'auth']);
$routes->post('/tambahpengaduan', 'PengaduanController::save');
$routes->get('pengaduan/hapus/(:segment)', 'PengaduanController::delete/$1');

$routes->get('/laporan', 'LaporanController::laporan',['filter'=>'auth']);

$routes->get('/profile', 'LoginController::lihatprofil',['filter'=>'auth']);
$routes->post('/editprofil', 'LoginController::editprofil');



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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
