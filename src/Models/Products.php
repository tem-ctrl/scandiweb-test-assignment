<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Dvd;
use App\Models\Book;
use App\Models\Furniture;
use App\Database\DbConnect;
use App\Utils\HttpResponse;

class Products
{
  public static function get(): void
  {
    try {
      $allProducts = [];
      $dvds = Dvd::getAll();
      $books = Book::getAll();
      $furnitures = Furniture::getAll();

      foreach ([$dvds, $books, $furnitures] as $products) {
        $allProducts = array_merge($allProducts, $products);
      }

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
    $p = ['price', 'size', 'weight', 'height', 'width', 'length'];
    $keys = array_keys($data);
    foreach ($p as $i) {
      in_array($i, $keys) && $data[$i]  = (float) $data[$i];
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
