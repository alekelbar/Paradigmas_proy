<?php

declare(strict_types=1);
/**
 * An abstract class to make Jobs
 */
abstract class Job
{
  /**
   * connection to the database for the job class.
   */
  protected PDO | null $connection = null;
  /**
   * A basic method to read.
   */
  public abstract function read();
}
