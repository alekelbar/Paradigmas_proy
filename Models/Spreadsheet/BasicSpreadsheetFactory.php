<?php

declare(strict_types=1);

include_once "BasicSpreadsheetFactory.php";
include_once "SpreadsheetFactory.php";
include_once "Spreadsheet.php";
include_once "BasicSpreadsheet.php";

/**
 * @return the creation of a new Spreadsheet type object 
 */

class BasicSpreadsheetFactory extends SpreadsheetFactory
{
  public function createSpreadsheet(): BasicSpreadsheet
  {
    return new BasicSpreadsheet();
  }
}
