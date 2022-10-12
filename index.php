<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de gestión de empleados</title>
</head>


<body>
  <?php
  include_once "./Model/MySqlDB.php";
  include_once "./Model/BasicEmployeeFactory.php";

  $db = new MySqlDB();
  $db->connect();

  $factory = new BasicEmployeeFactory();
  $employee = $factory->createEmployee();
  $employees = $employee->read();
  foreach ($employees as $item) {
    echo "<div>" . $item['first_name'] . "</div>";
  }
  ?>

</body>

</html>