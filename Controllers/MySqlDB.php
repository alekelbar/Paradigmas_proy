<?php

declare(strict_types=1);
include_once "db.php";

class MySqlDB extends DB
{
/**
 * Database connection string 
 * @param host 
 * @param db
 * @param password
 * @param charset
 * @param connection
 * @param instance
 */
  private string $host = "localhost";
  private string $db = "sign_paradigmas";
  private string $user = "root";
  private string $password = "";
  private string $charset = "utf8mb4";
  private static ?PDO $connection = null;
  private static MySqlDB | null $instance = null;

 /**
  * Creative sigleton pattern :construct private
  */
  private function __construct()
  {
  }

  /**
   * Obtains data from database 
   * @return The database data 
   */
  public static function getInstance(): PDO
  {
    if (self::$instance == null || self::$connection == null) {
      self::$instance = new MySqlDB();
      $connection = self::$instance->connect();
      return $connection;
    }
    return self::$connection;
  }
/**
 * This function performs the connection section  
 * verifies the connection string is correct and no error occurs. 
 */
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
