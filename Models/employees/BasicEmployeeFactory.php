<?php

declare(strict_types=1);
include_once "EmployeeFactory.php";
include_once "BasicEmployee.php";

/**
 * To create concrete objects of the employee of class. 
 */

class BasicEmployeeFactory extends EmployeeFactory
{
  /**
   * @return the creation of a new basic employee
   */
  public function createEmployee(): BasicEmployee
  {
    return new BasicEmployee();
  }
}
