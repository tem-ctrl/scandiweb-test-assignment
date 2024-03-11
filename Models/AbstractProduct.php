<?php

namespace App\Models;

use App\DbConnect\DbConnect;

abstract class AbstractProduct
{
  public function __construct(
    protected string $sku,
    protected string $type,
    protected float $price,
    protected \PDO $dbConn,
  ) {
    $dbObj = new DbConnect;
    $this->dbConn = $dbObj->connect();
  }

  abstract protected function save(): void;
  abstract protected function getData(): void;
}