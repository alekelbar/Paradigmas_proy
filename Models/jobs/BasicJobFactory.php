<?php

declare(strict_types=1);
include_once "JobFactory.php";
include_once "BasicJob.php";

/**
 * @return the creation of a new Job type object 
 */

class BasicJobFactory extends JobFactory
{
  public function createJob(): Job
  {
    return new BasicJob();
  }
}
