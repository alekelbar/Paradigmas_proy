<?php

declare(strict_types=1);
/**
 * An abstract class to create epmloyees.
 */

abstract class EmployeeFactory
{
  protected abstract function createEmployee(): Employee;
}
