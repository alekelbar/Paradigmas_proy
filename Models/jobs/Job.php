<?php

declare(strict_types=1);
/**
 * An abstract class to make Jobs.
 * it's define four basic methods [read];
 */
abstract class Job
{
  protected PDO | null $connection = null;
  public abstract function read();
}
