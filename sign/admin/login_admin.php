<?php
session_start();
include "../../config/config.php";

if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: ../../DashboardPetugas/index.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: ../../DashboardAdmin/index.php");
    exit;
  }
}


if (isset($_POST['btn-login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


  // Query to check user credentials
  $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = $connection->query($query);

  if (mysqli_num_rows($result) === 1) {
    $_SESSION['username'] = true;
    $rows = mysqli_fetch_assoc($result);
    if ($rows['sebagai'] == 'petugas') {
      $_SESSION['sebagai'] = $rows['sebagai'];
      $_SESSION['username'] = $rows['username'];
      $_SESSION['id'] = $rows['id'];
      // $_SESSION['id'] = $rows['password'];
      return header("Location: ../../DashboardPetugas/index.php");

      if (isset($_SESSION['username'])) {
        header("Location: ../../DashboardPetugas/index.php");
        exit;
      }
    } elseif ($rows['sebagai'] == 'admin') {
      $_SESSION['sebagai'] = $rows['sebagai'];
      $_SESSION['username'] = $rows['username'];
      $_SESSION['id'] = $rows['id'];
      // $_SESSION['id'] = $rows['password'];
      return header("Location: ../../DashboardAdmin/index.php");


      if (isset($_SESSION['username'])) {
        header("Location: ../../DashboardAdmin/index.php");
        exit;
      }
    }
  } else {
    // Login failed
    echo "Invalid username or password";
  }
}
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-5 col-lg-7 col-xl-6">
          <img src="../../assets/img/NOVELL.png" class="img-fluid" alt="Phone image" height="300px" width="600px">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form action="" method="post">
            <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-3 mt-3">Login Admin 
            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form1Example13"> <i class="bi bi-person-circle"></i> Username</label>
              <input type="text" id="form1Example13" class="form-control form-control-lg py-3" name="username" autocomplete="off" placeholder="Nama" style="border-radius:25px ;" />

            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form1Example23"><i class="bi bi-chat-left-dots-fill"></i> Password</label>
              <input type="password" id="form1Example23" class="form-control form-control-lg py-3" name="password" autocomplete="off" placeholder="Pass" style="border-radius:25px ;" />

            </div>

            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
              <button class="btn btn-primary" type="submit" value="Sign in" name="btn-login" class="btn btn-warning btn-lg text-light my-2 py-3" style="width: 100%; height: 60px; border-radius: 30px; font-weight: 600; background-color: #bf00ff;">Sign In</button>
            </div>
            <center>
              <p><a href="../../sign/member/login.php" class="text-decoration-none text-primary">Back</a></p>
            </center>
          </form><br>

        </div>
      </div>
    </div>
  </section>

  <?php if (isset($error)) : ?>
    <div class="alert alert-danger mt-2" role="alert">Nama atau Password Salah!<div>
  <?php endif; ?>
  </div>

  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>