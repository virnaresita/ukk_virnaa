<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../sign/admin/login_admin.php");
    exit();
}
require "../../config/config.php";

$member = queryReadData("SELECT * FROM user");

if (isset($_POST["search"])) {
    $member = searchAdmin($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Madya Perpus </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/dashboard/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/dashboard/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/dashboard/images/favicon.png" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container-scroller">
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="../../DashboardAdmin/index.php">
                        <img src="../../assets/dashboard/images/logo.svg" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="../../DashboardAdmin/index.php">
                        <img src="../../assets/img/profil.png" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="" method="post" class="mt-3">
                            <div class="input-group d-flex justify-content-end mb-3">
                                <input class="border p-2 rounded rounded-end-2 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="cari data member...">
                                <button class="border border-start-2 bg-light rounded rounded-start-2" type="submit" name="search"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../../assets/img/profil.png" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../../assets/img/profil.png" style="width: 35px; height: 20x;" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold"><span class="text-capitalize text-black fw-bold"><?php echo $_SESSION['username']; ?></span></h1>
                                </p>
                                <p class="fw-bold text-muted mb-0">Admin</p>
                            </div>
                            <a class="dropdown-item" href="../../DashboardAdmin/signOut.php"> <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Forms and Datas</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="menu-icon mdi mdi-account-multiple"></i>
                            <span class="menu-title">User</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="user.php">Daftar Akun</a></li>
                                <li class="nav-item"> <a class="nav-link" href="../member/member.php">Daftar Member</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                            <i class="menu-icon mdi mdi-book"></i>
                            <span class="menu-title">Data Buku</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="../buku/daftarBuku.php">Daftar Buku</a></li>
                                <li class="nav-item"><a class="nav-link" href="../kategori/data-kategori.php">Daftar Kategori</a></li>
                            </ul>
                        </div>
                    </li>
                    <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="../peminjaman/peminjamanBuku.php">
                  <i class="mdi mdi mdi-bookmark menu-icon"></i>
                  <span class="menu-title">Daftar Peminjaman</span>
                </a>
              </li>
              </li>
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="../signOut.php">
                  <i class="mdi mdi mdi-logout menu-icon"></i>
                  <span class="menu-title">Keluar</span>
                </a>
              </li>
              </li>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Daftar User</h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Tambah Akun
                                    </button>
                                    <div class="table-responsive pt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Username
                                                    </th>
                                                    <th>
                                                        Sebagai
                                                    </th>
                                                    <th>
                                                        Password
                                                    </th>
                                                    <th>
                                                        No Hp
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <?php foreach ($member as $item) :
                                                $id = $item['id'];
                                            ?>
                                                <tr>
                                                    <td><?= $item["username"]; ?></td>
                                                    <td><?= $item["sebagai"]; ?></td>
                                                    <td><?= $item["password"]; ?></td>
                                                    <td><?= $item["no_telp"]; ?></td>
                                                    <td>
                                                        <?php if ($item['username'] !== 'abi') : ?>
                                                            <center>
                                                                <div class="action">
                                                                    <button title="edit" data-toggle="modal" data-target="#editModal<?= $item['id']; ?>" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i>Edit</button>
                                                                    <a href="deleteAdmin.php?id=<?= $item["id"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data admin/petugas ?');">
                                                                        <i class="ti ti-deleted"></i>Hapus
                                                                    </a>
                                                                <?php else : ?>
                                                                    <!-- Additional condition if needed for 'welen' user -->
                                                                    <span class="text-muted text-black fw-bold">Tidak dapat dihapus</span>
                                                                <?php endif; ?>
                                                                </div>
                                                    </td>
                                                </tr>
                                                <!-- The Modal -->
                                                <div class="modal fade" id="editModal<?= $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $id; ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="editModalLabel<?= $id; ?>">Edit Akun - <?= $item['username']; ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </center>
                                                                </div>
                                                                <!-- Modal Body -->
                                                                <div class="modal-body">
                                                                    <label for="username">Username</label>
                                                                    <input type="text" id="username" name="username" class="form-control" value="<?= $item['username']; ?>">
                                                                    <label for="password">Password</label>
                                                                    <input type="text" id="password" name="password" class="form-control" value="<?= $item['password']; ?>">
                                                                    <label for="no_telp">No Hp</label>
                                                                    <input type="text" id="no_telp" name="no_telp" class="form-control" value="<?= $item['no_telp']; ?>">

                                                                    <label>Sebagai</label>
                                                                    <select name="sebagai" class="form-control" required>
                                                                        <option value="">Pilih Sebagai</option>
                                                                        <option value="admin">admin</option>
                                                                        <option value="petugas">petugas</option>
                                                                    </select>
                                                                    <input type="hidden" name="id" value="<?= $id; ?>">

                                                                </div>
                                                                <!-- Modal Footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Close</button>
                                                                    <button type="submit" class="btn btn-sm btn-primary" name="update"><i class="fa fa-plus mr-2"></i>Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            endforeach; ?>
                                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                <!-- Modal Content -->
                                            </div>
                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                            <?php
                                            if (isset($_POST['user'])) {
                                                $username = $_POST['username'];
                                                $password = $_POST['password'];
                                                $no_telp = $_POST['no_telp'];
                                                $sebagai = $_POST['sebagai'];
                                                

                                                // Check if the username already exists
                                                $checkQuery = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");
                                                if (mysqli_num_rows($checkQuery) > 0) {
                                                    echo "<div class='alert alert-warning'>
                                                          <strong>Failed!</strong> Username already exists. Redirecting you back in 1 second.
                                                          </div>";
                                                    echo "<meta http-equiv='refresh' content='1; url= user.php'/>";
                                                    exit; // Stop further execution
                                                }

                                                // If the username is unique, proceed with the insert
                                                $insertQuery = mysqli_query($connection, "INSERT INTO user VALUES('', '$username', '$password', '$no_telp','$sebagai')");
                                                if ($insertQuery) {
                                                    echo "<div class='alert alert-success'>
                                                          <strong>Success!</strong> Redirecting you back in 1 second.
                                                          </div>";
                                                }

                                                echo "<meta http-equiv='refresh' content='1; url= user.php'/>";
                                            };
                                            if (isset($_POST['update'])) {
                                                $id = $_POST['id'];
                                                $username = $_POST['username'];
                                                $password = $_POST['password'];
                                                $no_telp = $_POST['no_telp'];
                                                $sebagai = $_POST['sebagai'];
                                               

                                                $updatedata = mysqli_query($connection, "update user set username='$username', password='$password', no_telp='$no_telp', sebagai='$sebagai' where id='$id'");

                                                //cek apakah berhasil
                                                if ($updatedata) {

                                                    echo " <div class='alert alert-success'>
                                                        <strong>Success!</strong> Redirecting you back in 1 seconds.
                                                      </div>
                                                    <meta http-equiv='refresh' content='1; url= user.php'/>  ";
                                                } else {
                                                    echo "<div class='alert alert-warning'>
                                                        <strong>Failed!</strong> Redirecting you back in 1 seconds.
                                                      </div>
                                                     <meta http-equiv='refresh' content='1; url= user.php'/> ";
                                                }
                                            };
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Akun Baru</h4>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username" required="required" placeholder="Username" autocomplete="off" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="text" name="password" id="password" required="required" placeholder="Password" autocomplete="off" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_telp">No Hp</label>
                                                <input type="text" name="no_telp" id="no_telp" required="required" placeholder="no_telp" autocomplete="off" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Sebagai</label>
                                                <select name="sebagai" class="form-control" required>
                                                    <option value="">Pilih Sebagai</option>
                                                    <option value="admin">admin</option>
                                                    <option value="petugas">petugas</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary" name="user"><i class="fa fa-plus"></i> Tambah</button>
                                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                                                <a href="../akun/user.php" class="btn btn-sm btn-secondary"><i class="fa fa-reply"></i> Kembali</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial -->
            </div>
        </div>
    </div>
    <script src="../../assets/dashboard/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../../assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/dashboard/js/off-canvas.js"></script>
    <script src="../../assets/dashboard/js/hoverable-collapse.js"></script>
    <script src="../../assets/dashboard/js/template.js"></script>
    <script src="../../assets/dashboard/js/settings.js"></script>
    <script src="../../assets/dashboard/js/todolist.js"></script>
    <script src="//code.iconify.design/1/1.0.6/iconify.min.js"></script>
</body>

</html>