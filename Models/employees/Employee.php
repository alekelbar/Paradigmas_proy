<?php

declare(strict_types=1);
abstract class Employee
{
  protected PDO | null $connection = null;
  protected abstract function save();
  protected abstract function read();
  protected abstract function delete();
  protected abstract function update();
}
