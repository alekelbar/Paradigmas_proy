<?php

declare(strict_types=1);
/**
 * An abstract class to make Jobs.
 */
abstract class Spreadsheet
{
  /**
   * connection to the database for the Spreadsheet class
   */
  protected PDO | null $connection = null;
  /**
   * A basic method save 
   */
  protected abstract function save();
  /**
   * It is a function to read
   */
  protected abstract function read($start, $end);
  /**
   * It is a basic method to delete
   */
  protected abstract function delete();
  /**
   * This define a basic method to update
   */
  protected abstract function update();
}
