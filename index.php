<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css"> 
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <title>Catering Trio</title>

    <!-- Favicons -->
  <link href="assetss/img/favicon.png" rel="icon">
  <link href="assetss/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assetss/vendor/aos/aos.css" rel="stylesheet">
  <link href="assetss/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assetss/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assetss/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assetss/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assetss/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assetss/css/style.css" rel="stylesheet">
    
  </head>
<body>
   <!-- Jumbotron -->
   <br>
   <div class="jumbotron" style="background-image: url(images/background/bg.jpg); background-size: cover;">
   </div>
  <!-- Akhir Jumbotron -->
  <?php include 'partials/_dbconnect.php';?>
  <?php require 'partials/_nav.php' ?>
  <!-- Category container starts here -->
  <br> <br>
  <div class="container my-3 mb-5">
    <div class="col-lg-2 text-center bg-light my-3 text-dark" style="margin:auto;border-top: 2px groove black;border-bottom: 2px groove black;">     
      <h2 class="text-center">Menu </h2>
    </div>
    <div class="row">
      <!-- Fetch all the categories and use a loop to iterate through categories -->
      <?php 
        $sql = "SELECT * FROM `categories`"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          $id = $row['categorieId'];
          $cat = $row['categorieName'];
          $desc = $row['categorieDesc'];
          echo '<div class="col-xs-3 col-sm-3 col-md-3">
                  <div class="card" style="width: 18rem;">
                    <img src="img/card-'.$id. '.jpg" class="card-img-top" alt="image for this category" width="249px" height="270px">
                    <div class="card-body">
                      <h5 class="card-title"><a href="viewProdukList.php?catid=' . $id . '">' . $cat . '</a></h5>
                      <p class="card-text">' . substr($desc, 0, 30). '... </p>
                      <a href="viewProdukList.php?catid=' . $id . '" class="btn btn-success">Lihat Semua</a>
                    </div>
                  </div>
                </div>'; 
        }
      ?>
    </div>
        </div>
    </div>
    </div>
    <hr>
    <hr>
     <br> <br> 

  <section id="hero">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
          <div>
            <h1>Profil Catering Trio</h1>
            <h2>Catering Trio merupakan usaha home industri yang bergerak dalam bidang pemesanan makanan yang terletak di Desa Barongan, Kecamatan Kota, Kabupaten Kudus, Jawa Tengah.Usaha milik Bapak Sugeng & Ibu Yuli ini sendiri sudah berdiri belasan Tahun dan cukup terkenal di Kabupaten Kudus.Di Catering Trio ini menyediakan jasa catering untuk berbagai macam acara dengan menu yang ditawarkan cukup bervariasi dan terjamin kualitas/rasanya</h2>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
          <img src="img/trio.png" class="img-fluid" alt=""><br>
          <img src="img/bg7.jpeg" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6" data-aos="zoom-in">
            <img src="img/lokasi.PNG" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 d-flex flex-column justify-contents-center" data-aos="fade-left">
            <div class="content pt-4 pt-lg-0">
              <h3>Lokasi Catering Trio</h3>
              <p class="fst-italic">
                Catering Trio Terletak di Desa Barongan Gg. Rambutan Rt 06/ Rw 01, no.345, Kecamatan Kota, Kabupaten Kudus, Provinsi Jawa Tengah 
              </p>
              <a href="https://goo.gl/maps/jiFViVwVzivfAvu38" class=" btn btn-success">Google Maps</a>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
</div>



    <?php require 'partials/_footer.php' ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assetss/vendor/aos/aos.js"></script>
<script src="assetss/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assetss/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assetss/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assetss/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assetss/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assetss/js/main.js"></script>
</body>
</html>