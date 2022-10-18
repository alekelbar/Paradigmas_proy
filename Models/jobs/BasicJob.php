<?php

include_once "Job.php";
include_once "../Controllers/MySqlDB.php";

/**
 * To do Basic Jobs, based on Job bases.
 */

class BasicJob extends Job
{
  /**
   * @return a new instance of Basic job.
   */
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }
  /**
   * Function capable of reading data into the database. 
   * @return the information of a job.
   */
  public function read()
  {
    return $this->connection->query("SELECT name, id FROM job");
  }
}
