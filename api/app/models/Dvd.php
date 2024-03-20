<?php

namespace App\Models;

// use App\Utils\Constants;
use App\Utils\ProductType;
use App\Models\ProductTrait;
use App\Models\AbstractProduct;

class Dvd extends AbstractProduct
{
  use ProductTrait;

  public function __construct($sku, $name, $price, $type, protected float $size)
  {
    parent::__construct($sku, $name, $price, $type);
  }

  public function getData(): array
  {
    return [
      'sku' => $this->sku,
      'name' => $this->name,
      'price' => $this->price,
      'size' => $this->size,
    ];
  }

  public static function getAll(): array | null
  {
    try {
      $dvds = self::findAll(ProductType::DVD);
      // foreach ($dvds as &$dvd) {
      //   $dvd += [Constants::EXTRA_ATTRIBUTE_KEY => $dvd['size'] . ' MB'];
      //   unset($dvd['size']);
      // }
      return $dvds;
    } catch (\Exception $e) {
      self::trowDbError($e);
      return null;
    }
  }
}
