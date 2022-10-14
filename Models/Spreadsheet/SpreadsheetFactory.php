<?php

declare(strict_types=1);
include_once "Spreadsheet.php";

abstract class SpreadsheetFactory
{
  protected abstract function createSpreadsheet(): Spreadsheet;
}
