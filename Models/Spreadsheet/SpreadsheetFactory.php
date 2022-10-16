<?php

declare(strict_types=1);
include_once "Spreadsheet.php";
/**
 * An abstract class to create Spreadsheets.
 */
abstract class SpreadsheetFactory
{
  protected abstract function createSpreadsheet(): Spreadsheet;
}
