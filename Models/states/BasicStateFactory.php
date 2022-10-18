<?php

declare(strict_types=1);
include_once "StateFactory.php";
include_once "BasicState.php";
/**
 *  It is a class to create concrete state objects.
 */

class BasicStateFactory extends StateFactory
{
  /**
   * @return the creation of a new basic state.
   */
  public function createStatus(): State
  {
    return new BasicState();
  }
}
