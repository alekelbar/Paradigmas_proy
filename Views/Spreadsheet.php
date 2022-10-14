<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Spreadsheet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../index.css">
  <script src="https://kit.fontawesome.com/e272832d5f.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php

  include_once "Navbar.php";
  include "../Models/Spreadsheet/BasicSpreadsheetFactory.php";
  include "../Models/taxes/TaxCalculator.php";

  $spreadsheetFactory = new BasicSpreadsheetFactory();
  $spreadsheet = $spreadsheetFactory->createSpreadsheet();


  if (isset($_GET['action']) == 'delete') {
    $id = $_GET['data']; // identificador unico del empleado...

    $spreadsheet->identify($id);
    if (!($spreadsheet->delete())) {
      echo '<div class="alert alert-danger" role="alert">Cannot delete, something was ocurrs</div>';
    } else {
      echo '<div class="alert alert-success" role="alert">spreadsheet Successfully delete!</div>';
    }
  }

  ?>

  <form method="post" action="" class="form-control">
    <div class="container">
      <div class="row">
        <div class="col">
          <p class="text-center fw-bold form-label my-3">start at?</p>
          <input required name="Idate1" type="date" class="form-control" id="InputDate" aria-describedby="date">
        </div>
        <div class="col">
          <p class="text-center fw-bold form-label my-3">End at?</p>
          <input required name="Idate2" type="date" class="form-control" id="InputDate" aria-describedby="date">
        </div>
      </div>
      <div class="row my-3">
        <div class="col d-flex justify-content-center">
          <input type="submit" class="btn btn-success w-50">
        </div>
      </div>
    </div>

  </form>

  <?php
  date_default_timezone_set('America/Managua');
  $mdate = new DateTime();

  if (isset($_POST['Idate1']))
    $data = $spreadsheet->read($_POST['Idate1'], $_POST['Idate2']);
  else
    $data = $spreadsheet->read('19500101', $mdate->format('Ymd'));
  ?>

  <div class="container-md">

    <div style="overflow-x:auto;" class="w-100 mx-auto">

      <table class="table table-responsive table-dark">
        <thead>
          <th class="text-center" scope="row">#</th>
          <th class="text-center" scope="row">Employee</th>
          <th class="text-center" scope="row">Basic Salary</th>
          <th class="text-center" scope="row">Grass Salary</th>
          <th class="text-center" scope="row">Net Salary</th>
          <th class="text-center" scope="row">wage reduction</th>
          <th class="text-center" scope="row">Over Time</th>
          <th class="text-center" scope="row">Date</th>
          <th class="text-center" scope="row">Manage</th>
        </thead>
        <tbody>
          <?php
          $index = 1;
          $bruto = 0;
          $neto = 0;
          $reb_lab = 0;
          $extra = 0;
          $base = 0;
          foreach ($data as $item) {

            $auxb = $item['sal_bruto'] + ($spreadsheet->getExtraValue($item['employee_id']) * $item['extra']);
            $auxn = round(TaxCalculator::cal($item['sal_bruto'] + ($spreadsheet->getExtraValue($item['employee_id']) * $item['extra']), 2));
            $auxr = $auxb - $auxn;

            echo
            '<tr class="table table-item">' .
              ' <th class="text-center" scope="row">' . $index . '</th>' .
              ' <td class="text-center fw-bold">' . $spreadsheet->getEmployee($item['employee_id'])['f_name'] . '</td>' .
              ' <td class="text-center">' . $item['sal_bruto'] . ' $' . '</td>' .
              ' <td class="text-center">' . $auxb . ' $' . '</td>' .
              ' <td class="text-center">' . $auxn . ' $' . '</td>' .
              ' <td class="text-center">' . $auxr . ' $' . '</td>' .
              ' <td class="text-center">' . $item['extra'] . '</td>' .
              ' <td class="text-center">' . $item['date'] . '</td>' .
              ' <td class="text-center">' .
              '
              <a href="http://localhost/proy_paradigmas/Views/EditSpr.php?action=edit&data=' . $item['id'] . '" class="btn btn-success mx-2">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>' .

              '<a href="http://localhost/proy_paradigmas/Views/Spreadsheet.php?action=delete&data=' . $item['id'] . '" class="btn btn-danger">
                <i class="fa-solid fa-trash"></i>
              </a>' .

              '</td>' .
              '</tr>';

            $bruto +=  $auxb;
            $base += $item['sal_bruto'];
            $neto += $auxn;
            $reb_lab += $auxr;
            $extra += $item['extra'];
            $index++;
          }
          echo
          '<tr class="table table-item">' .
            ' <th class="text-center" scope="row">' . $index . '</th>' .
            ' <td class="text-center fw-bold">' . 'Total: ' . '</td>' .
            ' <td class="text-center fw-bold">' . $base . ' $' . '</td>' .
            ' <td class="text-center fw-bold">' . $bruto . ' $' . '</td>' .
            ' <td class="text-center fw-bold">' . $neto . ' $' . '</td>' .
            ' <td class="text-center fw-bold">' . $reb_lab . ' $' . '</td>' .
            ' <td class="text-center fw-bold">' . $extra . '</td>';
          ?>
        </tbody>
      </table>
    </div>
    <?php include_once 'footer.php' ?>
</body>

</html>