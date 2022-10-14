<?php

declare(strict_types=1);
include_once "State.php";
include_once "../Controllers/MySqlDB.php";

class BasicState extends State
{
  public function read()
  {
    return $this->connection?->query("SELECT name, id FROM state");
  }

  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }
}
