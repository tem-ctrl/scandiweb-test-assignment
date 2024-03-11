<?php
declare(strict_types=1);
namespace Scandiweb\Test\Controllers\Utils;

class DbConnect
{
  private const DEV = true;
  private string $host;
  private string $dbName;
  private string $user;
  private string $password;

  public function __construct() 
  {
    if ($this::DEV) {
      $this->host = $_ENV['DB_HOST_DEV'];
      $this->dbName = $_ENV['DB_NAME_DEV'];
      $this->user = $_ENV['DB_USER_DEV'];
      $this->password = $_ENV['DB_PASSWORD_DEV'];
    } else {
      $this->host = $_ENV['DB_HOST'];
      $this->dbName = $_ENV['DB_NAME'];
      $this->user = $_ENV['DB_USER'];
      $this->password = $_ENV['DB_PASSWORD'];
    }
  }

  public function connect()
  {
    try {
      $conn = new \PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->password);
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch (\Exception $e) {
      http_response_code(500);
      die('DB connection error! ' . $e->getMessage() . '<br/>');
    }
  }
}