<?php
declare(strict_types=1);

namespace App\DbConnect;

class DbConnect
{
  private string $host;
  private string $dbName;
  private string $username;
  private string $password;
  
  public function __construct()
  {
    $this->host = $_ENV['DB_HOSTNAME'];
    $this->username = $_ENV['DB_USERNAME'];
    $this->dbName = $_ENV['DB_NAME'];
    $this->password = $_ENV['DB_PASSWORD'];
  }

  public function connect(): \PDO
  {
    try {
      $conn = new \PDO("mysql:host=$this->host;dbName=$this->dbName", $this->username, $this->password);
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch (\Exception $e) {
      http_response_code(500);
      die('DB connection error ' . $e->getMessage() . '<br />');
    }
  }
}