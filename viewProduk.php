<!doctype html>
<html lang="en">
<head>  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title id=title>Produk</title>
    <link rel = "icon" href ="img/logo.jpg" type = "image/x-icon">
    <style>
    #cont {
        min-height : 578px;
    }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>

    <div class="container my-4" id="cont">
        <div class="row jumbotron">
        <?php
            $produkId = $_GET['produkid'];
            $sql = "SELECT * FROM `produk` WHERE produkId = $produkId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $produkName = $row['produkName'];
            $produkPrice = $row['produkPrice'];
            $produkDesc = $row['produkDesc'];
            $produkCategorieId = $row['produkCategorieId'];
        ?>
        <script> document.getElementById("title").innerHTML = "<?php echo $produkName; ?>"; </script> 
        <?php
        echo  '<div class="col-md-4">
                <img src="img/produk-'.$produkId. '.jpg" width="249px" height="262px">
            </div>
            <div class="col-md-8 my-4">
                <h3>' . $produkName . '</h3>
                <h5 style="color: #ff0000">Rp. '.$produkPrice. '/-</h5>
                <p class="mb-0">' .$produkDesc .'</p>';

                if($loggedin){
                    $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE produkId = '$produkId' AND `userId`='$userId'";
                    $quaresult = mysqli_query($conn, $quaSql);
                    $quaExistRows = mysqli_num_rows($quaresult);
                    if($quaExistRows == 0) {
                        echo '<form action="partials/_manageCart.php" method="POST">
                              <input type="hidden" name="itemId" value="'.$produkId. '">
                              <button type="submit" name="addToCart" class="btn btn-success my-2">Pesan</button>';
                    }else {
                        echo '<a href="viewCart.php"><button class="btn btn-success my-2">Dimasukkan</button></a>';
                    }
                }
                else{
                    echo '<button class="btn btn-success my-2" data-toggle="modal" data-target="#loginModal">Dimasukkan</button>';
                }
                echo '</form>
                <h6 class="my-1"> Lihat </h6>
                <div class="mx-4">
                    <a href="viewProdukList.php?catid=' . $produkCategorieId . '" class="active text-dark">
                    <i class="fas fa-qrcode"></i>
                        <span>Semua Produk</span>
                    </a>
                </div>
                <div class="mx-4">
                    <a href="index.php" class="active text-dark">
                    <i class="fas fa-qrcode"></i>
                        <span>Semua Kategori</span>
                    </a>
                </div>
            </div>'
        ?>   
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>