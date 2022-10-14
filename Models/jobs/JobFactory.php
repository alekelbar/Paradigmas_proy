<?php

declare(strict_types=1);
include_once "Job.php";

abstract class JobFactory
{
  protected abstract function createJob(): Job;
}
