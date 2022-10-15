<?php

declare(strict_types=1);
include_once "DepartmentFactory.php";
include_once "BasicDept.php";
/**
 * @return the creation of a new department type object 
 */
class BasicDepartmentFactory extends DepartmentFactory
{
  public function createDepartment(): Department
  {
    return new BasicDept();
  }
}
