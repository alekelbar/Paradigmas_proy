<?php

declare(strict_types=1);
/**
 * Department abstract class.
 */
abstract class Department
{
  /**
  * connection to the database for the department class
  */
  protected PDO | null $connection = null;
  /**
  * A basic read method is defined
  */
  public abstract function read();
}
