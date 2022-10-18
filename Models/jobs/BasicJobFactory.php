<?php

declare(strict_types=1);
include_once "JobFactory.php";
include_once "BasicJob.php";

/**
 *  A class to create concrete job objects.
 */

class BasicJobFactory extends JobFactory
{
  /**
   * @return a new basic Job.
   */
  public function createJob(): Job
  {
    return new BasicJob();
  }
}
