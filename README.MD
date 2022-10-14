
<code>
<?php
  include_once "./Model/BasicEmployeeFactory.php";

  $factory = new BasicEmployeeFactory();
  $employee = $factory->createEmployee();

  // $employee->setData(5, 'Miguel', 'Hernandez', 'testing@gmail.com', 1, '88888888', date('YYYY:MM:DD'), 1, 1);
  // $employee->save();

  // $employee->identify(5);
  // $employee->delete();

  $employees = $employee->read();
  foreach ($employees as $item) {
    echo "<div>" . $item['first_name'] . "</div>";
  }
  ?>
</code>