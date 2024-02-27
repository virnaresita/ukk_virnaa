<?php
if (isset($_SESSION['sebagai'])) {
    if ($_SESSION['sebagai'] == 'petugas') {
        header("Location: ../../DashboardPetugas/index.php");
        exit;
    } elseif ($_SESSION['sebagai'] == 'admin') {
        header("Location: ../../DashboardAdmin/index.php");
        exit;
    }
}
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../sign/admin/login_admin.php");
    exit();
}

include "../../config/config.php";
$id = $_GET['id_buku'];
$kategori = queryReadData("SELECT * FROM kategori_buku");
$databuku = queryReadData("SELECT * FROM buku where id_buku = '$id' ");

if (isset($_POST["edit"])) {

    if (updateBuku($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah.');window.location='daftarBuku.php';</script>";
    } else {
        echo "<script>
        alert('Data buku gagal diubah!');
        </script>";
    }
}


//search buku
if (isset($_POST["search"])) {
    $databuku = search($_POST["keyword"]);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboar Admin</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../asset/css/styles.min.css" />
    <link rel="stylesheet" href="../../assets/dashboard/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../../assets/dashboard/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../assets/dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../assets/dashboard/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/dashboard/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/dashboard/images/favicon.png" />
</head>


<body>
    <!--  Body Wrapper -->
    <div class="container-scroller">


        <!-- Sidebar Start -->
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
                <ul class="navbar-nav ms-auto">
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
                            <a class="dropdown-item" href="../signOut.php"> <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
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
                                <li class="nav-item"> <a class="nav-link" href="../akun/user.php">Daftar Akun</a></li>
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
                                <li class="nav-item"><a class="nav-link" href="daftarBuku.php">Daftar Buku</a></li>
                                <li class="nav-item"><a class="nav-link" href="data-kategori.php">Daftar Kategori</a></li>
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
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-9 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Detail Buku</h4>
                                    <div class="table-responsive">
                                        <?php foreach ($databuku as $item) : ?>
                                            <div class="card-body">
                                                <form action="" method="post" enctype="multipart/form-data" class="mt-2 p-2">
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="custom-css-form">
                                                            <div class="mb-3">
                                                                <input type="hidden" name="coverLama" value="<?= $item["cover"]; ?>">
                                                                <img src="../../assets/imgDB/<?= $item["cover"]; ?>" width="84px" height="110px">
                                                                <label for="formFileMultiple" class="form-label">Cover Buku</label>
                                                                <input class="form-control" type="file" name="cover" id="formFileMultiple">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="form-label">Id Buku</label>
                                                                <input type="text" class="form-control" name="id_buku" id="id_buku" value="<?= $item['id_buku']; ?>" readonly style="background-color: #f0f0f0;">
                                                            </div>
                                                        </div>

                                                        <div class="input-group mb-3">
                                                            <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                                                            <select class="form-select" id="kategori" name="kategori" value="">
                                                                <option selected><?= $item["kategori"]; ?></option>
                                                                <?php foreach ($kategori as $p) : ?>
                                                                    <option value="<?= $p['kategori']; ?>"><?= $p["kategori"]; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Judul Buku</label>
                                                            <input type="text" class="form-control" name="judul" id="judul" value="<?= $item['judul']; ?>">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Pengarang</label>
                                                            <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= $item['pengarang']; ?>">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
                                                            <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $item['penerbit']; ?>">
                                                        </div>

                                                        <label for="validationCustom01" class="form-label">Tahun Terbit</label>
                                                        <div class="input-group mt-0">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                                                            <input type="date" class="form-control" name="thn_terbit" id="thn_terbit" value="<?= $item['thn_terbit']; ?>">
                                                        </div>

                                                        <label for="validationCustom01" class="form-label">Jumlah Halaman</label>
                                                        <div class="input-group mt-0">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book-open"></i></span>
                                                            <input type="number" class="form-control" name="jml_halaman" id="jml_halaman" value="<?= $item['jml_halaman']; ?>">
                                                        </div>

                                                        <div class="form-floating mt-3 mb-3">
                                                            <textarea class="form-control" placeholder="sinopsis tentang buku ini" name="deskripsi" id="deskripsi" style="height: 100px"><?= $item['deskripsi']; ?></textarea>
                                                            <label for="floatingTextarea2">Deskripsi</label>
                                                        </div>

                                                        <div class="custom-css-form">
                                                            <a href="daftarBuku.php" class="btn btn-warning"></i> Kembali</a>
                                                            <button class="btn btn-success" type="submit" name="edit">Edit</button>
                                                            <input type="reset" class="btn btn-danger text-light" value="Reset">
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php endforeach; ?>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Main JS -->
            <script src="../../assets/js/main.js"></script>
            <!-- plugins:js -->
            <script src="../../assets/dashboard/vendors/js/vendor.bundle.base.js"></script>
            <!-- endinject -->
            <!-- Plugin js for this page -->
            <script src="../../assets/dashboard/vendors/chart.js/Chart.min.js"></script>
            <script src="../../assets/dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
            <script src="../../assets/dashboard/vendors/progressbar.js/progressbar.min.js"></script>

            <!-- End plugin js for this page -->
            <!-- inject:js -->
            <script src="../../assets/dashboard/js/off-canvas.js"></script>
            <script src="../../assets/dashboard/js/hoverable-collapse.js"></script>
            <script src="../../assets/dashboard/js/template.js"></script>
            <script src="../../assets/dashboard/js/settings.js"></script>
            <script src="../../assets/dashboard/js/todolist.js"></script>
            <!-- endinject -->
            <!-- Custom js for this page-->
            <script src="../../assets/dashboard/js/dashboard.js"></script>
            <script src="../../assets/dashboard/js/Chart.roundedBarCharts.js"></script>
            <script src="//code.iconify.design/1/1.0.6/iconify.min.js"></script>

</body>

</html>