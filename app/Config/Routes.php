<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login'); // Halaman utama
$routes->get('/login', 'AuthController::login'); // Menampilkan form login
$routes->post('/login', 'AuthController::attemptLogin'); // Mengolah login
$routes->get('/register', 'AuthController::register'); // Menampilkan form register
$routes->post('/register', 'AuthController::storeRegister'); // Mengolah registrasi
$routes->get('/dashboard', 'DashboardController::index'); // Dashboard
$routes->get('/peminjam/dashboard/(:num)', 'PeminjamController::dashboard/$1'); // Dashboard Peminjam dengan UserID

$routes->get('/database-test', 'DatabaseTestController::index'); // Test database
$routes->get('/logout', 'AuthController::logout'); // Logout user
$routes->get('/admin/dashboard', 'AdminController::dashboard');

$routes->post('peminjaman/pinjam/(:num)', 'PeminjamanController::pinjam/$1');


$routes->post('ulasan/save', 'UlasanController::save');
$routes->get('peminjaman/ulasan/buku/(:num)', 'UlasanController::getUlasan/$1');



$routes->get('buku/(:num)', 'BukuController::index/$1'); // Rute ini bisa mengambil UserID sebagai parameter
$routes->get('/buku', 'BukuController::index'); // Rute untuk menampilkan semua buku

$routes->get('peminjam/buku/detail/(:num)', 'AdminBukuController::detail/$1');


$routes->group('admin', function ($routes) {
    // Route yang sudah ada
    $routes->get('buku', 'AdminBukuController::adbuku');
    $routes->post('buku/save', 'AdminBukuController::save');
    $routes->get('buku/delete/(:segment)', 'AdminBukuController::delete/$1');
    $routes->get('buku/detail/(:num)', 'AdminBukuController::detail/$1');
    
    $routes->delete('/admin/buku/delete/(:num)', 'AdminBukuController::delete/$1');
    $routes->get('/admin/buku/delete/(:num)', 'AdminBukuController::delete/$1');

    $routes->get('users', 'UserController::pengguna');
    $routes->post('users/store', 'UserController::store');
    $routes->post('users/update/(:num)', 'UserController::update/$1');
    $routes->get('users/delete/(:num)', 'UserController::delete/$1');

    // Route untuk kategori
    $routes->get('kategori', 'KategoriController::index');
    $routes->post('kategori/save', 'KategoriController::save');
    $routes->post('kategori/update/(:num)', 'KategoriController::update/$1');
    $routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1');


    // app/Config/Routes.php

    $routes->get('peminjaman', 'AdminPeminjamanController::index');

    $routes->get('data-ulasan', 'AdminUlasanController::index');



    //Laporan
    $routes->get('laporan', 'LaporanController::index');

    $routes->get('laporan/peminjaman', 'LaporanController::generateLaporanPeminjaman');
    $routes->get('laporan/keanggotaan', 'LaporanController::generateLaporanKeanggotaan');
    $routes->get('laporan/ulasan', 'LaporanController::generateLaporanUlasan');
});

$routes->get('peminjaman/(:num)', 'PeminjamanController::index/$1');
$routes->get('peminjaman/kembalikan/(:num)/(:num)', 'PeminjamanController::kembalikan/$1/$2');
$routes->post('peminjaman/pinjam/(:num)', 'PeminjamanController::pinjam/$1');

$routes->get('ulasan', 'UlasanController::index');
$routes->post('ulasan/update/(:num)', 'UlasanController::update/$1');
$routes->get('ulasan/hapus/(:num)', 'UlasanController::hapus/$1');


$routes->get('koleksi/check/(:num)', 'KoleksiController::check/$1');
$routes->post('koleksi/toggle', 'KoleksiController::toggle');

$routes->get('peminjam/koleksi/(:num)', 'KoleksiController::koleksi/$1');
