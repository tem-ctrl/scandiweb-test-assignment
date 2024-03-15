<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Dvd;
use App\Models\Book;
use App\Utils\Constants;
use App\Models\Furniture;
use App\Database\DbConnect;
use App\Utils\HttpResponse;

class Products
{
  public static function get(): void
  {
    try {
      $dvds = Dvd::getAll();
      $books = Book::getAll();
      $furnitures = Furniture::getAll();
      $allProducts = array_merge($dvds, $books, $furnitures);

      // Sort products by sku value
      usort($allProducts,  fn ($a, $b) =>  strcmp($a['sku'], $b['sku']));
      // Replace response by view once ready
      http_response_code(200);
      echo json_encode($allProducts);
      exit;
    } catch (\Exception $e) {
      HttpResponse::dbError($e->getMessage());
    }
  }

  public static function add(): void
  {
    $data = $_POST;
    $p = array_merge(...array_values(Constants::PROPERTY_MAP));
    $keys = array_keys($data);
    foreach ($p as $k) {
      in_array($k, $keys) && $data[$k]  = (float) $data[$k];
    }

    $class = "App\\Models\\" . ucfirst($data['type']);
    $product = new $class(...array_values($data));
    $product->save();
  }

  public static function delete(): void
  {
    try {
      $dbObj = new DbConnect;
      $dbConn = $dbObj->connect();

      $data = $_REQUEST;

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
