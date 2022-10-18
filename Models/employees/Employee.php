<?php

declare(strict_types=1);
/**
 * abstract class to make epmloyees
 */

abstract class Employee
{
  /**
   * connection to the database for the employee class.
   */
  protected PDO | null $connection = null;
  /**
   * it's define  basic method save.
   */
  protected abstract function save();
  /**
   * it's define  basic method read.
   */
  protected abstract function read();
  /**
   * it's define basic method  delete.
   */
  protected abstract function delete();
  /**
   * it's define  basic method update.
   */
  protected abstract function update();
}
