<?php

declare(strict_types=1);
include_once "EmployeeFactory.php";
include_once "BasicEmployee.php";

/**
 * @return the creation of a new employee type object 
 */

class BasicEmployeeFactory extends EmployeeFactory
{
  public function createEmployee(): BasicEmployee
  {
    return new BasicEmployee();
  }
}
