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
  <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
    

<section class="content mt-4">
  <div class="container">
    <h2>Detail Pembelian</h2>

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
        <p>
        Bank: <?= $detail['bank']; ?><br>
        Virtual Akun: <?= $detail['va_number']; ?> <br>
        Total: Rp. <?= number_format($detail['amount']); ?>,- <br>
        </p>
        <p style="margin-top: -15px">Status: <span style="color: green">Terbayar</span></p>
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
  
</body>
</html>