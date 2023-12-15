<div class="container" style="margin-top:98px;background: aliceblue;">
    <div class="table-wrapper">
        <div class="table-title" style="border-radius: 14px;">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Detail <b>Pesanan</b></h2>
                </div>
                <div class="col-sm-8">						
                    <a href="" class="btn btn-dark"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
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
                    <input type="submit" class="btn btn-primary bg-success" name="cari" value="Cari" style="    margin-left: -75%;">
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
        <table class="table table-striped table-hover text-center" id="NoOrder">
            <thead style="background-color: rgb(111 202 203);">
                <tr>
                    <th>Order Id</th>
                    <th>User Id</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Jumlah</th>	
                    <th>Acara</th>			
                    <th>Tanggal Pengiriman</th>
                    <th>Ongkir</th>
                    <th>Status</th>						
                    <th>Produk</th>
                    <th>Aksi</th>
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
                        $Id = $row['userId'];
                        $orderId = $row['orderId'];
                        $address = $row['address'];
                        $zipCode = $row['zipCode'];
                        $phoneNo = $row['phoneNo'];
                        $amount = $row['amount'];
                        $metode = $row['metode'];
                        $pengiriman = $row['pengiriman'];
                        $lokasi = $row['tujuan'];
                        $paymentMode = $row['paymentMode'];

                        if($paymentMode == 0) {
                            $paymentMode = "Ambil Sendiri";
                        }
                        else {
                            $paymentMode = "Diantar";
                        }
                        $orderStatus = $row['orderStatus'];
                        $counter++;
                        
                        echo '<tr>
                                <td>' . $orderId . '</td>
                                <td>' . $Id . '</td>
                                <td data-toggle="tooltip" title="' .$address. '">' . substr($address, 0, 20) . '...</td>
                                <td>' . $phoneNo . '</td>
                                <td>' . $amount . '</td>
                                <td>' . $metode . '</td>
                                <td>' . $pengiriman . '</td>
                                <td>' . $lokasi . '</td>
                                <td><a href="#" data-toggle="modal" data-target="#orderStatus' . $orderId . '" class="view"><i class="material-icons">&#xE5C8;</i></a></td>
                                <td><a href="#" data-toggle="modal" data-target="#orderItem' . $orderId . '" class="view" title="View Details"><i class="material-icons">&#xE5C8;</i></a></td>
                                <td>
                                <a href="details.php?id=' . $row['orderId'] . '" class="btn btn-primary bg-success" style="font-size: 14px">Detail Pembayaran</a>';
                                '</td>
                            </tr>';
                    }
                    if($counter==0) {
                        ?><script> document.getElementById("NoOrder").innerHTML = '<div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%"> You have not Recieve any Order!	</div>';</script> <?php
                    } 
                ?>
            </tbody>
        </table>
    </div>
</div> 

<?php 
    include 'partials/_orderItemModal.php';
    include 'partials/_orderStatusModal.php';
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    .tooltip.show {
        top: -62px !important;
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
        /* background-color: #fcfcfc; */
    }
    table.table-striped.table-hover tbody tr:hover {
        /* background: #f5f5f5; */
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

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>