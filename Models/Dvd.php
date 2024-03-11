<?php 

namespace App\Models;
use App\Models\AbstractProduct;

class Dvd extends AbstractProduct
{
  use ProductTrait;

  protected float $size;

  public function __construct($sku, $name, $price, $type, $size)
  {
    parent::__construct($sku, $name, $price, $type);
    $this->size = $size;
  }
}