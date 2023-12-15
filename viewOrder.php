<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Pesanan Anda</title>
    <link rel = "icon" href ="img/logo.jpg" type = "image/x-icon">
<style>
    .footer {
      position: fixed;
      bottom: 0;
    }
    .table-wrapper {
    background: #fff;
    padding: 20px 25px;
    margin: 30px auto;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-wrapper .btn {
        float: right;
        color: #333;
        background-color: #fff;
        border-radius: 3px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }
    .table-wrapper .btn:hover {
        color: #333;
        background: #f2f2f2;
    }
    .table-wrapper .btn.btn-primary {
        color: #fff;
        background: #03A9F4;
    }
    .table-wrapper .btn.btn-primary:hover {
        background: #03a3e7;
    }
    .table-title .btn {		
        font-size: 13px;
        border: none;
    }
    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }
    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }
    .table-title {
        color: #fff;
        background: #4b5366;		
        padding: 16px 25px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }
    table.table tr th:first-child {
        width: 60px;
    }
    table.table tr th:last-child {
        width: 80px;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }
    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }
    table.table td a:hover {
        color: #2196F3;
    }
    table.table td a.view {        
        width: 30px;
        height: 30px;
        color: #2196F3;
        border: 2px solid;
        border-radius: 30px;
        text-align: center;
    }
    table.table td a.view i {
        font-size: 22px;
        margin: 2px 0 0 1px;
    }   
    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }
    table {
        counter-reset: section;
    }

    .count:before {
        counter-increment: section;
        content: counter(section);
    }
    

</style>

</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_nav.php';?>
    <?php 
    if($loggedin){
    ?>

    <div class="container">
        <div class="table-wrapper" id="empty">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Detail <b>Pesanan</b></h2>
                    </div>
                    <div class="col-sm-8">						
                        <a href="" class="btn btn-primary"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
                        <a href="#" onclick="window.print()" class="btn btn-info"><i class="material-icons">&#xE24D;</i> <span>Print</span></a>
                    </div>
                </div>
            </div>
             <div class="tanggal-order" style="    margin-top: 2%;
    margin-bottom: 1%;">
        <div class="container">
            <form method='POST'>
                <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control">
                    </div>
                </div>
                <div class="col-4" style="    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1%;">
                    <input type="submit" class="btn btn-primary" name="cari" value="Cari" style="    margin-left: -75%;">
                </div>
            </div>
            </form>
        </div>
    </div>
        <?php
    if(isset($_POST['cari'])){
        $tgl_awal = mysqli_real_escape_string($conn, $_POST['tanggal_awal']);
        $tgl_akhir = mysqli_real_escape_string($conn, $_POST['tanggal_akhir']);
        
        echo '<p style="font-weight: 600">Hasil pencarian dari tanggal ' .$tgl_awal . ' ke tanggal ' .$tgl_akhir . '</p>
        ';            
    }
    ?>
            <table class="table table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Alamat</th>
                        <th>No. Hp</th>
                        <th>Jumlah</th>	
                        <th>Acara</th>			
                        <th>Tanggal Pengiriman</th>
                        <th>Ongkir</th>
                        <th>Produk</th>
                        <th>Status</th>	
                        <th>Opsi</th>		
                    </tr>
                </thead>
                <tbody>
                    <?php
                         if(isset($_POST['cari'])){
                            $tgl_awal = mysqli_real_escape_string($conn, $_POST['tanggal_awal']);
                            $tgl_akhir = mysqli_real_escape_string($conn, $_POST['tanggal_akhir']);
                            
                            $sql = "SELECT * FROM `orders` WHERE `pengiriman` BETWEEN '$tgl_awal' AND '$tgl_akhir'  ORDER BY status DESC ";
                            $result = mysqli_query($conn, $sql);
                        } else {
                            $sql = "SELECT * FROM `orders` ORDER BY status DESC";
                            $result = mysqli_query($conn, $sql);
                        }
                        $counter = 0;
                        while($row = mysqli_fetch_assoc($result)){
                            $orderId = $row['orderId'];
                            $address = $row['address'];
                            $zipCode = $row['zipCode'];
                            $phoneNo = $row['phoneNo'];
                            $amount = $row['amount'];
                            $metode = $row['metode'];
                            $pengiriman = $row['pengiriman'];
                            $lokasi = $row['tujuan'];
                            $paymentMode = $row['paymentMode'];
                            $status = $row['status'];
                            if($paymentMode == 0) {
                                $paymentMode = "Ambil Sendiri";
                            }
                            else {
                                $paymentMode = "Di Antar";
                            }
                            $orderStatus = $row['orderStatus'];
                            
                            $counter++;
                            
                            echo '<tr>
                                    <td>' . $orderId . '</td>
                                    <td>' . substr($address, 0, 20) . '...</td>
                                    <td>' . $phoneNo . '</td>
                                    <td>' . $amount . '</td>
                                    <td>' . $metode . '</td>
                                    <td>' . date('Y-m-d', strtotime($pengiriman)) . '</td>
                                    <td>' . $lokasi . '</td>
                                    <td><a href="#" data-toggle="modal" data-target="#orderItem' . $orderId . '" class="view" title="View Details"><i class="material-icons">&#xE5C8;</i></a></td>
                                    <td><a href="#" data-toggle="modal" data-target="#orderStatus' . $orderId . '" class="view"><i class="material-icons">&#xE5C8;</i></a></td>
                                    <td>';
                                    if($row['status'] == 0) {
                                    
                                    echo '<a href="detail.php?id=' . $row['orderId'] . '" class="btn btn-primary" style="font-size: 14px">Detail</a>
                                        <form action="midtrans/examples/snap/checkout-process.php?id='. $row['orderId'] .'" method="post">
                                        <input type="hidden" name="user_id" value="' . $userId . '">
                                        <input type="hidden" name="id" value="' . $row['orderId'] . '">
            
                                            <button type="submit" name="checkout" class="btn btn-primary mt-2" style="font-size: 14px; background: green">Bayar</button>
                                        </form>';
                                    } else {
                                        echo '<a href="lihat_selengkapnya.php?id=' . $row['orderId'] . '" class="btn btn-primary mt-2" style="font-size: 14px; background: orange">Lihat Pembayaran</a>';
                                    }
            
                                    '</td>
                                </tr>';
                        }
                        
                        if($counter==0) {
                            ?><script> document.getElementById("empty").innerHTML = '<div class="col-md-12 my-5"><div class="card"><div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"> <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong>Anda Belum Memesan Apapun.</strong></h3><h4>Silahkan Order Terlebih Dahulu :)</h4> <a href="index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">Lanjutkan Belanja</a> </div></div></div></div>';</script> <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div> 

    <?php 
    }
    else {
        echo '<div class="container" style="min-height : 610px;">
        <div class="alert alert-info my-3">
            <font style="font-size:22px"><center>Periksa Pesanan Anda <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal">Login</a></strong></center></font>
        </div></div>';
    }
    ?>

    <?php 
    include 'partials/_orderItemModal.php';
    include 'partials/_orderStatusModal.php';

    ;?> 
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
  </body>
</html>