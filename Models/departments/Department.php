<?php

declare(strict_types=1);
/**
 * An abstract class to obtain the Department.
 * A basic read method is defined
 */
abstract class Department
{
  protected ?PDO $connection = null;
  public abstract function read();
}
