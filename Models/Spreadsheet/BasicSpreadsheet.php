<?php

include_once "Spreadsheet.php";
include_once "../Controllers/MySqlDB.php";
/**
 * To do Basic Spreadsheet, based on Spreadsheet bases
 */
class BasicSpreadsheet extends Spreadsheet
{
  private int $id;
  private float $salarioB;
  private int $extra;
  private string $date;
  private int $employee;
  /**
   * @return a new instance of Basic spreadsheet
   */
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }
  /**
   * Define data to represent an Spreadsheet
   * @param id 
   * @param $salarioB
   * @param $extra
   * @param $date
   * @param $employee
   */
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
  /**
   * Function capable of reading data into the database 
   * @return a query to read spreadsheet 
   */
  public function read($start, $end)
  {
    return $this->connection->query("SELECT * FROM `spreadsheet` WHERE date BETWEEN " . str_replace('-', '', $start) . " AND " . str_replace('-', '', $end) . " ORDER BY date ASC");
  }
/**
 * The employee of the object used is obtained
 */
  public function getEmployee(int $id)
  {
    return $this->connection->query("SELECT * FROM employee WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
  }
/**
 * identify the object instance of type Spreadsheet
 * @param id A specific Spreadsheet is obtained 
 */
  public function identify(int $id)
  {
    $this->id = $id;
  }
/**
 * Function capable of deleting data in the database 
 * @return Shows a confirmation message
 */
  public function delete()
  {
    $stm = $this->connection->prepare("DELETE FROM spreadsheet WHERE id = :id");
    return $stm->execute(["id" => $this->id]);
  }
  /**
   * Function capable of updating the data of the Spreadsheet type objects
   * @param id 
   * @param $salarioB
   * @param $extra
   * @param $date
   * @param $employee
   */
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
/**
 * @return the value of extra
 */
  public function getExtraValue($id)
  {
    return $this->connection->query("SELECT extra
    FROM employee e
    INNER JOIN job j
    ON e.id = $id and e.job = j.id;")->fetch(PDO::FETCH_ASSOC)['extra'];
  }
  /**
   * Function capable of Saving data to the database 
   * @param id 
   * @param $salarioB
   * @param $extra
   * @param $date
   * @param $employee
   */
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
/**
 * @return the id of the object used 
 */
  public function getOne($id)
  {
    return $this->connection->query("SELECT * FROM spreadsheet WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
  }
}
