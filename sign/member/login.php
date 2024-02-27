<?php
session_start();
include "../../config/config.php";
if (isset($_POST['nisn']) && isset($_POST['nama'])) {
  // Get user input
  $nisn = $_POST['nisn'];
  $nama = $_POST['nama'];

// Query to check user credentials
$query = "SELECT * FROM member WHERE nisn='$nisn' AND nama='$nama'";
$result = $connection->query($query);

if ($result->num_rows == 1) {
    // Login successful
    $_SESSION['nama'] = $nama;
    $_SESSION['nisn'] = $nisn;
    header("Location: ../../DashboardMember/dashboard.php"); // Redirect to dashboard or any other page
} else {
    // Login failed
    echo "<script>alert('nis atau nama Anda salah. Silahkan coba lagi!')</script>";
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
  <link rel="stylesheet" href="../../assets/style.css">
</head>

<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-2">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <form action="" method="post">
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-3 mt-5">Login Member </p>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form1Example13"> <i class="bi bi-person-circle"></i>Nama</label>
                      <input type="text" id="form1Example13" class="form-control form-control-lg py-3" name="nama" autocomplete="off" placeholder="Nama" style="border-radius:25px ;" />

                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form1Example23"><i class="bi bi-chat-left-dots-fill"></i>NISN</label>
                      <input type="text" id="form1Example23" class="form-control form-control-lg py-3" name="nisn" autocomplete="off" placeholder="NISN" style="border-radius:25px ;" />

                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button class="btn btn-primary" type="submit" value="Sign in" name="signIn" class="btn btn-warning btn-lg text-light my-2 py-3" style="width: 100%; height: 60px; border-radius: 30px; font-weight: 600; background-color: #bf00ff;">Sign In</button>
                    </div>
<center>
                    <br>
                    <p><a href="../../sign/admin/login_admin.php"  class="btn btn-warning  text-light ms-2 py-3" style="width: 90%; height: 60px; border-radius: 30px; font-weight: 500; background-color: #bf00ff;">Admin</a></p>
                    <p>Buat Akun Disini<a href="../../sign/member/sign_up.php" class="text-decoration-none text-primary ms-2">Daftar</a></p>
                    <p>back to home <a href="../../index.php" class="text-decoration-none text-primary">back</a></p>
                  </form><br>
                </div>
</center>
                <div class="col-md-10 col-lg-6 col-xl-5 d-flex align-items-center order-1 order-lg-2">

<img src="../../assets/img/NOVELL.png" class="img-fluid" alt="Sample image" height="300px" width="500px">

</div>
              </div>
            </div>
          </div>
        </div>
        </div>
  </section>




  <?php if (isset($error)) : ?>
    <div class="alert alert-danger mt-2" role="alert">Nama / Nisn / Password tidak sesuai !
    </div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
