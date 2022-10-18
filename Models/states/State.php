<?php
/**
 * An abstract class to make States.
 * it's define four basic methods [read];
 */
abstract class State
{
  /**
   * It is a connection to the database for the State class.
   */
  protected PDO | null $connection = null;
  /**
   * An abstract class to define basic method to read 
   */
  public abstract function read();
}
