<?php

declare(strict_types=1);
include_once "Spreadsheet.php";
/**
 * This abstract class is used to create Spreadsheets.
 */
abstract class SpreadsheetFactory
{
  /**
   * Abstract function for creating a job.
   */
  protected abstract function createSpreadsheet(): Spreadsheet;
}
