<?php

declare(strict_types=1);
include_once "DepartmentFactory.php";
include_once "BasicDept.php";
/**
 * class to create concrete objects of the class department 
 */
class BasicDepartmentFactory extends DepartmentFactory
{
/**
 * @return the creation of a new department type object 
 */
  public function createDepartment(): Department
  {
    return new BasicDept();
  }
}
