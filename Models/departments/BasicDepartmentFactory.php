<?php

declare(strict_types=1);
include_once "DepartmentFactory.php";
include_once "BasicDept.php";

class BasicDepartmentFactory extends DepartmentFactory
{
  public function createDepartment(): Department
  {
    return new BasicDept();
  }
}
