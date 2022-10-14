<?php

declare(strict_types=1);
include_once "Employee.php";
if (file_exists("Controllers/MySqlDB.php")) {
  include_once "Controllers/MySqlDB.php";
} else {
  include_once "../Controllers/MySqlDB.php";
}

/**
 * To do Basic employees, based on employees bases
 */
class BasicEmployee extends Employee
{

  private int $employee_id;
  private string $first_name;
  private string $last_name;
  private string $email;
  private int $state;
  private string $phone_number;
  private string $hire_date;
  private int $job_id;
  private int $department_id;
  private string $filter;

  /**
   * @return a new instance of Basic employee
   */
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }

  /**
   * Define filter to search employees
   */
  public function setFilter($filter)
  {
    $this->filter = $filter;
  }

  /**
   * Define data to represent an employee
   * @param employee_id 
   * @param first_name
   * @param last_name
   */
  public function setData(
    int $employee_id,
    string $first_name,
    string $last_name,
    string $email,
    int $state,
    string $phone_number,
    string $hire_date,
    int $job_id,
    int $department_id,
  ) {
    $this->employee_id = $employee_id;
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->email = $email;
    $this->state = $state;
    $this->phone_number = $phone_number;
    $this->hire_date = $hire_date;
    $this->job_id = $job_id;
    $this->department_id = $department_id;
  }

  public function identify(int $id)
  {
    $this->employee_id = $id;
  }

  public function setDepartment(int $id)
  {
    $this->department_id = $id;
  }

  public function setJob(int $id)
  {
    $this->job_id = $id;
  }

  public function setState(int $id)
  {
    $this->state = $id;
  }

  public function getState()
  {
    $state_query = $this->connection->query('SELECT e.name FROM state e where e.id = ' . $this->state);
    return $state_query->fetch(PDO::FETCH_ASSOC);
  }

  public function getDepartment()
  {
    $department = $this->connection->query('SELECT d.name FROM department d where id = ' . $this->department_id);
    return $department->fetch(PDO::FETCH_ASSOC);
  }

  public function getJob()
  {
    $job = $this->connection->query('SELECT j.name FROM job j WHERE j.id = ' . $this->job_id);
    return $job->fetch(PDO::FETCH_ASSOC);
  }

  public function save()
  {
    $prepareStm = $this->connection->prepare("INSERT INTO employee (f_name, l_name, email, phone, hire, job, dept, state) VALUES (:name , :lname , :email , :phone , :hire , :job , :dept , :sta )");



    $prepareStm->execute([
      'name' => $this->first_name,
      'lname' => $this->last_name,
      'email' => $this->email,
      'phone' => $this->phone_number,
      'hire' => $this->hire_date,
      'job' => $this->job_id,
      'dept' => $this->department_id,
      'sta' => $this->state
    ]);
  }

  public function read()
  {
    if ($this->filter == '0') {
      return $this->connection->query('SELECT * FROM employee');
    }
    return $this->connection->query('SELECT * FROM employee WHERE state = ' . $this->filter);
  }

  public function getOne(): PDOStatement
  {
    return $this->connection->query("SELECT * FROM employee WHERE id = " . $this->employee_id);
  }

  public function delete()
  {
    try {
      $prepareStm = $this->connection->prepare('DELETE FROM employee where id = :id');
      $res = $prepareStm->execute(['id' => $this->employee_id]);
      if (!$res) return 'El empleado se encuentra relacionado con otra entidad.';
      return $res;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function update()
  {
    $prepareStm = $this->connection->prepare('UPDATE employee SET id = :id, f_name = :fn, 
    l_name = :ln, email = :email, phone = :pn, hire = :hd,
    job = :jid, dept = :did , state = :st  WHERE id = ' . $this->employee_id);

    $res = $prepareStm->execute([
      'id' => $this->employee_id,
      'fn' => $this->first_name,
      'ln' => $this->last_name,
      'email' => $this->email,
      'pn' => $this->phone_number,
      'hd' => $this->hire_date,
      'jid' => $this->job_id,
      'did' => $this->department_id,
      'st' => $this->state,
    ]);

    if (!$res) {
      return 'Inconveniente al tratar de actualizar el registro D:';
    }
    return $res;
  }
}
