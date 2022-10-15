<?php

declare(strict_types=1);
/**
 * An abstract class to perform the database connection function.     
 */

abstract class DB
{
  protected abstract function connect();
}
