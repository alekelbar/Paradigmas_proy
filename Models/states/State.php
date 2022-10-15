<?php
/**
 * An abstract class to make States.
 * it's define four basic methods [read];
 */
abstract class State
{
  protected PDO | null $connection = null;
  public abstract function read();
}
