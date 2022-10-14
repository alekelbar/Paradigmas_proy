<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>add Spreadsheet</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="index.css">
  <script src="https://kit.fontawesome.com/e272832d5f.js" crossorigin="anonymous"></script>


</head>

<body>
  <?php

  include_once "./Navbar.php";

  include "../Models/Spreadsheet/BasicSpreadsheetFactory.php";
  include_once "../Models/employees/BasicEmployeeFactory.php";
  session_start();

  $spreadsheetFactory = new BasicSpreadsheetFactory();
  $employeeFactory = new BasicEmployeeFactory();
  $spreadsheet = $spreadsheetFactory->createSpreadsheet();
  $employee = $employeeFactory->createEmployee();

  if (isset($_POST['Ibruto'])) {
    $bruto = $_POST['Ibruto'];
    $extra = $_POST['Iextra'];
    $date = $_POST['Idate'];
    $employee = $_POST['Iemployee'];

    // var_dump($employee);
    $spreadsheet->setData(0, $bruto, $extra, $date, $employee);
    $spreadsheet->save();
    // redirigir a la lista...
    header('location: ' . 'http://localhost/proy_paradigmas/Views/Spreadsheet.php');
  }

  $employee->setFilter('0');
  $employees = $employee->read();

  ?>
  <div class="bg-light vw-100 pt-3 py-4">
    <div class="container-md  py-3">
      <form method="post" action="" class="form-control">

        <label for="InputBruto" class="fw-semibold form-label my-3">What's your basic salary?</label>
        <input required name="Ibruto" min="0" type="number" class="form-control" id="InputBruto" aria-describedby="phone">
        <div id="phone" class="form-text">We need to do some calculus.</div>

        <label for="InputExtra" class="fw-semibold form-label my-3">How many hours do you have more?</label>
        <input required name="Iextra" min=" 0"" type=" number" class="form-control" id="InputExtra" aria-describedby="phone">
        <div id="phone" class="form-text">We need to do some calculus.</div>

        <label for="InputDate" class="fw-semibold form-label my-3">What date it's corresponding?</label>
        <input required name="Idate" type="date" class="form-control" id="InputDate" aria-describedby="date">
        <div id="date" class="form-text">it's important to now.</div>

        <label for="InputEmployee" class="fw-semibold form-label my-3">Who it's corresponding?</label>
        <select required id="InputEmployee" class=" form-select" name="Iemployee">
          <?php
          if ($employees->rowCount() > 0) {
            foreach ($employees as $item) {
              echo '<option' . ' value="' . $item['id'] . '">' . $item['f_name'] . '</option>';
            }
          }
          ?>
        </select>
        <input type="submit" class="my-3 btn btn-success fs-6" value="Send" />

      </form>
      <?php include_once 'footer.php' ?>
    </div>
  </div>
</body>

</html>