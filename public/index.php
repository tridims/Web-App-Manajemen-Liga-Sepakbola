<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Tridi\ManajemenLiga\App\Router;
use Tridi\ManajemenLiga\Controller\HomeController;

// Route hanya menggunakan Get dan Post
Router::add('GET', '/testing', HomeController::class, 'testing');
Router::add('GET', '/hello', HomeController::class, 'index');

Router::run();
