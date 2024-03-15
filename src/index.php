<?php

namespace App;

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
