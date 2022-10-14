<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de gestión de empleados</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="index.css">
  <script src="https://kit.fontawesome.com/e272832d5f.js" crossorigin="anonymous"></script>
</head>


<body>
  <?php
  include_once 'Views/Navbar.php';
  ?>

  <?php
  include_once "./Models/employees/BasicEmployeeFactory.php";

  $factory = new BasicEmployeeFactory();
  $employee = $factory->createEmployee();
  $filter = '0';
  if (isset($_POST["filter"])) {
    $filter = $_POST["filter"];
  }

  ?>
  <div class="vh-100 bg-light vw-100 pt-3 main">
    <div class="container-md">
      <form class="my-3" method="POST" action="">
        <select class="form-select" name="filter" onchange="this.form.submit()">
          <option value="0" <?php if ($filter == '0') {
                              echo 'selected';
                            } ?>>All</option>
          <option value="1" <?php if ($filter == '1') {
                              echo 'selected';
                            } ?>>Hired</option>
          <option value="2" <?php if ($filter == '2') {
                              echo 'selected';
                            } ?>>Sub contract</option>
          <option value="3" <?php if ($filter == '3') {
                              echo 'selected';
                            } ?>>Permanent</option>
        </select>
      </form>

      <table class="table table-responsive table-dark">
        <thead>
          <th class="text-center" scope="row">#</th>
          <th class="text-center" scope="row">First Name</th>
          <th class="text-center" scope="row">Last Name</th>
          <th class="text-center" scope="row">Email</th>
          <th class="text-center" scope="row">Phone Number</th>
          <th class="text-center" scope="row">Department</th>
          <th class="text-center" scope="row">Job</th>
          <th class="text-center" scope="row">Manage</th>
        </thead>
        <tbody>
          <?php
          if (isset($_GET['action']) == 'delete') {
            $id = $_GET['data']; // identificador unico del empleado...

            $employee->identify($id);
            if (!($employee->delete())) {
              echo '<div class="alert alert-danger" role="alert">Cannot delete, because it\'s related with a department</div>';
            } else {
              echo '<div class="alert alert-success" role="alert">Employee Successfully delete!</div>';
            }
          }
          $employee->setFilter($filter);
          $employees = $employee->read();
          $index = 0;
          if ($employees->rowCount() != 0) {
            foreach ($employees as $item) {

              // identificar el empleado...
              $employee->setDepartment($item['dept']);
              $employee->setJob($item['job']);
              echo
              '<tr class="table table-item">' .
                ' <th class="text-center" scope="row">' . $index + 1 . '</th>' .
                ' <td class="text-center">' . $item['f_name'] . '</td>' .
                ' <td class="text-center">' . $item['l_name'] . '</td>' .
                ' <td class="text-center">' . $item['email'] . '</td>' .
                ' <td class="text-center">' . $item['phone'] . '</td>' .
                ' <td class="text-center">' . $employee->getDepartment($item['dept'])['name'] . '</td>' .
                ' <td class="text-center">' . $employee->getJob($item['job'])['name'] . '</td>' .
                ' <td class="text-center">' .
                '
            <a href="Views\edit.php?action=edit&data=' . $item['id'] . '" class="btn btn-success mx-2">
              <i class="fa-solid fa-pen-to-square"></i>
            </a>' .

                '<a href="index.php?action=delete&data=' . $item['id'] . '" class="btn btn-danger">
              <i class="fa-solid fa-trash"></i>
            </a>' .

                '</td>' .
                '</tr>';
              $index++;
            }
          } else {
            echo '<th scope="row">' . 'No data found' . '</th>';
          }
          ?>
        </tbody>
      </table>
      <?php include_once './Views/footer.php' ?>
</body>

</html>