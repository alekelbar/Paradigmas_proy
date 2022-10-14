<?php

include_once "Spreadsheet.php";
include_once "../Controllers/MySqlDB.php";

class BasicSpreadsheet extends Spreadsheet
{

  // Datos de la entidad...
  private int $id;
  private float $salarioB;
  private int $extra;
  private string $date;
  private int $employee;

  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }

  public function setData(
    int $id,
    float $salarioB,
    int $extra,
    string $date,
    int $employee,
  ) {
    $this->id = $id;
    $this->salarioB = $salarioB;
    $this->extra = $extra;
    $this->date = $date;
    $this->employee = $employee;
  }

  public function read($start, $end)
  {
    return $this->connection->query("SELECT * FROM `spreadsheet` WHERE date BETWEEN " . str_replace('-', '', $start) . " AND " . str_replace('-', '', $end) . " ORDER BY date ASC");
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
    $stm = $this->connection->prepare("UPDATE spreadsheet SET employee_id = :em, sal_bruto = :sb, extra = :ex, date = :da where id = :id");
    return $stm->execute([
      "id" => $this->id,
      "em" => $this->employee,
      "sb" => $this->salarioB,
      "ex" => $this->extra,
      "da" => $this->date
    ]);
  }

  public function getExtraValue($id)
  {
    return $this->connection->query("SELECT extra
    FROM employee e
    INNER JOIN job j
    ON e.id = $id and e.job = j.id;")->fetch(PDO::FETCH_ASSOC)['extra'];
  }

  public function save()
  {
    var_dump(
      $this->employee,
      $this->salarioB,
      $this->salarioN,
      $this->extra,
      $this->date
    );

    $stm = $this->connection->prepare("INSERT INTO spreadsheet(employee_id, sal_bruto, extra, date) VALUES (:em, :sb, :ex, :da)");
    return $stm->execute([
      "em" => $this->employee,
      "sb" => $this->salarioB,
      "ex" => $this->extra,
      "da" => $this->date
    ]);
  }

  public function getOne($id)
  {
    return $this->connection->query("SELECT * FROM spreadsheet WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
  }
}
