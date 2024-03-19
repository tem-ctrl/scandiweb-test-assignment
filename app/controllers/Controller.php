<?php

namespace App\Controllers;

// use App\Routes\Router;
use App\Models\Products;

class Controller
{
  public static function getProducts(): void
  {
    Products::get();
  }

  public static function addProduct(): void
  {
    Products::add();
  }

  public static function deleteProducts(): void
  {
    Products::delete();
  }
}
