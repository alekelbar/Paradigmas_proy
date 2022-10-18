<?php

declare(strict_types=1);

include_once "BasicSpreadsheetFactory.php";
include_once "SpreadsheetFactory.php";
include_once "Spreadsheet.php";
include_once "BasicSpreadsheet.php";

/**
 * Class to create concrete objects of the Spreadsheet of class.
 */
class BasicSpreadsheetFactory extends SpreadsheetFactory
{
/**
 * @return the creation of a new Spreadsheet type object 
 */
  public function createSpreadsheet(): BasicSpreadsheet
  {
    return new BasicSpreadsheet();
  }
}
