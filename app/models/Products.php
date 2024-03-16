<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Dvd;
use App\Database\Db;
use App\Models\Book;
use App\Utils\Constants;
use App\Models\Furniture;
use App\Utils\HttpResponse;

class Products
{
  public static function get(): array | string
  {
    try {
      $dvds = Dvd::getAll();
      $books = Book::getAll();
      $furnitures = Furniture::getAll();
      $allProducts = array_merge($dvds, $books, $furnitures);

      // Sort products by sku value
      usort($allProducts,  fn ($a, $b) =>  strcmp($a['sku'], $b['sku']));
      // Replace response by view once ready
      // http_response_code(200);
      // echo json_encode($allProducts);
      return $allProducts;
    } catch (\Exception $e) {
      HttpResponse::dbError($e->getMessage());
      return $e -> getMessage();
    }
  }

  public static function add(): void
  {
    $data = $_POST;
    $floats = array_merge(...array_values(Constants::PROPERTY_MAP));
    $keys = array_keys($data);
    foreach ($floats as $f) {
      in_array($f, $keys) && $data[$f]  = (float) $data[$f];
    }

    $class = "App\\Models\\" . ucfirst($data['type']);
    $product = new $class(...array_values($data));
    $product->save();
  }

  public static function delete(): void
  {
    try {
      $db = new Db();
      $dbConn = $db->connect();
      $data = $_POST;

      foreach (array_keys($data) as $db) {
        $skus = implode(',', array_map(fn ($item) => "'$item'", $data[$db]));
        $sql = "DELETE FROM $db WHERE sku IN ($skus)";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
      }
      HttpResponse::deleted();
    } catch (\Exception $e) {
      HttpResponse::dbError($e->getMessage());
    }
  }
}
