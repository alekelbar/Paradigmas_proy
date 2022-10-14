<?php

declare(strict_types=1);
include_once "db.php";

class MySqlDB extends DB
{

  //Cadena de conexión...
  private string $host = "localhost";
  private string $db = "sign_paradigmas";
  private string $user = "root";
  private string $password = "";
  private string $charset = "utf8mb4";
  private static ?PDO $connection = null;
  private static MySqlDB | null $instance = null;

  // singleton: construct private
  private function __construct()
  {
  }

  public static function getInstance(): PDO
  {
    if (self::$instance == null || self::$connection == null) {
      self::$instance = new MySqlDB();
      $connection = self::$instance->connect();
      return $connection;
    }
    return self::$connection;
  }

  protected function connect(): PDO
  {
    try {
      $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;

      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
      ];

      $pdo = new PDO($connection, $this->user, $this->password, $options);

      return $pdo;
    } catch (PDOException $e) {
      print_r("Error connection: " . $e->getMessage());
    }
  }
}
