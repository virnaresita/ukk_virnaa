<?php
// Start the session
session_start();

// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['nama'])) {
  header("Location: ../../../../sign/member/login.php");
  exit();
}

if (!isset($_SESSION['nisn'])) {
  header("Location: ../../../../sign/member/login.php");
  exit();
}

// Access the NIS from the session
$nisn = $_SESSION['nisn'];

// Now you can use $nis wherever you need it

require " ../../../../config/config.php";


// Assuming $id is the specific value you want to match

$peminjaman = queryReadData("SELECT * FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.nisn = member.nisn
INNER JOIN user ON peminjaman.id_user = user.id
WHERE peminjaman.nisn = $nisn and status ='3'
order by peminjaman.tgl_pinjam desc");

if (isset($_POST["search"])) {
  //buat variabel dan ambil apa saja yg diketikkan user di dalam input dan kirimkan ke function search.
  $peminjaman = searchHistory($_POST["keyword"]);
}
// Replace $id with the actual condition you want to use in the WHERE clause
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../../asset/fontawesome/css/all.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="../../assets/css/script_nav.css">
  <link rel="stylesheet" href="../../asset/fontawesome/css/stylehome.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/fontawesome/css/stylehome.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>
<style>
  body {
    background: url('../assets/begron.jpg') no-repeat center center fixed;
    background-size: cover;
  }
</style>

<body>
  <nav class="navbar">
    <div class="container">

      <div class="navbar-header">
        <button class="navbar-toggler" data-toggle="open-navbar1">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div>
          <a href="history.php"><img src="../../assets/img/madyalib.png" style="width: 70px; height: 70px;"></a>
        </div>
      </div>
      <div class="navbar-menu" id="open-navbar1">
        <ul class="navbar-nav">
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="../dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="daftarBuku.php">Daftar Buku</a>
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="daftar_pinjam.php">Daftar Pinjam</a>
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="history.php">History</a>
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="../signOut.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="mt-5 alert alert-light" role="alert">Riwayat transaksi Peminjaman Buku Anda - <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["nama"]); ?></span></div>
  <div class="container-fluid">
    <div class="row justify-content-end"> <!-- Menambahkan class justify-content-end untuk meletakkan form di kanan -->
      <form action="" method="post" class="mt-4 col-md-3">
        <div class="input-group">
          <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="cari judul atau kategori..." aria-label="Search">
          <button class="btn btn-outline-success" type="submit" name="search">Search</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mt-4"></div>

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table table-striped table-hover" style="text-align: center;">
        <thead class="text-center">
          <tr>
            <th>Cover</th>
            <th>Id Buku</th>
            <th>Judul Buku</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Nama Petugas</th>
            <th>Tgl. Pinjam</th>
            <th>Tgl. Selesai</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1; // Nomor urut dimulai dari 1
          if (isset($peminjaman) && is_array($peminjaman) && count($peminjaman) > 0) {
            foreach ($peminjaman as $item) :
          ?>
              <tr>
                <td>
                  <img src="../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="70px" height="100px" style="border-radius: 5px;">
                </td>

                <td><?= $item["id_buku"]; ?></td>
                <td><?= $item["judul"]; ?></td>
                <td><?= $item["nisn"]; ?></td>
                <td><?= $item["nama"]; ?></td>
                <td><?= $item["username"]; ?></td>
                <td><?= date('Y-m-d', strtotime($item['tgl_pinjam'])); ?></td>
                <td><?= date('Y-m-d', strtotime($item['tgl_kembali'])); ?></td>
              </tr>
          <?php endforeach;
          } else {
            echo '<tr><td colspan="10">Tidak ada data peminjaman.</td></tr>';
          } ?>
        </tbody>
      </table>
    </div>
  </div>



</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="../../assets/css/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../../assets/css/script_nav.js"></script>