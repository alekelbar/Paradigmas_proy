<?php
include_once "Employee.php";

class BasicEmployee extends Employee
{

  // Atributos clasicos del empleado base...
  private $employee_id;
  private $first_name;
  private $last_name;
  private $email;
  private $state;
  private $phone_number;
  private $hire_date;
  private $job_id;
  private $department_id;

  // !TODO: hacer todos los metodos getter y setter

  public function __construct($connection)
  {
    $this->connection = $connection->connect();
  }

  public function save()
  {
    $this->connection->prepare("INSERT INTO employee (Employee_id, first_name, last_name, email, phone_number, hire_date, job_id, department_id, state) VALUES (:id , :name , :lname , :email , :phone , :hire , :job , :dept , :sta )");

    $this->connection->execute([
      'id' => $this->employee_id,
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
    return $this->connection->query('SELECT * FROM employee');
  }
  public function delete()
  {
  }
  public function update()
  {
  }

  public function getName()
  {
    return   $this->first_name;
  }
}
