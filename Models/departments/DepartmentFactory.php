<?php

declare(strict_types=1);
include_once "Department.php";
/**
 * An abstract class for creating departments for an employee.
 */

abstract class DepartmentFactory
{
  protected abstract function createDepartment(): Department;
}
