<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Products;

class ProductController
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
