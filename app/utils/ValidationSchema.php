<?php

declare(strict_types=1);

namespace App\Utils;

use App\Utils\Constants;
use Nette\Schema\Expect;
use Nette\Schema\Processor;
use Nette\Schema\ValidationException;

class ValidationSchema
{
  public string $productType;

  public function __construct($productType)
  {
    $this->productType = strtolower($productType);
  }

  public function validate($data): mixed
  {
    $propertyMap = Constants::PROPERTY_MAP;
    $types = [
      'sku' => Expect::string()->required(),
      'name' => Expect::string()->required(),
      'price' => Expect::float()->required()
    ];
    $productAttrs = $propertyMap[$this->productType];

    foreach ($productAttrs as $attr) {
      $types[$attr] = Expect::float()->required();
    }

    $schema = Expect::structure($types);
    $processor = new Processor();
    try {
      $normalized = $processor->process($schema, $data);
      return $normalized;
    } catch (ValidationException $e) {
      return $e->getMessage();
    }
  }
}
