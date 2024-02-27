<?php
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
require "../../config/config.php";
// query read semua buku

$itemsPerPage = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;
$buku = queryReadData("SELECT * FROM buku order by id_buku DESC LIMIT $offset, $itemsPerPage");
// Query to get the total number of books
$totalItems = queryReadData("SELECT COUNT(*) AS total FROM buku")[0]['total'];
$totalPages = ceil($totalItems / $itemsPerPage);
//search buku
if (isset($_POST["search"])) {
  $buku = search($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="assets/fontawesome/css/stylehome.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="../../assets/css/script_nav.css">
  <link rel="stylesheet" href="../../assets/css/style_icon.css">
  <title>Hello, world!</title>
</head>
<style>
  body {
    background: url('../../assets/img/bggg.jpg') no-repeat center center fixed;
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
          <a href="daftarBuku.php"><img src="../../assets/img/madyalib.png" style="width: 70px; height: 70px;"></a>
        </div>
      </div>
      <div class="navbar-menu" id="open-navbar1">
        <ul class="navbar-nav">
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="../../dashboardMember/dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="../signOut.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 
  <style>
    .layout-card-custom {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
    }
  </style>


  <div class="row justify-content-center">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="max-width: 100%;">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../../assets/img/bok1.jpg" class="d-block w-100 " style="height: 300px;" alt="buku.jpg">
        </div>
        <div class="carousel-item">
          <img src="../../assets/img/bok3.jpg" class="d-block w-100 " style="height: 300px;"alt="buku2.jpg">
        </div>
        <div class="carousel-item">
          <img src="../../assets/img/bok4.jpg" class="d-block w-100 " style="height: 300px;"alt="buku3.jpg">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>




  <div class="container-fluid">
    <form action="" method="post" class="mt-4 mx-auto d-block col-md-6">
      <div class="input-group">
        <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="cari judul atau kategori..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="search">Search</button>
      </div>
    </form>
  </div>

  <!--Card buku-->
  <div class="arrivals mt-4">
    <div class="arrivals_box d-flex flex-wrap justify-content-center">
      <?php foreach ($buku as $item) : ?>
        <div class="arrivals_card d-flex flex-column justify-content-between position-relative"> <!-- Added position-relative class -->
          <div class="arrivals_image">
            <a href="sign/member/sign_in.php"><img src="../../assets/imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="200px"></a>
          </div>
          <div class="arrivals_tag mt-3">
            <p class="text-center"><?= $item["judul"]; ?></p>
          </div>
          <div class="btn-group mt-auto detail-button" role="group" aria-label="Basic example" style="bottom: 10%; right: 17%; transform: translateX(50%);"> <!-- Added detail-button class and applied positioning -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal<?= $item["id_buku"]; ?>">Detail</button>
          </div>
        </div>

        <div class="modal" id="myModal<?= $item["id_buku"]; ?>">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Detail Buku</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <!-- Modal body -->
              <div class="modal-body d-flex justify-content-center align-items-center">
                <div class="card" style="width: 18rem;">
                  <img src="../../assets/imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="Mobil Image">
                  <div class="card-body  ">
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Judul:</strong> <?= $item['judul']; ?></li>
                    <li class="list-group-item"><strong>Deskripsi:</strong> <?= $item['deskripsi']; ?></li>
                    <li class="list-group-item"><strong>Kategori:</strong> <?= $item['kategori']; ?></li>
                    <li class="list-group-item"><strong>Pengarang:</strong> <?= $item['pengarang']; ?></li>
                    <li class="list-group-item"><strong>Penerbit:</strong> <?= $item['penerbit']; ?></li>
                    <li class="list-group-item"><strong>Tahun Terbit:</strong> <?= $item['thn_terbit']; ?></li>
                  </ul>
                  <div class="card-body">

                    <a href="daftarBuku.php" class="btn btn-danger">Batal</a>
                    <a href="pinjam.php?id=<?= $item["id_buku"]; ?>" class="btn btn-success">Pinjam</a>

                  </div>
                </div>
              </div>
              <!-- Modal footer -->
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
      <div class="d-flex justify-content-center mt-3">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                  <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
              <?php endfor; ?>
            </ul>
          </nav>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
      <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
      <script src="../../assets/css/script.js"></script>
      <script src="../../assets/css/script_nav.js"></script>
</body>

</html><?php
