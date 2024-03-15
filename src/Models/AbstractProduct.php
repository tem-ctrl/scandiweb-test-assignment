<?php

namespace App\Models;

use App\Database\DbConnect;

abstract class AbstractProduct
{
  protected \PDO $dbConn;

  public function __construct(
    protected string $sku,
    protected string $name,
    protected string $type,
    protected float $price,
  )
  {
    $dbObj = new DbConnect;
    $this->dbConn = $dbObj->connect();
  }

  abstract protected function save(): void;
  abstract protected function getData(): array;
  abstract protected static function getAll(): array | null;
  abstract protected static function findAll(string $dbTable): array;
}
