<?php

declare(strict_types=1);
include_once "Department.php";
include_once "../Controllers/MySqlDB.php";

/**
 *   @return a new instance of Basic department
 */
class BasicDept extends Department
{
  public string $deparment_name;
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }
  /**
   * sets the department object name
   * @param department_name
   */
  public function setName($deparment_name)
  {
    $this->deparment_name = $deparment_name;
  }
  /**
   * query to read apartments 
   */
  public function read()
  {
    return $this->connection->query("SELECT name, id FROM department");
  }
}
