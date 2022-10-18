<?php

declare(strict_types=1);
/**
 * Abstract class to create employees.
 */

abstract class EmployeeFactory
{
  /**
   * An abstract method for creating employee for an Employee.
   */
  protected abstract function createEmployee(): Employee;
}
