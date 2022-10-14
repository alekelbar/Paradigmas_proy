<?php

declare(strict_types=1);
abstract class Spreadsheet
{
  protected PDO | null $connection = null;
  protected abstract function save();
  protected abstract function read($start, $end);
  protected abstract function delete();
  protected abstract function update();
}
