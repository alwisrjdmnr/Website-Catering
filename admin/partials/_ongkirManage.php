<?php
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['createOngkir'])) {
        $name = $_POST["city"];
        $desc = $_POST["cost"];

        $sql = "INSERT INTO `ongkir` (`city`, `cost`, `ongkirCreateDate`) VALUES ('$name', '$desc', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        
      if ($result){
            echo "<script>alert('sukses tambah data');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
                
    }
    if(isset($_POST['removeOngkir'])) {
        $catId = $_POST["catId"];
        $sql = "DELETE FROM `ongkir` WHERE `id`='$catId'";   
        $result = mysqli_query($conn, $sql);
         if ($result){
            echo "<script>alert('Removed');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
        
    }
    if(isset($_POST['updateOngkir'])) {
        $catId = $_POST["catId"];
        $catName = $_POST["city"];
        $catDesc = $_POST["cost"];

        $sql = "UPDATE `ongkir` SET `city`='$catName', `cost`='$catDesc' WHERE `id`='$catId'";   
        $result = mysqli_query($conn, $sql);
        
        echo "<script>alert('update');
                window.location=document.referrer;
                </script>";
    }
}
?>