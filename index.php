<?php

error_reporting(E_ALL);
ini_set('display_errors', 1); // Set it to 0 in production
require_once 'vendor/autoload.php';

// use App\App;

// $app = new App();
// $app->run();

use Dotenv\Dotenv;
use App\Utils\Headers;
use Bramus\Router\Router;

class App
{
  private function loadEnvVariables(): void
  {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
  }

  private function setroutes(): void
  {
    $router = new Router();
    $router->setNamespace('App\Controllers');
    $router->get('/', 'ProductController@getProducts');
    $router->post('/add-product', 'ProductController@addProduct');
    $router->post('/mass-delete', 'ProductController@deleteProducts');
    $router->run();
  }

  public function run(): void
  {
    Headers::set();
    $this->loadEnvVariables();
    $this->setroutes();
  }
}

$app = new App();
$app->run();
