<?php

abstract class State
{
  protected PDO | null $connection = null;
  public abstract function read();
}
