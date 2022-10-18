<?php

declare(strict_types=1);
include_once "Department.php";
/**
 * abstract class factory department 
 */

abstract class DepartmentFactory
{
  /**
  * An abstract method for creating departments for an departament.
  */
  protected abstract function createDepartment(): Department;
}
