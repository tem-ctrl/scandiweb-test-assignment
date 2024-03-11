<?php

namespace App\Models;

use App\Models\AbstractProduct;

class Furniture extends AbstractProduct
{
  use ProductTrait;

  protected float $height;
  protected float $width;
  protected float $length;

  public function __construct($sku, $name, $price, $type, $height, $width, $length)
  {
    parent::__construct($sku, $name, $price, $type);
    $this->height = $height;
    $this->width = $width;
    $this->length = $length;
  }
}