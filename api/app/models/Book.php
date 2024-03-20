<?php

namespace App\Models;

// use App\Utils\Constants;
use App\Utils\ProductType;
use App\Models\ProductTrait;
use App\Models\AbstractProduct;

class Book extends AbstractProduct
{
  use ProductTrait;

  public function __construct($sku, $name, $price, $type, protected float $weight)
  {
    parent::__construct($sku, $name, $price, $type);
  }

  public function getData(): array
  {
    return [
      'sku' => $this->sku,
      'name' => $this->name,
      'price' => $this->price,
      'weight' => $this->weight,
    ];
  }

  public static function getAll(): array | null
  {
    try {
      $books = self::findAll(ProductType::BOOK);
      // foreach ($books as &$book) {
      //   $book += [Constants::EXTRA_ATTRIBUTE_KEY => $book['weight'] . ' KG'];
      //   unset($book['weight']);
      // }
      return $books;
    } catch (\Exception $e) {
      self::trowDbError($e);
      return null;
    }
  }
}
