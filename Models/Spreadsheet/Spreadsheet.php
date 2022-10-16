<?php

declare(strict_types=1);
abstract class Spreadsheet
/**
 * An abstract class to make Jobs.
 * it's define four basic methods [save,read,delete,update];
 */
{
  protected PDO | null $connection = null;
  protected abstract function save();
  protected abstract function read($start, $end);
  protected abstract function delete();
  protected abstract function update();
}
