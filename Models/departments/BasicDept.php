<?php

declare(strict_types=1);
include_once "Department.php";
include_once "../Controllers/MySqlDB.php";

class BasicDept extends Department
{
  public string $deparment_name;
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }

  public function setName($deparment_name)
  {
    $this->deparment_name = $deparment_name;
  }

  public function read()
  {
    return $this->connection->query("SELECT name, id FROM department");
  }
}
