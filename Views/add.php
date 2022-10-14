<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="index.css">
  <script src="https://kit.fontawesome.com/e272832d5f.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  include_once 'Navbar.php';
  include_once '../Models/departments/BasicDepartmentFactory.php';
  include_once '../Models/jobs/BasicJobFactory.php';
  include_once '../Models/states/BasicStateFactory.php';
  include_once '../Models/employees/BasicEmployeeFactory.php';
  session_start();


  $deptFactory = new BasicDepartmentFactory();
  $stateFactory = new BasicStateFactory();
  $jobFactory = new BasicJobFactory();
  $employeeFactory = new BasicEmployeeFactory();

  $dept = $deptFactory->createDepartment();
  $state = $stateFactory->createStatus();
  $job = $jobFactory->createJob();
  $employee = $employeeFactory->createEmployee();

  if (isset($_POST['IName'])) {
    $name = $_POST['IName'];
    $last = $_POST['Ilname'];
    $email = $_POST['Iemail'];
    $phone = $_POST['Iphone'];
    $date = $_POST['Idate'];
    $job = $_POST['Ijob'];
    $state = $_POST['Istate'];
    $dept = $_POST['Idept'];
    $employee->setData(0, $name, $last, $email, $state, $phone, $date, $job, $dept);
    $employee->save();
    // redirigir a la lista...
    header('location: ' . 'http://localhost/proy_paradigmas/index.php');
  }

  $depts = $dept->read();
  $jobs = $job->read();
  $states = $state->read();

  ?>
  <div class="bg-light vw-100 pt-3 py-4">
    <div class="container-md  py-3">

      <form method="post" action="" class="form-control">

        <label for="InputName" class="fw-semibold form-label my-3">What's your name?</label>
        <input name="IName" type="text" class="form-control" id="InputName" aria-describedby="name" required>
        <div id="name" class="form-text">We need to identified it.</div>

        <label for="InputLName" class="fw-semibold form-label my-3">What's your last name?</label>
        <input name="Ilname" type="text" class="form-control" id="InputLName" aria-describedby="lastName" required>
        <div id="lastName" class="form-text">We need to identified it.</div>

        <label for="InputEmail" class="fw-semibold form-label my-3">What's your Email?</label>
        <input name="Iemail" type="email" class="form-control" id="InputEmail" aria-describedby="email" required>
        <div id="email" class="form-text">We need to contact to you.</div>

        <label for="InputPhone" class="fw-semibold form-label my-3">What's your phone number?</label>
        <input name="Iphone" min="0" type="number" class="form-control" id="InputPhone" aria-describedby="phone" required>
        <div id="phone" class="form-text">We need to contact to you.</div>

        <label for="InputDate" class="fw-semibold form-label my-3">What's your hire date?</label>
        <input name="Idate" type="date" class="form-control" id="InputDate" aria-describedby="date" required>
        <div id="date" class="form-text">it's important to now.</div>

        <label for="InputJob" class="fw-semibold form-label my-3">What's your Job?</label>
        <select required id="InputJob" class=" form-select" name="Ijob">
          <?php
          if ($jobs->rowCount() > 0) {
            foreach ($jobs as $job) {
              echo '<option' . (($job['id'] == $data['job']) ? ' Selected ' : '') . ' value="' . $job['id'] . '">' . $job['name'] . '</option>';
            }
          }
          ?>
        </select>
        <div id="jobs" class="form-text">What's your job?</div>


        <label for="InputState" class="fw-semibold form-label my-3">What's your state?</label>
        <select require id="InputState" class=" form-select" name="Istate">
          <?php

          if ($states->rowCount() > 0) {
            foreach ($states as $state) {
              echo '<option ' . (($state['id'] == $data['state']) ? ' Selected ' : '') . ' value="' . $state['id'] . '">' . $state['name'] . '</option>';
            }
          }
          ?>
        </select>

        <div id="state" class="form-text">What's your job?</div>

        <label for="InputDept" class="fw-semibold form-label my-3">What's your department?</label>
        <select require id="InputDept" class=" form-select" name="Idept">
          <?php

          if ($depts->rowCount() > 0) {
            foreach ($depts as $dept) {
              echo '<option ' . (($dept['id'] == $data['dept']) ? ' Selected ' : '') . ' value="' . $dept['id'] . '">' . $dept['name'] . '</option>';
            }
          }
          ?>
        </select>
        <div id="state" class="form-text">What's your job?</div>
        <input type="submit" class="my-3 btn btn-success fs-6" value="Send" />
      </form>
      <?php include_once 'footer.php' ?>
</body>

</html>