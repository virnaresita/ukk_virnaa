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
// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['username'])) {
  header("Location:../../sign/admin/login_admin.php");
  exit();
}

// Halaman pengelolaan peminjaman buku perpustakaan
require "../../config/config.php";
$id = $_SESSION['id'];
$statusArray = [0, 1, 2];
$statusString = implode(',', $statusArray);  // Mengubah array menjadi string terpisah koma
$sekarang  = date("Y-m-d");
$a = 0;
$query  = "SELECT count(peminjaman.id) AS notif,
peminjaman.tgl_kembali AS tgl_kembali,
peminjaman.status AS status
FROM peminjaman 
INNER JOIN user ON peminjaman.id_user = user.id
WHERE tgl_kembali < '$sekarang' and  peminjaman.id_user = '$id' and status IN ($statusString)";
$sql    = mysqli_query($connection, $query);
if (mysqli_num_rows($sql) > 0) {
  $data = mysqli_fetch_assoc($sql);
  $a  = $data['notif'];
}
$peminjaman = queryReadData("SELECT peminjaman.id AS peminjaman_id,
 buku.cover AS cover,
 buku.id_buku AS id_buku, 
 buku.judul AS judul,
 member.nisn AS nisn, 
 member.nama AS nama, 
 user.username AS username,
 user.no_telp AS no_telp,
peminjaman.harga AS harga,
 peminjaman.tgl_pinjam AS tgl_pinjam,
 peminjaman.tgl_kembali AS tgl_kembali,
 peminjaman.status AS status
FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.nisn = member.nisn
INNER JOIN user ON peminjaman.id_user = user.id
WHERE user.id = '$id' order by peminjaman.id desc");

if (isset($_POST["search"])) {
  $peminjaman = searchPinjamPetugas($_POST["keyword"]);
}

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
          <li class="nav-item">
            <form action="" method="post" class="mt-2">
              <div class="input-group d-flex justify-content-end mb-2">
                <input class="border p-2 rounded rounded-end-2 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="cari data member...">
                <button class="border border-start-2 bg-light rounded rounded-start-2" type="submit" name="search"><i class="mdi mdi-magnify"></i></button>
              </div>
            </form>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="../../assets/img/profil.png"  alt="Profile image"> </a>
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

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <h4 class="card-title">Daftar Member</h4>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="mdi mdi-bell-ring "></i> Notifikasi <b class="badge badge-light" ><?= number_format($a); ?></b></button>
                  <p class="card-description">
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Cover</th>
                          <th>Judul Buku</th>
                          <th>NISN</th>
                          <th>Nama Peminjam</th>
                          <th>Nama Petugas</th>
                          <th>No Hp</th>
                          <th>Harga Bayar</th>
                          <th>Tgl. Pinjam</th>
                          <th>Tgl. Selesai</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                $no = 1; // Nomor urut dimulai dari 1
                $totalHarga = 0; // Inisialisasi total harga
                if (isset($peminjaman) && is_array($peminjaman) && count($peminjaman) > 0) {
                  foreach ($peminjaman as $item) :
                     // Menghapus karakter non-angka seperti "Rp." dan "."
                     $hargaBuku = floatval(preg_replace("/[^0-9]/", "", $item['harga']));
                     $totalHarga += $hargaBuku; // Menambahkan harga buku ke total
                ?>
                            <tr>
                              <td>
                                <img src="../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="70px" height="100px" style="border-radius: 5px;">
                              </td>
                              <td><?= $item["judul"]; ?></td>
                              <td><?= $item["nisn"]; ?></td>
                              <td><?= $item["nama"]; ?></td>
                              <td><?= $item["username"]; ?></td>
                              <td><?= $item["no_telp"]; ?></td>
                              <td><?= $item["harga"]; ?></td>
                              <td><?= $item["tgl_pinjam"]; ?></td>
                              <td><?= $item["tgl_kembali"]; ?></td>
                              <td><?php
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
                              <td>
                                <a title="status" class="btn btn-info" href="validate.php?id=<?php echo $item['peminjaman_id']; ?>">
                                  <i class="mdi mdi-newspaper"></i>
                                </a>

                              </td>
                            </tr>
                        <?php endforeach;
                        } else {
                          echo '<tr><td colspan="10">Tidak ada data peminjaman.</td></tr>';
                        } ?>
                    </table>
                  </div>
                  <div class="card-footer">
            <strong>Total Harga: </strong>
            Rp. <?= number_format($totalHarga, 0, ',', '.'); ?>
          </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Notifikasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <?php
          $statusArray = [0, 1, 2];
          $statusString = implode(',', $statusArray);  // Mengubah array menjadi string terpisah koma
          $sekarang  = date("Y-m-d");
          $query  = mysqli_query($connection, "SELECT peminjaman.id AS peminjaman_id,
             peminjaman.tgl_kembali AS tgl_kembali,
             peminjaman.status AS status
             FROM peminjaman
          INNER JOIN user ON peminjaman.id_user = user.id
          WHERE tgl_kembali < '$sekarang' AND peminjaman.id_user = '$id' AND status IN ($statusString) ORDER BY tgl_kembali");
          while ($data  = mysqli_fetch_array($query)) {
            $kembali  = new DateTime($data['tgl_kembali']);
            $lambat    = new DateTime($sekarang);
            $diff  = $lambat->diff($kembali);
          ?>
            <div class="alert alert-danger alert-dismissible">
              <strong>Peringatan!</strong> Peminjaman ID <a title="Cek" class="alert-link" href="validate.php?id=<?= $data['peminjaman_id']; ?>"><?php echo $data['peminjaman_id']; ?></a> harus dinonaktifkan karena sudah melewati batas waktu selama <?php echo $diff->d . " hari " ?><?php echo $diff->m . " bulan " ?><?php echo $diff->y . " tahun." ?>
            </div>
        </div>
      <?php
          }
      ?>
      <div class="modal-footer">
        <a href="non_aktif.php"><span data-placement='top' data-toggle='tooltip' title='Nonaktifkan'><button class="btn btn-secondary">Nonaktifkan</button></span></a>&nbsp;
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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