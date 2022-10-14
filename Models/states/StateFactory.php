<?php

declare(strict_types=1);
include_once "State.php";

abstract class StateFactory
{
  protected abstract function createStatus(): State;
}
