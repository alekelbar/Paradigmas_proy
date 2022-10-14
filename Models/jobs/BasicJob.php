<?php

include_once "Job.php";
include_once "../Controllers/MySqlDB.php";

class BasicJob extends Job
{
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }

  public function read()
  {
    return $this->connection->query("SELECT name, id FROM job");
  }
}
