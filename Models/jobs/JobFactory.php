<?php

declare(strict_types=1);
include_once "Job.php";
/**
 * An abstract class to create Jobs.
 */

abstract class JobFactory
{
  protected abstract function createJob(): Job;
}
