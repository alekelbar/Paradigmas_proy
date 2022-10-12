<?php
include_once "EmployeeFactory.php";
include_once "BasicEmployee.php";

class BasicEmployeeFactory extends EmployeeFactory
{
  public function createEmployee()
  {
    return new BasicEmployee(new MySqlDB());
  }
}
