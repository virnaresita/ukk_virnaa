

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/fontawesome/css/stylehome.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="assets/css/script_nav.css">
  <link rel="stylesheet" href="assets/css/style_icon.css">
  <title>Hello, world!</title>
</head>

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
          <a href="index.php"><img src="assets/img/madyalib.png" style="width: 70px; height: 70px;"></a>
        </div>
      </div>
      <div class="navbar-menu" id="open-navbar1">
        <ul class="navbar-nav">
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="sign/member/login.php">Login</a>
          </li>
          <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
            <a class="nav-link" href="sign/member/sign_up.php">Registrasi</a>
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
      <div class="carousel-inner ">
        <div class="carousel-item active">
          <img src="assets/img/bok1.jpg" class="d-block w-100" style="height: 300px;" alt="buku.jpg">
        </div>
        <div class="carousel-item">
          <img src="assets/img/bok3.jpg" class="d-block w-100" style="height: 300px;" alt="buku2.jpg">
        </div>
        <div class="carousel-item">
          <img src="assets/img/bok4.jpg" class="d-block w-100" style="height: 300px;" alt="buku3.jpg">
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

  <div class="d-flex flex-wrap justify-content-center">
    <div class="col">

      <?php
      require "config/config.php";
      // query read semua buku
      
      // Pagination
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
      <style>
        body {
          background: url('assets/img/bggg.jpg') no-repeat center center fixed;
          background-size: cover;

        }

        /* Add this to your CSS */
      </style>
      <!--Btn filter data kategori buku-->
      <div class="container-fluid">
        <form action="" method="post" class="mt-4 mx-auto d-block col-md-6">
          <div class="input-group">
            <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="cari judul atau kategori..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
          </div>
        </form>
      </div>

      <!--Card buku-->
      <div class="arrivals mt-5">
        <div class="arrivals_box d-flex flex-wrap justify-content-center">
          <?php foreach ($buku as $item) : ?>
            <div class="arrivals_card">
              <div class="arrivals_image">
                <a href="../sign/member/login.php"><img src="assets/imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="200px"></a>
              </div>
              <div class="arrivals_tag">
                <p><?= $item["judul"]; ?></p>
                <p>Kategori : <?= $item["kategori"]; ?></p>
              </div>
              <div class="btn-group mt-3" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal<?= $item["id_buku"]; ?>">Detail</button>
                <a type="button" class="btn btn-primary" href="sign/member/login.php">Pinjam</a>
              </div>
            </div>
            <!-- Vertically centered modal -->
            <!-- The Modal -->
            <div class="modal" id="myModal<?= $item["id_buku"]; ?>">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Detail Buku</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <img src="assets/imgDB/<?= $item["cover"]; ?>" class="img-thumbnail mb-4" alt="Mobil Image">
                      </div>
                      <div class="col-md-6">
                        <div>
                          <strong>Kategori:</strong> <?php echo $item['kategori']; ?>
                        </div>
                        <div>
                          <strong>Pengarang:</strong> <?php echo $item['pengarang']; ?>
                        </div>
                        <div>
                          <strong>Penerbit:</strong> <?php echo $item['penerbit']; ?>
                        </div>
                        <div>
                          <strong>Tahun Terbit:</strong> <?php echo $item['thn_terbit']; ?>
                        </div>
                        <div>
                          <strong>Deskripsi:</strong> <?php echo $item['deskripsi']; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- Pagination links -->
        
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
        </div>
      </div>

      </section>


      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
      <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
      <script src="assets/css/script.js"></script>
      <script src="assets/css/script_nav.js"></script>
</body>

</html>