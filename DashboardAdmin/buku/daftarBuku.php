<?php
if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: ../../DashboardPetugas/index.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: ../DashboardAdmin/index.php");
    exit;
  }
}
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: ../../sign/admin/login_admin.php");
  exit();
}
include "../../config/config.php";
$buku = queryReadData("SELECT * FROM buku order by id_buku desc");
$kategori = queryReadData("SELECT * FROM kategori_buku");
$query = mysqli_query($connection, "SELECT max(id_buku) as kodeTerbesar FROM buku");
$dataid = mysqli_fetch_array($query);
$kodebuku = $dataid['kodeTerbesar'];
$urutan = (int) substr($kodebuku, -4, 4);
$urutan++;
$huruf = "KB";
$kodebuku = $huruf . sprintf("%04s", $urutan);
// mengaktifkan tombol search engine
if (isset($_POST["search"])) {
  //buat variabel dan ambil apa saja yg diketikkan user di dalam input dan kirimkan ke function search.
  $buku = search($_POST["keyword"]);
}
if (isset($_POST["tambah"])) {

  if (tambahBuku($_POST) > 0) {
    echo "<script>alert('Data berhasil ditambah.');window.location='daftarBuku.php';</script>";
  } else {
    echo "<script>
      alert('Data buku gagal ditambahkan!');
      </script>";
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <link rel="stylesheet" href="../../assets/dashboard/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../assets/dashboard/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/dashboard/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets/dashboard/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../assets/dashboard/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../assets/dashboard/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../assets/dashboard/css/vertical-layout-light/style.css">
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
                  <h4 class="card-title">Daftar Buku</h4>
                  <p class="card-description">
                  </p>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Tambah Buku
                  </button>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            No
                          </th>
                          <th>
                            Cover
                          </th>
                          <th>
                            Judul
                          </th>
                          <th>
                            Kategori
                          </th>
                          <th>
                            Pengarang
                          </th>
                          <th>
                            Penerbit
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($buku as $item) : ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="70px" height="100px" style="border-radius: 5px;"></td>
                            <td><?= $item["judul"]; ?></td>
                            <td><?= $item["kategori"]; ?></td>
                            <td><?= $item["pengarang"]; ?></td>
                            <td><?= $item["penerbit"]; ?></td>
                            <td>
                              <div>
                                <a title="detail" class="btn btn-success" style="width: 80px;" href="detailBuku.php?id_buku=<?= $item['id_buku']; ?>"> Detail</a>
                              </div>
                              <div>
                                <a href="editBuku.php?id_buku=<?= $item['id_buku']; ?>" class="btn btn-warning mt-1" style="width: 80px;">Edit</a>
                              </div>
                              <div>
                                <a href="deleteBuku.php?id_buku=<?= $item["id_buku"]; ?>" class="btn btn-danger mt-1" style="width: 80px;" onclick="return confirm('Yakin ingin menghapus data Buku ?');"> Hapus</a>
                              </div>
                            </td>

                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="modal" id="myModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <form action="" method="post" enctype="multipart/form-data">
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Buku</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                        <div class="custom-css-form">
                          <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Cover Buku</label>
                            <input class="form-control" type="file" name="cover" id="cover" required>
                          </div>

                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Id Buku</label>
                            <input type="text" class="form-control" name="id_buku" id="id_buku" placeholder="example inf01" value="<?= $kodebuku; ?>" readonly style="background-color: #f0f0f0;">
                          </div>
                        </div>

                        <div class="input-group mb-3">
                          <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                          <select class="form-select" id="kategori" name="kategori">
                            <option selected>Choose</option>
                            <?php foreach ($kategori as $item) : ?>
                              <option><?= $item["kategori"]; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book"></i></span>
                          <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Buku" aria-label="Username" aria-describedby="basic-addon1" required>
                        </div>

                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Pengarang</label>
                          <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="nama pengarang" required>
                        </div>

                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
                          <input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="nama penerbit" required>
                        </div>

                        <label for="validationCustom01" class="form-label">Tahun Terbit</label>
                        <div class="input-group mt-0">
                          <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                          <input type="date" class="form-control" name="thn_terbit" id="thn_terbit" required>
                        </div>

                        <label for="validationCustom01" class="form-label">Jumlah Halaman</label>
                        <div class="input-group mt-0">
                          <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book-open"></i></span>
                          <input type="number" class="form-control" name="jml_halaman" id="jml_halaman" required>
                        </div>

                        <div class="form-floating mt-3 mb-3">
                          <textarea class="form-control" placeholder="sinopsis tentang buku ini" name="deskripsi" id="deskripsi" style="height: 100px"></textarea>
                          <label for="floatingTextarea2">Deskripsi</label>
                        </div>

                        <div class="custom-css-form">
                          <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Isi Buku</label>
                            <input class="form-control" type="file" name="isi_buku" id="isi_buku" required>
                          </div>


                          <button class="btn btn-success" type="submit" name="tambah">Tambah</button>
                          <input type="reset" class="btn btn-warning text-light" value="Reset">
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
              </div>
            </footer>
            <!-- partial -->
          </div>
        </div>

      </div>
      </header>

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