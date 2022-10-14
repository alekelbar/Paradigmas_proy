<?php

include_once "Spreadsheet.php";
include_once "../Controllers/MySqlDB.php";

class BasicSpreadsheet extends Spreadsheet
{

  // Datos de la entidad...
  private string $id;
  private float $salarioB;
  private float $salarioN;
  private float $extra;
  private int $employee;

  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }

  public function setData(
    string $id,
    float $salarioB,
    float $salarioN,
    float $extra,
    int $employee,
  ) {
    $this->id = $id;
    $this->salarioB = $salarioB;
    $this->salarioN = $salarioN;
    $this->extra = $extra;
    $this->employee = $employee;
  }

  public function read()
  {
    return $this->connection->query("SELECT * FROM spreadsheet");
  }

  public function getEmployee(int $id)
  {
    return $this->connection->query("SELECT * FROM employee WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
  }

  public function identify(int $id)
  {
    $this->id = $id;
  }

  public function delete()
  {
    $stm = $this->connection->prepare("DELETE FROM spreadsheet WHERE id = :id");
    return $stm->execute(["id" => $this->id]);
  }

  public function update()
  {
  }

  public function save()
  {
  }
}
