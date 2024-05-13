<?php
declare(strict_types=1);

namespace App\Database;

class Db
{
  private \PDO  $conn;
  private static Db | null $instance = null;
  
  public function __construct()
  {
    $host = $_ENV['DB_HOSTNAME'];
    $user = $_ENV['DB_USERNAME'];
    $db = $_ENV['DB_NAME'];
    $pwd = $_ENV['DB_PASSWORD'];

    try {
      $this->conn = new \PDO("mysql:host=$host;dbname=$db", $user, $pwd);
      $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\Exception $e) {
      http_response_code(500);
      die('DB connection error ' . $e->getMessage() . '<br />');
    }
  }

  private static function getInstance(): Db
  {
    if (!self::$instance) {
      self::$instance = new Db();
    }

    return self::$instance;
  }

  public static function getConnection(): \PDO
  {
    $instance = self::getInstance();
    return $instance->conn;
  }
}
