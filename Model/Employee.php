<?php


abstract class Employee
{
  protected $connection; // de tipo DB
  protected abstract function save();
  protected abstract function read();
  protected abstract function delete();
  protected abstract function update();
}
