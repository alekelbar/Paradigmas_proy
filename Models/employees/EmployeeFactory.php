<?php

declare(strict_types=1);

abstract class EmployeeFactory
{
  protected abstract function createEmployee(): Employee;
}
