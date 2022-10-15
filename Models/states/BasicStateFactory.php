<?php

declare(strict_types=1);
include_once "StateFactory.php";
include_once "BasicState.php";
/**
 * @return the creation of a new State type object 
 */

class BasicStateFactory extends StateFactory
{
  public function createStatus(): State
  {
    return new BasicState();
  }
}
