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
pengembalian();

// Assuming $id is the specific value you want to match
$statusArray = [0, 1, 2];
$statusString = implode(',', $statusArray);  // Mengubah array menjadi string terpisah koma
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
WHERE peminjaman.nisn = '$nisn' AND peminjaman.status IN ($statusString)
order by peminjaman.status DESC");

if (isset($_POST["search"])) {
  //buat variabel dan ambil apa saja yg diketikkan user di dalam input dan kirimkan ke function search.
  $peminjaman = searchPinjamMember($_POST["keyword"]);
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
          <a href="daftar_pinjam.php"><img src="../../assets/img/madyalib.png" style="width: 70px; height: 70px;"></a>
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
    <?php
            $alertDisplayed = false;

            foreach ($peminjaman as $item) :
              if ($item['status'] == 0 && !$alertDisplayed) {
            ?>
                <div class="alert alert-danger">
                  <strong>Pemberitahuan!</strong> Silahkan kirim bukti transaksi ke nomor yang tertera.
                </div>
            <?php
                $alertDisplayed = true; // Set variabel ini menjadi true agar alert hanya ditampilkan sekali.
              }
            endforeach;
            ?>
      <table class="table table-striped table-hover" style="text-align: center;">
        <thead class="text-center">
          <tr>
            <th>Cover</th>
            <th>Id Buku</th>
            <th>Judul Buku</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Nama Petugas</th>
            <th>No Hp</th>
            <th>Harga Bayar</th>
            <th>Tgl.Pinjam</th>
            <th>Tgl.Selesai</th>
            <th width="200">Action</th>
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

                <td><?= $item["id_buku"]; ?></td>
                <td><?= $item["judul"]; ?></td>
                <td><?= $item["nisn"]; ?></td>
                <td><?= $item["nama"]; ?></td>
                <td><?= $item["username"]; ?></td>
                <td><?= $item["no_telp"]; ?></td>
                <td><?= $item["harga"]; ?></td>
                <td><?= date('Y-m-d', strtotime($item['tgl_pinjam'])); ?></td>
                <td><?= date('Y-m-d', strtotime($item['tgl_kembali'])); ?></td>
                <td>
                <?php
                    if ($item['status'] == '0') {
                      echo '<b class="badge bg-warning style="width:130px;">Menunggu Persetujuan</b>';
                      ?>
                      <div>
                      <a href="batalPinjam.php?id=<?= $item['peminjaman_id']; ?>" class="btn btn-danger mt-2" style="width:130px;" onclick="return confirm('Apakah anda ingin membatalkan peminjaman ini?');"> Batalkan</a>
                      </div>
                     <?php

                    } elseif ($item['status'] == '1') {
                    ?>
                     <div>
                      <a href="bacabuku.php?id_buku=<?= $item['id_buku']; ?>" class="btn btn-primary mt-1" ><i class="fas fa-book-open"></i> Baca</a>
                      </div>
                      <div>
                      <a href="kembalikan.php?id=<?= $item['peminjaman_id']; ?>" class="btn btn-warning mt-1" style="width: 130px;"><i class="fas fa-outdent"></i> Kembalikan</a>
                      </div>
                    <?php
                    }
                    if ($item['status'] == '2') {
                      echo '<b class="badge bg-danger">Tidak Disetujui</b>';
                    }
                    ?>
                </td>
              </tr>
          <?php endforeach;
          } else {
            echo '<tr><td colspan="15">Tidak ada data peminjaman.</td></tr>';
          } ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
            <strong>Total Harga: </strong>
            Rp. <?= number_format($totalHarga, 0, ',', '.'); ?>
          </div>
  </div>
  


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="../../assets/css/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../../assets/css/script_nav.js"></script>