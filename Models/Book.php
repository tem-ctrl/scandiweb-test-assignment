<?php

namespace App\Models;

use App\Models\AbstractProduct;

class Book extends AbstractProduct
{
  protected float $weight;

  public function __construct($sku, $name, $price, $type, $weight)
  {
    parent::__construct($sku, $name, $price, $type);
    $this->weight = $weight;
  }
}