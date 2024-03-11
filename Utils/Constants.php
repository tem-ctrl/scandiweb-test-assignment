<?php 
declare(strict_types=1);
namespace App\Utils;

class Constants 
{
  const PROPERTY_MAP =
  [
    'dvd' => [
      'attributes'=> ['size']
    ],
    'book' => [
      'attributes' => ['weight']
    ],
    'furniture' => [
      'attributes' => ['height', 'width', 'length']
    ]
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