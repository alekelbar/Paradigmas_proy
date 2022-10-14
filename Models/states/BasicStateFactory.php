<?php

declare(strict_types=1);
include_once "StateFactory.php";
include_once "BasicState.php";

class BasicStateFactory extends StateFactory
{
  public function createStatus(): State
  {
    return new BasicState();
  }
}
