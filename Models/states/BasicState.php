<?php

declare(strict_types=1);
include_once "State.php";
include_once "../Controllers/MySqlDB.php";
/**
 * To do Basic States, based on State bases
 */

class BasicState extends State
{
  /**
   * @return a query to read States 
   */
  public function read()
  {
    return $this->connection?->query("SELECT name, id FROM state");
  }

  /**
   * @return a new instance of Basic State
   */
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }
}
