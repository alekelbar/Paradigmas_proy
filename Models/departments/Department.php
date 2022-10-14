<?php

declare(strict_types=1);
abstract class Department
{
  protected PDO | null $connection = null;
  public abstract function read();
}
