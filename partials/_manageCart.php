<?php
include '_dbconnect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    if(isset($_POST['addToCart'])) {
        $itemId = $_POST["itemId"];
        // Check whether this item exists
        $existSql = "SELECT * FROM `viewcart` WHERE produkId = '$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script>alert('Item Already Added.');
                    window.history.back(1);
                    </script>";
        }
        else{
            $sql = "INSERT INTO `viewcart` (`produkId`, `itemQuantity`, `userId`, `addedDate`) VALUES ('$itemId', '1', '$userId', current_timestamp())";   
            $result = mysqli_query($conn, $sql);
            if ($result){
                echo "<script>
                    window.history.back(1);
                    </script>";
            }
        }
    }
    if(isset($_POST['removeItem'])) {
        $itemId = $_POST["itemId"];
        $sql = "DELETE FROM `viewcart` WHERE `produkId`='$itemId' AND `userId`='$userId'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed');
                window.history.back(1);
            </script>";
    }
    if(isset($_POST['removeAllItem'])) {
        $sql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed All');
                window.history.back(1);
            </script>";
    }
    error_reporting(0);
    if(isset($_POST['checkout'])) {
        $amount = $_POST["amount"];
        $address1 = $_POST["address"];
        $address2 = $_POST["address1"];
        $pengiriman= $_POST["pengiriman"];
        $orderDate= $_POST["orderDate"];
        $metode = $_POST["metode"]; 
        $lokasi= $_POST["lokasi"];
        $phone = $_POST["phone"];               
        $zipcode = $_POST["zipcode"];
        $password = $_POST["password"];
        $address = $address1.", ".$address2;
        
        $n=5;
        function getName($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
        }
        $order = getName($n);
        // var_dump($amount, $lokasi);
        // die;
        $passSql = "SELECT * FROM users WHERE id='$userId'"; 
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        $userName = $passRow['username'];
        if (password_verify($password, $passRow['password'])){ 
            $sql = "INSERT INTO `orders` (`id_unik`, `userId`, `address`, `zipCode`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`, `pengiriman`, `tujuan`, `metode`) VALUES ('$order','$userId', '$address', '$zipcode', '$phone', '$amount', '0', '0', current_timestamp(), '$pengiriman', '$lokasi', '$metode')";
            $result = mysqli_query($conn, $sql);
            $orderId = $conn->insert_id;
            if ($result){
                $addSql = "SELECT * FROM `viewcart` WHERE userId='$userId'"; 
                $addResult = mysqli_query($conn, $addSql);
                while($addrow = mysqli_fetch_assoc($addResult)){
                    $produkId = $addrow['produkId'];
                    $itemQuantity = $addrow['itemQuantity'];
                    $itemSql = "INSERT INTO `orderitems` (`orderId`, `produkId`, `itemQuantity`) VALUES ('$orderId', '$produkId', '$itemQuantity')";
                    $itemResult = mysqli_query($conn, $itemSql);
                }
                $deletesql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";   
                $deleteresult = mysqli_query($conn, $deletesql);
                echo '<script>alert("Terima Kasih Sudah Memesan di Catering Kami ' .$orderId. '.");
                    window.location.href="http://localhost:8080/CateringTrio/viewOrder.php";  
                    </script>';
                    exit();
            }
        } 
        else{
            echo '<script>alert("Incorrect Password! Please enter correct Password.");
                    window.history.back(1);
                    </script>';
                    exit();
        }    
    }
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $produkId = $_POST['produkId'];
        $qty = $_POST['quantity'];
        $updatesql = "UPDATE `viewcart` SET `itemQuantity`='$qty' WHERE `produkId`='$produkId' AND `userId`='$userId'";
        $updateresult = mysqli_query($conn, $updatesql);
    }
    if(isset($_POST['addOngkir'])) {
        $lokasi = $_POST['lokasi'];
        $sql = "SELECT * FROM `ongkir` WHERE `id`='$lokasi'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $ongkir = $row['cost'];
        $lok = $row['city'];
        $id = $_POST['id'];
        // var_dump($ongkir, $id);
        // die;
            // $sqli = "SELECT * FROM `viewcart` WHERE `userId`=3";
            // $resulti = mysqli_query($conn, $sqli);
            // $harga = 0;
            // while($row = mysqli_fetch_assoc($resulti)){
            //     $harga += $row['harga'];
            // }
            // $total = $harga + $ongkir;
            // var_dump($total);
            // die;
            $updatesql = "UPDATE `viewcart` SET `lokasi`='$lok', `ongkir`='$ongkir' WHERE `userId`='$id'";
            $updateresult = mysqli_query($conn, $updatesql);
            
        echo "<script>alert('Pengiriman berhasil ditambahkan.');
                    window.history.back(1);
                    </script>";
    }
    
}
?>