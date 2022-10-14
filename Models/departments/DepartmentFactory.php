<?php

declare(strict_types=1);
include_once "Department.php";

abstract class DepartmentFactory
{
  protected abstract function createDepartment(): Department;
}
