<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Tridi\ManajemenLiga\App\Router;
use Tridi\ManajemenLiga\Controller\HomeController;
use Tridi\ManajemenLiga\Controller\LigaController;
use Tridi\ManajemenLiga\Controller\PertandinganController;
use Tridi\ManajemenLiga\Controller\TimController;

// Route hanya menggunakan Get dan Post
Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/testing', HomeController::class, 'testing');

// Controller TimSepakBola
Router::add('GET', '/tim', TimController::class, 'daftarTim');
Router::add('GET', '/tim/edit', TimController::class, 'editTim');
Router::add('POST', '/tim/edit', TimController::class, 'postEditTim');
Router::add('GET', '/tim/hapus', TimController::class, 'deleteTim');
Router::add('GET', '/tim/create', TimController::class, 'tambahTim');
Router::add('POST', '/tim/create', TimController::class, 'postTambahTim');

// Controller Pertandingan
Router::add('GET', '/pertandingan', pertandinganController::class, 'daftarPertandingan');
Router::add('GET', '/pertandingan/edit', PertandinganController::class, 'editPertandingan');
Router::add('POST', '/pertandingan/edit', PertandinganController::class, 'postEditPertandingan');
Router::add('GET', '/pertandingan/hapus', PertandinganController::class, 'deletePertandingan');
Router::add('GET', '/pertandingan/create', PertandinganController::class, 'tambahPertandingan');
Router::add('POST', '/pertandingan/create', PertandinganController::class, 'postTambahPertandingan');

// Controller Liga
Router::add('GET', '/klasemen', LigaController::class, 'klasemen');


Router::run();
