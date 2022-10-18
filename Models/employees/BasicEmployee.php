<?php

declare(strict_types=1);
include_once "Employee.php";
if (file_exists("Controllers/MySqlDB.php")) {
  include_once "Controllers/MySqlDB.php";
} else {
  include_once "../Controllers/MySqlDB.php";
}

/**
 * To do Basic employees, based on employees bases.
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
   * @return a new instance of Basic employee.
   */
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = MySqlDB::getInstance();
    }
  }

  /**
   * Define filter to search employees.
   */
  public function setFilter($filter)
  {
    $this->filter = $filter;
  }

  /**
   * Define data to represent an employee.
   * @param employee_id.
   * @param first_name.
   * @param last_name.
   * @param email.
   * @param state.
   * @param phone_number.
   * @param hire_date.
   * @param job_id.
   * @param department_id.
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

/**
 * identify the object instance of type employee.
 * @param id A specific employee is obtained .
 */
  public function identify(int $id)
  {
    $this->employee_id = $id;
  }
/**
 * The purpose of the department is established.
 * @param id A specific department is established.
 */
  public function setDepartment(int $id)
  {
    $this->department_id = $id;
  }
/**
 * The object of the work is established.
 * @param id A specific work is established.
 */
  public function setJob(int $id)
  {
    $this->job_id = $id;
  }
/**
 * It is established to the object with the different types of state, contracting.
 * @param id A specific contracting status is established for labor.
 */
  public function setState(int $id)
  {
    $this->state = $id;
  }
 /**
  * Object status is obtained.
  */
  public function getState()
  {
    $state_query = $this->connection->query('SELECT e.name FROM state e where e.id = ' . $this->state);
    return $state_query->fetch(PDO::FETCH_ASSOC);
  }
/**
 * The department of the object used is obtained.
 */
  public function getDepartment()
  {
    $department = $this->connection->query('SELECT d.name FROM department d where id = ' . $this->department_id);
    return $department->fetch(PDO::FETCH_ASSOC);
  }
/**
 * The job is obtained from the object type employee.
 */
  public function getJob()
  {
    $job = $this->connection->query('SELECT j.name FROM job j WHERE j.id = ' . $this->job_id);
    return $job->fetch(PDO::FETCH_ASSOC);
  }
/**
 * Function of saving data in the database.
 * @param f_name.
 * @param l_name.
 * @param email.
 * @param phone.
 * @param hire.
 * @param job.
 * @param dept.
 * @param state.
 */
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
  /**
   * Function capable of reading data into the database .
   * @return show by means of filters the different types of contracts.
   */
  public function read()
  {
    if ($this->filter == '0') {
      return $this->connection->query('SELECT * FROM employee');
    }
    return $this->connection->query('SELECT * FROM employee WHERE state = ' . $this->filter);
  }

/**
 * @return the id of the object used. 
 */
  public function getOne(): PDOStatement
  {
    return $this->connection->query("SELECT * FROM employee WHERE id = " . $this->employee_id);
  }
/**
 * Function capable of deleting data in the database. 
 * @return Shows a confirmation message.
 */
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
/**
 * Function of updating the data of the employee type objects.
 * @param id.
 * @param fn.
 * @param ln.
 * @param email.
 * @param pn.
 * @param hd.
 * @param jid.
 * @param did.
 * @param st.
 * @return Shows a confirmation message.
 */
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
