<?php
declare(strict_types=1);

namespace App\Database;

class Db
{
  private string $host;
  private string $db;
  private string $user;
  private string $pwd;
  
  public function __construct()
  {
    $this->host = $_ENV['DB_HOSTNAME'];
    $this->user = $_ENV['DB_USERNAME'];
    $this->db = $_ENV['DB_NAME'];
    $this->pwd = $_ENV['DB_PASSWORD'];
  }

  public function connect(): \PDO
  {
    try {
      $conn = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pwd);
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch (\Exception $e) {
      http_response_code(500);
      die('DB connection error ' . $e->getMessage() . '<br />');
    }
  }
}
