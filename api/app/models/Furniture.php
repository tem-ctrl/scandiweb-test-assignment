<?php

namespace App\Models;

// use App\Utils\Constants;
use App\Utils\ProductType;
use App\Models\ProductTrait;
use App\Models\AbstractProduct;

class Furniture extends AbstractProduct
{
  use ProductTrait;

  public function __construct(
    $sku,
    $name,
    $price,
    $type,
    protected float $height,
    protected float $width,
    protected float $length,
  ) {
    parent::__construct($sku, $name, $price, $type);
  }

  public function getData(): array
  {
    return [
      'sku' => $this->sku,
      'name' => $this->name,
      'price' => $this->price,
      'length' => $this->length,
      'width' => $this->width,
      'height' => $this->height,
    ];
  }

  public static function getAll(): array | null
  {
    try {
      $type = ProductType::FURNITURE;
      $furnitures = self::findAll($type);
      // foreach ($furnitures as &$furniture) {
      //   $furniture += [Constants::EXTRA_ATTRIBUTE_KEY => $furniture['length'] . 'x' . $furniture['width'] . 'x' . $furniture['height'] . ' CM'];
      //   foreach (Constants::PROPERTY_MAP[$type] as $at) {
      //     unset($furniture[$at]);
      //   }
      // }
      return $furnitures;
    } catch (\Exception $e) {
      self::trowDbError($e);
      return null;
    }
  }
}
