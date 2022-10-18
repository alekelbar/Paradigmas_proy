<?php

declare(strict_types=1);
include_once "Job.php";
/**
 * An abstract class to create jobs.
 */

abstract class JobFactory
{
  /**
   * It is an abstract function for creating a job
   */
  protected abstract function createJob(): Job;
}
