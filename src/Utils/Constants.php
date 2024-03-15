<?php

declare(strict_types=1);

namespace App\Utils;
use App\Utils\ProductType;

class Constants
{
  const EXTRA_ATTRIBUTE_KEY = 'attributes';

  const PROPERTY_MAP =
  [
    ProductType::DVD => ['size'],
    ProductType::BOOK => ['weight'],
    ProductType::FURNITURE => ['height', 'width', 'length'],
  ];

  const HTTP_RESPONSES =
  [
    'not-allowed' => [
      405,
      'Method not allowed on this route!'
    ],
    'not-found' => [
      404,
      'Resource Not Found!'
    ],
    'added' => [
      201,
      'Product added successfully!'
    ],
    'deleted' => [
      200,
      'Product(s) deleted successfully!'
    ],
    'invalid-data' => [
      403,
      'Invalid data!'
    ],
    'db-error' => [
      500,
      'Database error!'
    ]
  ];
}
