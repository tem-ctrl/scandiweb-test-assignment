<?php

declare(strict_types=1);

namespace App\Models;

use App\Database\DbConnect;
use App\Utils\HttpResponse;
use App\Utils\ValidationSchema;

trait ProductTrait
{
 
  public function save(): void
  {
    $data = $this->getData();
    $dbTable = $this->type;
    $validationSchema = new ValidationSchema($dbTable);
    $isValid = $validationSchema->validate($data);

    if (gettype($isValid) === 'string') {
      HttpResponse::invalidData($isValid);

      return;
    }

    $sqlValueString = join(', ', array_map(fn ($item) => ":" . $item, array_keys($data)));
    $sql = "INSERT INTO $dbTable VALUES ($sqlValueString)";
    $stmt = $this->dbConn->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
    try {
      $stmt->execute($data);
      HttpResponse::added();
    } catch (\Exception $e) {
      HttpResponse::dbError($e->getMessage());
    }
  }

  public static function findAll(string $dbTable): array
  {
    $dbObj = new DbConnect;
    $dbConn = $dbObj->connect();

    $sql = "SELECT * FROM $dbTable";
    $stmt = $dbConn->query($sql);
    $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $products;
  }

  public static function trowDbError(\Exception $e)
  {
    HttpResponse::dbError($e->getMessage());
  }
}
