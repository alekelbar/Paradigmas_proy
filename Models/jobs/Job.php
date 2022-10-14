<?php

declare(strict_types=1);
abstract class Job
{
  protected PDO | null $connection = null;
  public abstract function read();
}
