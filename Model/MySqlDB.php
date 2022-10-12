<?php
include_once "db.php";

class MySqlDB extends DB
{

  //Cadena de conexión...
  protected $host;
  protected $db;
  protected $user;
  protected $password;
  protected $charset;
  protected $connection;

  public function __construct()
  {
    $this->host = "localhost";
    $this->db = "sign_paradigmas";
    $this->user = "root";
    $this->password = "";
    $this->charset = "utf8mb4";
  }

  public function connect()
  {
    try {
      $this->connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;

      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
      ];

      $pdo = new PDO($this->connection, $this->user, $this->password, $options);

      return $pdo;
    } catch (PDOException $e) {
      print_r("Error connection: " . $e->getMessage());
    }
  }
}
