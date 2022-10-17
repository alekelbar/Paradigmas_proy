<?php

declare(strict_types=1);
/**
 * An abstract class to make epmloyees.
 * it's define four basic methods [read, save, delete, update];
 */

abstract class Employee
{
  protected ?PDO $connection = null;
  protected abstract function save();
  protected abstract function read();
  protected abstract function delete();
  protected abstract function update();
}
