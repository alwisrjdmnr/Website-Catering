<?php

include 'partials/_dbconnect.php';
include 'partials/_nav.php';
$ambil = $conn->query("SELECT * FROM orders JOIN users ON orders.userId = users.id WHERE orders.orderId = '$_GET[id]'");
$detail = $ambil->fetch_assoc();

// jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka diarahkan ke riwayat (karena tidak berhak melihat nota orang lain)
// Pelanggan yang beli harus pelanggan yang login
// Mendapatkan id_pelanggan yang beli
$idpelangganyangbeli = $detail['userId'];

// Mendapatkan id_pelanggan yang login
// $idpelangganyanglogin = $_SESSION['user']['id_pelanggan'];

// if($idpelangganyangbeli != $idpelangganyanglogin){
//   echo "<script>alert('Akses ditolak!');</script>";
//   echo "<script>location='riwayat.php';</script>";
// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Pembelian</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Admin Page</title>
    <link rel = "icon" href ="/CateringTrio/img/logo.jpg" type = "image/x-icon">
    
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assetsForSideBar/css/styles.css">
</head>
<body id="body-pd" style="background: #80808045;">

<section class="content">
  <div class="container">
    <br>
    <h2>Detail Pembelian</h2>
    <hr>
    <!-- <h3>Data orang yang beli $session</h3> -->
    <!-- <pre><?php //print_r($detail); ?></pre> -->

    <!-- <h3>Data orang yang login di session</h3> -->
    <!-- <pre><?php //print_r($_SESSION); ?></pre> -->

    <div class="row" style="margin-bottom: 10px;">
      <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong>Id. Pembelian: <?= $detail['orderId']; ?></strong><br>
        Tanggal: <?= date("d M Y", strtotime($detail['orderDate'])); ?><br>
        <strong>Alamat </strong>: <?= $detail['address']; ?><br>
      </div>
      <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?= $detail["firstName"]; ?></strong><br>
        <p>
          <?= $detail["phone"]; ?><br>
          <?= $detail["email"]; ?>
        </p>
      </div>
      <div class="col-md-4">
        <h3>Pembayaran</h3>
        <strong><?= $detail["firstName"]; ?></strong><br>
        <p>
        Bank: <?= $detail['bank']; ?><br>
        Virtual Akun: <?= $detail['va_number']; ?> <br>
        Total: Rp. <?= number_format($detail['amount']); ?>,- <br>
        <?php if ($detail['status'] == 0) {
            echo '<p style="margin-top: -15px">Status: <span style="color: red"> Belum Bayar</span></p>';
        }else {
            echo '<p style="margin-top: -15px">Status: <span style="color: green">Terbayar</span></p>';
        }?>
        </p>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Harga</th>
        </tr> 
      </thead>
      <tbody>
        <?php $no=1; ?>
        <!-- Menampilkan data pembelian_produk -->
        <?php $ambil = $conn->query("SELECT * FROM orderitems JOIN orders ON orderitems.orderId = orders.orderId JOIN produk ON orderitems.produkId = produk.produkId WHERE orders.orderId = '$_GET[id]'"); ?>
        <?php while($pecah = $ambil->fetch_assoc()): ?>
            <!-- <?= var_dump($pecah);?> -->
        <tr>
          <td><?= $no; ?>.</td>
          <td><?= $pecah["produkName"]; ?></td>
          <td><?= $pecah["itemQuantity"]; ?></td>
          <td>Rp. <?= number_format($pecah["produkPrice"] * $pecah['itemQuantity']); ?>,-</td>
        </tr>
        <?php $no++; ?>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</section>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script src="assetsForSideBar/js/main.js"></script>
</body>
</html>