<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Set it to 0 in production

// require 'config/headers.php';
require 'vendor/autoload.php';
use Bramus\Router\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$router = new Router();
$router->setNamespace('App\Controllers');
$router->get('/', 'Controllers@getProducts');
$router->post('/add-product', 'Controllers@addProduct');
$router->post('/mass-delete', 'Controllers@deleteProducts');
$router->run();