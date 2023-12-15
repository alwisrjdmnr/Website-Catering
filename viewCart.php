<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Cart</title>
    <link rel = "icon" href ="img/logo.jpg" type = "image/x-icon">
    <style>
    #cont{
        min-height : 626px;
    }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>
    <?php 
    if($loggedin){
    ?>
    
    <div class="container" id="cont">
        <div class="row">
           
            <div class="col-lg-12 text-center border rounded bg-light my-3">
                <h1>Pesanan saya</h1>
            </div>
            <div class="alert alert-info mb-0" style="width: -webkit-fill-available;">
              <strong>Info!</strong>Minimal Order 30 pcs setiap pemesanan catering (kecuali menu paket hantaran)
            </div>
            <div class="col-lg-8">
                <div class="card wish-list mb-3">
                    <table class="table text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">
                                    <form action="partials/_manageCart.php" method="POST">
                                        <button name="removeAllItem" class="btn btn-sm btn-outline-danger">Hapus Semua</button>
                                        <input type="hidden" name="userId" value="<?php $userId = $_SESSION['userId']; echo $userId ?>">
                                    </form>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `viewcart` WHERE `userId`= $userId";
                                $result = mysqli_query($conn, $sql);
                                $counter = 0;
                                $totalPrice = 0;
                                $harga_semua = 0;
                                $lokasi = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                    $produkId = $row['produkId'];
                                    $Quantity = $row['itemQuantity'];
                                    $mysql = "SELECT * FROM `produk` WHERE produkId = $produkId";
                                    $myresult = mysqli_query($conn, $mysql);
                                    $myrow = mysqli_fetch_assoc($myresult);
                                    $produkName = $myrow['produkName'];
                                    $produkPrice = $myrow['produkPrice'];
                                    $total = $produkPrice * $Quantity;
                                    $counter++;
                                    $totalPrice = $totalPrice + $total;
                                    $harga_semua = $totalPrice + $row['ongkir'];
                                    $lokasi = $row['lokasi'];

                                    echo '<tr>
                                            <td>' . $counter . '</td>
                                            <td>' . $produkName . '</td>
                                            <td>' . $produkPrice . '</td>
                                            <td>
                                                <form id="frm' . $produkId . '">
                                                    <input type="hidden" name="produkId" value="' . $produkId . '">
                                                    <input type="number" name="quantity" value="' . $Quantity . '" class="text-center" onchange="updateCart(' . $produkId . ')" onkeyup="return false" style="width:60px" min=30 oninput="check(this)" onClick="this.select();">
                                                </form>
                                            </td>
                                            <td>' . $total . '</td>
                                            <td>
                                                <form action="partials/_manageCart.php" method="POST">
                                                    <button name="removeItem" class="btn btn-sm btn-outline-danger">Hapus</button>
                                                    <input type="hidden" name="itemId" value="'.$produkId. '">
                                                </form>
                                            </td>
                                        </tr>';
                                }
                                if($counter==0) {
                                    ?><script> document.getElementById("cont").innerHTML = '<div class="col-md-12 my-5"><div class="card"><div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"> <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong>Keranjang Anda Kosong</strong></h3><h4>Silahkan melakukan pemesanan terlebih dahulu</h4> <a href="index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a> </div></div></div></div>';</script> <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card wish-list mb-3">
                    <div class="pt-4 border bg-light rounded p-3">
                        <h5 class="mb-3 text-uppercase font-weight-bold text-center">RINGKASAN PESANAN</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 bg-light">Total Harga<span>Rp. <?php echo $totalPrice ?></span></li>
                            <?php
                              $sql = "SELECT * FROM `viewcart` WHERE `userId`=$userId";
                              $result = mysqli_query($conn, $sql);
                              $row = mysqli_fetch_array($result);
                              if ($row['ongkir'] == NULL) {
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light">Pengiriman<span>Rp. 0.</span></li>';
                            } else {
                                  echo '<li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light">Pengiriman<span>Rp. '. $row['ongkir'] .'</span></li>';
                              }
                                    
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-light">
                                <div>
                                    <strong>Jumlah total dari</strong>
                                    <strong><p class="mb-0"></p></strong>
                                </div>
                                <?php if ($row['ongkir'] == NULL) {?>
                                <span><strong>Rp. <?php echo $totalPrice ?></strong></span>
                                <?php } else {?>
                                 <span><strong>Rp. <?php echo $row['ongkir'] + $totalPrice ?></strong></span>
                                <?php }?>
                            </li>
                        </ul>
                        <br>

                        <?php
                         $sql = "SELECT * FROM `viewcart` WHERE `userId`= $userId";
                                $result = mysqli_query($conn, $sql);
                         $row = mysqli_fetch_array($result);
                         $lokasi = $row['lokasi'];
                            
                        if($lokasi == NULL) {
                        echo '<p style="font-size: 12px; color:red; margin-top: 3%; margin-bottom: -3%;">Note! Harap pilih pengiriman terlebih dahulu</p>';
                        } else {
                             echo '<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#checkoutModal">Buat Pesanan</button>';
                        }
                        ?>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="pt-4">
                        
                        <div class="collapse" id="collapseExample">
                            <div class="mt-3">
                                <div class="md-form md-outline mb-0">
                                    <input type="text" id="discount-code" class="form-control font-weight-light"
                                    placeholder="Enter discount code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" style="margin-top:-8%"> 
                <div class="text-center border rounded bg-light my-3">
                    <h1>Hitung Ongkir</h1>
                </div>
                <div class="card wish-list mb-3">
                 <?php
                 $sql = "SELECT * FROM `ongkir`";
                $result = mysqli_query($conn, $sql);
                
                 echo '<form action="partials/_manageCart.php" method="POST">
                        <div class="row mt-3 ml-2 d-flex justify-content-center align-items-center">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Pilih Lokasi Pengiriman</label>
                                <input type="hidden" name="id" value="'. $userId . '" >
                                    <select name="lokasi" id="lokasi" class="form-control">';
                                    $sql = "SELECT * FROM `viewcart` WHERE `userId`= $userId";
                                    $cart = mysqli_query($conn, $sql);
                                    $view = mysqli_fetch_assoc($cart);
                                    if ($view['lokasi'] == NULL) {
                                        // var_dump($view['lokasi']);
                                        echo '<option value="" disabled selected>Pilih Kota</option>';
                                         while($row = mysqli_fetch_assoc($result)){
                                            $kota = $row['city'];
                                            $id = $row['id'];
                                            echo '<option value="' . $id . '">' . $kota .'</option>';
                                            }
                                    }else {
                                        echo '<option value="'. $view['lokasi'] . '" disabled selected>'. $view['lokasi'] .'</option>';
                                         while($row = mysqli_fetch_assoc($result)){
                                            $kota = $row['city'];
                                            $id = $row['id'];
                                            echo '<option value="' . $id . '">' . $kota .'</option>';
                                            }
                                    }
                                    echo '</select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" style="margin-top: 10%">
                                    <button type="submit" name="addOngkir" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>'
                ?>
                </div>
            </div>
        </div>
    </div>
                                
    <?php 
    }
    else {
        echo '<div class="container" style="min-height : 610px;">
        <div class="alert alert-info my-3">
            <font style="font-size:22px"><center>Before checkout you need to <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal">Login</a></strong></center></font>
        </div></div>';
    }
    ?>
    <?php require 'partials/_checkoutModal.php'; ?>
    <?php require 'partials/_footer.php' ?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script>
        function check(input) {
            if (input.value <= 0) {
                input.value = 1;
            }
        }
        function updateCart(id) {
            $.ajax({
                url: 'partials/_manageCart.php',
                type: 'POST',
                data:$("#frm"+id).serialize(),
                success:function(res) {
                    location.reload();
                } 
            })
        }
    </script>
</body>
</html>