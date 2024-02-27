<?php
// memanggil file connection.php untuk membuat connection
include '../../config/config.php';

// mengecek apakah di url ada nilai GET id
if (isset($_GET['id'])) {
  // ambil nilai id dari url dan disimpan dalam variabel $id
  $id = ($_GET["id"]);

  // menampilkan data dari database yang mempunyai id=$id
  $query = "SELECT * FROM peminjaman
  INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
  WHERE peminjaman.id='$id'";
  $result = mysqli_query($connection, $query);

  // jika data gagal diambil maka akan tampil error berikut
  if (!$result) {
    die("Query Error: " . mysqli_errno($connection) .
      " - " . mysqli_error($connection));
  }
  // mengambil data dari database
  $item = mysqli_fetch_assoc($result);
  // apabila data tidak ada pada database maka akan dijalankan perintah ini
  if (!$item) {
    echo "<script>alert('Data tidak ditemukan pada database');window.location='peminjamanBuku.php';</script>";
  }
} else {
  // apabila tidak ada data GET id pada akan di redirect ke index.php
  echo "<script>alert('Masukkan data id.');window.location='peminjamanBuku.php';</script>";
}
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
$peminjaman = queryReadData("SELECT peminjaman.id AS peminjaman_id,
    buku.cover AS cover,
    buku.id_buku AS id_buku, 
    buku.judul AS judul,
    member.nisn AS nisn, 
    member.nama AS nama, 
    user.username AS username,
    peminjaman.tgl_pinjam AS tgl_pinjam,
    peminjaman.tgl_kembali AS tgl_kembali,
    peminjaman.harga AS harga,
    peminjaman.status AS status
    FROM peminjaman
    INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
    INNER JOIN member ON peminjaman.nisn = member.nisn
    INNER JOIN user ON peminjaman.id_user = user.id
    WHERE peminjaman.id='$id'");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboar Admin</title>
  <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../assets/css/styles.min.css" />
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
          <a class="navbar-brand brand-logo" href="../../DashboardPetugas/index.php">
            <img src="../../assets/dashboard/images/logo.svg" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="../../DashboardPetugas/index.php">
            <img src="../../assets/img/profil.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">

        </ul>
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
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="peminjamanBuku.php">
                <i class="mdi mdi-bookmark menu-icon"></i>
                <span class="menu-title">Daftar Peminjaman</span>
              </a>
            </li>
      </nav>
      <!--  Header End -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Basic Table</h4>
                  <p class="card-description">
                  <h6 class="m-0 font-weight-bold text-primary">Detail Peminjaman Buku - <?php echo $item['judul']; ?></h6>
                  </p>
                  <?php foreach ($peminjaman as $item) : ?>
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>Id Buku</td>
                            <td>:</td>
                            <td><b><?php echo $item['id_buku']; ?></b></td>
                          </tr>
                          <tr>
                            <td>Nisn</td>
                            <td>:</td>
                            <td><b><?php echo $item['nisn']; ?></b></td>
                          </tr>
                          <tr>
                            <td>Tanggal Pinjam</td>
                            <td>:</td>
                            <td><b><?php echo $item['tgl_pinjam']; ?></b></td>
                          </tr>
                          <tr>
                            <td>Tanggal Berakhir </td>
                            <td>:</td>
                            <td><b><?php echo $item['tgl_kembali']; ?></b></td>
                          </tr>
                          <tr>
                            <td>Harga Pinjam </td>
                            <td>:</td>
                            <td><b><?php echo $item['harga']; ?></b></td>
                          </tr>
                          <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                              <?php
                              $statusClass = '';
                              if ($item['status'] == 0) {
                                $statusText = 'Menunggu Persetujuan';
                                $statusClass = 'text-warning';
                              } elseif ($item['status'] == 1) {
                                $statusText = 'Telah Disetujui';
                                $statusClass = 'text-primary';
                              } elseif ($item['status'] == 2) {
                                $statusText = 'Tidak Disetujui';
                                $statusClass = 'text-danger';
                              } else {
                                $statusText = 'Telah Dinonaktifkan';
                                $statusClass = 'text-bold';
                              }
                              ?>
                              <span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col">
                      <?php
                                    if ($item['status'] == 0) {
                                    ?>
                                        <a href="setuju.php?id=<?= $item['peminjaman_id']; ?>"><span data-placement='top' data-toggle='tooltip' title='Setuju'><button class="btn btn-success">Setuju</button></span></a>&nbsp;
                                        <a href="tidaksetuju.php?id=<?= $item['peminjaman_id']; ?>"><span data-placement='top' data-toggle='tooltip' title='Tidak Setuju'><button class="btn btn-danger">Tidak Setuju</button></span></a>&nbsp;
                                        <a title="kembali" class="btn btn-secondary" href="peminjamanBuku.php">Kembali</a>
                                    <?php
                                    } elseif ($item['status'] == 1) {
                                    ?>
                                        <a href="tidaksetuju.php?id=<?= $item['peminjaman_id']; ?>"><span data-placement='top' data-toggle='tooltip' title='Tidak Setuju'><button class="btn btn-danger">Tidak Setuju</button></span></a>&nbsp;
                                        <a title="kembali" class="btn btn-secondary" href="peminjamanBuku.php">Kembali</a>
                                    <?php
                                    } elseif ($item['status'] == 2) {
                                    ?>
                                        <a href="setuju.php?id=<?= $item['peminjaman_id']; ?>"><span data-placement='top' data-toggle='tooltip' title='Setuju'><button class="btn btn-success">Setuju</button></span></a>&nbsp;
                                        <a title="kembali" class="btn btn-secondary" href="peminjamanBuku.php">Kembali</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a title="kembali" class="btn btn-secondary" href="peminjamanBuku.php">Kembali</a>
                                    <?php
                                    }
                                    ?>
                      </div>
                    </div>
                </div>
              <?php endforeach; ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-success">
                <div class="card-header">
                  <center>
                    <h6 class="m-0 font-weight-bold text-primary">Cover</h6>
                  </center>
                  <div class="card-tools"></div>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <td><img src="../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="160px" style="border-radius: 5px;"></td>
                  </div>
                  <h6 class="m-2 font-weight-bold text-center text-primary">
                    <?php echo $item['judul']; ?>
                  </h6>
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