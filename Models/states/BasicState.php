<?php

declare(strict_types=1);
include_once "State.php";
include_once "../Controllers/MySqlDB.php";
/**
 * To do Basic States, based on State bases.
 */

class BasicState extends State
{
  /**
   * Function capable of reading data into the database 
   * @return the information of a state
   */
  public function read()
  {
    return $this->connection->query("SELECT name, id FROM state");
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
