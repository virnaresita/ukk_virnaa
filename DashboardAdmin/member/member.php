<?php
if (isset($_SESSION['sebagai'])) {
    if ($_SESSION['sebagai'] == 'petugas') {
        header("Location: DashboardPetugas/index.php");
        exit;
    } elseif ($_SESSION['sebagai'] == 'admin') {
        header("Location: DashboardAdmin/index.php");
        exit;
    }
}
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../sign/admin/login_admin.php");
    exit();
}
require "../../config/config.php";

$member = queryReadData("SELECT * FROM member");

if (isset($_POST["search"])) {
    $member = searchMember($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
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
                                <li class="nav-item"> <a class="nav-link" href="../akun/user.php">Daftar Akun</a></li>
                                <li class="nav-item"> <a class="nav-link" href="member.php">Daftar Member</a></li>
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
                                    <h4 class="card-title">Daftar Member</h4>
                                    <p class="card-description">
                                    </p>
                                    <div class="table-responsive pt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                <th>
                                                        NO
                                                    </th>
                                                    <th>
                                                        NISN
                                                    </th>
                                                    <th>
                                                        Nama
                                                    </th>
                                                    <th>
                                                        Kelas
                                                    </th>
                                                    <th>
                                                        Jurusan
                                                    </th>
                                                    <th>
                                                        Alamat
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $no = 1;
                                            foreach ($member as $item) :
                                                $nisn = $item['nisn']; ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $item["nisn"]; ?></td>
                                                    <td><?= $item["nama"]; ?></td>
                                                    <td><?= $item["kelas"]; ?></td>
                                                    <td><?= $item["jurusan"]; ?></td>
                                                    <td><?= $item["alamat"]; ?></td>
                                                    <td>
                                                        <div class="action">
                                                            <div>
                                                                <button type="button" class="btn btn-warning" style="width: 80px;" data-bs-toggle="modal" data-bs-target="#edit<?= $nisn; ?>">
                                                                    Edit
                                                                </button>
                                                            </div>
                                                            <div>
                                                                <a href="deleteMember.php?id=<?= $item["nisn"]; ?>" class="btn btn-danger mt-1" style="width: 80px;" onclick="return confirm('Yakin ingin menghapus data member ?');">Hapus </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- The Modal -->
                                                <div class="modal fade" id="edit<?= $nisn; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Member - <?= $item['nama']; ?></h4>
                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="modal-body">

                                                                    <label for="nisn">NISN</label>
                                                                    <input type="text" id="nisn" name="nisn" class="form-control" value="<?= $item['nisn']; ?>">

                                                                    <label for="nama">Nama</label>
                                                                    <input type="text" id="nama" name="nama" class="form-control" value="<?= $item['nama'] ?>" ;>

                                                                    <label for="password">Password</label>
                                                                    <input type="text" id="password" name="password" class="form-control" value="<?= $item['password']; ?>">

                                                                    <label>Kelas</label>
                                                                    <select name="kelas" class="form-control">
                                                                        <option class="hidden" selected disabled>Pilih Kelas</option>
                                                                        <option value="X">X</option>
                                                                        <option value="XI">XI</option>
                                                                        <option value="XII">XII</option>
                                                                    </select>

                                                                    <label>Jurusan</label>
                                                                    <select name="jurusan" class="form-control">
                                                                        <option class="hidden" selected disabled>Pilih Jurusan</option>
                                                                        <option value="Otomatisasi dan Tata Kelola Perkantoran">Otomatisasi dan Tata Kelola Perkantoran</option>
                                                                        <option value="Akuntansi dan Keuangan Lembaga">Akuntansi dan Keuangan Lembaga</option>
                                                                        <option value="Bisnis Daring dan Pemasaran">Bisnis Daring dan Pemasaran</option>
                                                                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                                                        <option value="Multimedia">Multimedia</option>
                                                                    </select>

                                                                    <label for="alamat">Alamat</label>
                                                                    <input type="text" id="alamat" name="alamat" class="form-control" value="<?= $item['alamat']; ?>">

                                                                    <input type="hidden" name="nisn" value="<?= $nisn; ?>">

                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <a href="member.php" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                                                                    <button type="submit" class="btn btn-sm btn-primary" name="update"><i class="fa fa-plus mr-2"></i>Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                            <?php
                                            // Edit
                                            if (isset($_POST['update'])) {
                                                $nisn = $_POST['nisn'];
                                                $nama = $_POST['nama'];
                                                $password = $_POST['password'];
                                                $kelas = $_POST['kelas'];
                                                $jurusan = $_POST['jurusan'];
                                                $alamat = $_POST['alamat'];

                                                $updatedata = mysqli_query($connection, "update member set nama='$nama', password='$password', kelas='$kelas', jurusan='$jurusan', alamat='$alamat' where nisn='$nisn'");

                                                //cek apakah berhasil
                                                if ($updatedata) {

                                                    echo " <div class='alert alert-success'>
                            <strong>Success!</strong> Redirecting you back in 1 seconds.
                          </div>
                        <meta http-equiv='refresh' content='1; url= member.php'/>  ";
                                                } else {
                                                    echo "<div class='alert alert-warning'>
                            <strong>Failed!</strong> Redirecting you back in 1 seconds.
                          </div>
                         <meta http-equiv='refresh' content='1; url= member.php'/> ";
                                                }
                                            };
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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