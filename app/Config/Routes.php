<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// AUTH
$routes->post('auth/login', 'AuthController::login', ['Filter' => 'redirect']);
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

// PRODUK
$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

// KATEGORI PRODUK
$routes->group('produk kategori', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukKategoriController::index');
    $routes->post('', 'ProdukKategoriController::create');
    $routes->post('edit/(:any)', 'ProdukKategoriController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukKategoriController::delete/$1');
});

// DISKON (Soal Nomor 3)
$routes->group('diskon', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'DiskonController::index');
    $routes->post('tambah', 'DiskonController::tambah');
    $routes->post('edit', 'DiskonController::edit');
    $routes->get('hapus/(:any)', 'DiskonController::hapus/$1');
});

// KERANJANG & TRANSAKSI
$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});
$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

// LAINNYA
$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);
$routes->get('contact', 'ContactController::index', ['filter' => 'auth']);

$routes->resource('api', ['controller' => 'apiController']);
