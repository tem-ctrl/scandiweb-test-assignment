<?php

namespace App\Models;

abstract class AbstractProduct
{
  public function __construct(
    protected string $sku,
    protected string $name,
    protected float $price,
    protected string $type,
  ) { }

  abstract protected function save(): void;
  abstract protected function getData(): array;
  abstract protected static function getAll(): array | null;
  abstract protected static function findAll(string $dbTable): array;
}
