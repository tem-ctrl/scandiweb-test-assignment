<?php 
declare(strict_types = 1);
namespace App\Utils;
use App\Utils\Constants;

class HttpResponse
{
  private static function set(string $type, ?string $msg): void
  {
    $head = 'Content-Type: application/json';
    [$code, $message] = Constants::HTTP_RESPONSES[$type];
    header($head, true, $code);
    $bodyMsg = $msg && $msg !== '' ? $msg : $message;
    echo json_encode(['message'=> $bodyMsg]);
    exit;
  }

  public static function added(?string $msg = null): void
  {
    self::set('added', $msg);
  }

  public static function deleted(?string $msg = null): void
  {
    self::set('deleted', $msg);
  }

  public static function notAllowed(?string $msg = null): void
  {
    self::set('not-allowed', $msg);
  }

  public static function notFound(?string $msg = null): void
  {
    self::set('not-found', $msg);
  }

  public static function invalidData(?string $msg = null): void
  {
    self::set('invalid-data', $msg);
  }

  public static function dbError(?string $msg = null): void
  {
    self::set('db-error', $msg);
  }
}
