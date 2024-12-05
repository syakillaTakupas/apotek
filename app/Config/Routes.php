<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::dashboard');

// Rute untuk Dashboard
$routes->get('dashboard', 'DashboardController::index');

// Routes untuk Data Master
$routes->group('pelanggan', function ($routes) {
    $routes->get('/', 'PelangganController::index'); // List
    $routes->get('create', 'PelangganController::create'); // Create
    $routes->post('store', 'PelangganController::store'); // Store
    $routes->get('edit/(:num)', 'PelangganController::edit/$1'); // Edit
    $routes->post('update/(:num)', 'PelangganController::update/$1'); // Update
    $routes->get('delete/(:num)', 'PelangganController::delete/$1'); // Delete
});

$routes->group('obat', function ($routes) {
    $routes->get('/', 'ObatController::index'); // List
    $routes->get('create', 'ObatController::create'); // Create
    $routes->post('store', 'ObatController::store'); // Store
    $routes->get('edit/(:num)', 'ObatController::edit/$1'); // Edit
    $routes->post('update/(:num)', 'ObatController::update/$1'); // Update
    $routes->get('delete/(:num)', 'ObatController::delete/$1'); // Delete
});

$routes->group('pemasok', function ($routes) {
    $routes->get('/', 'PemasokController::index'); // List
    $routes->get('create', 'PemasokController::create'); // Create
    $routes->post('store', 'PemasokController::store'); // Store
    $routes->get('edit/(:num)', 'PemasokController::edit/$1'); // Edit
    $routes->post('update/(:num)', 'PemasokController::update/$1'); // Update
    $routes->get('delete/(:num)', 'PemasokController::delete/$1'); // Delete
});

// Routes untuk Pesanan Pembelian
$routes->group('pesanan_pembelian', function ($routes) {
    $routes->get('/', 'PesananPembelianController::index'); // List
    $routes->get('create', 'PesananPembelianController::create'); // Create
    $routes->post('store', 'PesananPembelianController::store'); // Store
    $routes->get('edit/(:num)', 'PesananPembelianController::edit/$1'); // Edit
    $routes->post('update/(:num)', 'PesananPembelianController::update/$1'); // Update
    $routes->get('delete/(:num)', 'PesananPembelianController::delete/$1'); // Delete
});

// Routes untuk Item Pesanan Pembelian
$routes->group('item_pesanan_pembelian', function ($routes) {
    $routes->get('/', 'ItemPesananPembelian::index'); // List
    $routes->get('create', 'ItemPesananPembelian::create'); // Create
    $routes->post('store', 'ItemPesananPembelian::store'); // Store
    $routes->get('edit/(:num)', 'ItemPesananPembelian::edit/$1'); // Edit
    $routes->post('update/(:num)', 'ItemPesananPembelian::update/$1'); // Update
    $routes->get('delete/(:num)', 'ItemPesananPembelian::delete/$1'); // Delete
});

// Routes untuk Penjualan
$routes->group('penjualan', function ($routes) {
    $routes->get('/', 'PenjualanController::index'); // List
    $routes->get('create', 'PenjualanController::create'); // Create
    $routes->post('store', 'PenjualanController::store'); // Store
    $routes->get('edit/(:num)', 'PenjualanController::edit/$1'); // Edit
    $routes->post('update/(:num)', 'PenjualanController::update/$1'); // Update
    $routes->get('delete/(:num)', 'PenjualanController::delete/$1'); // Delete
    $routes->get('detail/(:num)', 'PenjualanController::detail/$1'); // Detail Penjualan
    $routes->get('bayar/(:num)', 'PenjualanController::bayar/$1'); // Menampilkan halaman pembayaran
    $routes->post('proses_bayar/(:num)', 'PenjualanController::prosesBayar/$1'); // Memproses pembayaran
});



// Routes untuk Item Penjualan
$routes->group('item_penjualan', function ($routes) {
    $routes->get('/', 'ItemPenjualan::index'); // List
    $routes->get('create', 'ItemPenjualan::create'); // Create
    $routes->post('store', 'ItemPenjualan::store'); // Store
    $routes->get('edit/(:num)', 'ItemPenjualan::edit/$1'); // Edit
    $routes->post('update/(:num)', 'ItemPenjualan::update/$1'); // Update
    $routes->get('delete/(:num)', 'ItemPenjualan::delete/$1'); // Delete
});

// Route untuk registrasi
$routes->get('register', 'AuthController::register', ['as' => 'register']); // Halaman registrasi
$routes->post('register', 'AuthController::storeRegister'); // Proses simpan registrasi

// Route untuk login
$routes->get('login', 'AuthController::login', ['as' => 'login']); // Halaman login
$routes->post('login', 'AuthController::authenticate'); // Proses autentikasi login

// Route untuk logout
$routes->get('logout', 'AuthController::logout', ['as' => 'logout']); // Proses logout
