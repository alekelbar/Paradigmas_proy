<?php

declare(strict_types=1);
include_once "State.php";
/**
 * An abstract class to create States.
 */
abstract class StateFactory
{
  /**
   * This is an abstract function for creating a state.
   */
  protected abstract function createStatus(): State;
}
