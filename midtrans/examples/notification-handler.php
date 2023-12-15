<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for sample HTTP notifications:
// https://docs.midtrans.com/en/after-payment/http-notification?id=sample-of-different-payment-channels

namespace Midtrans;

require_once dirname(__FILE__) . '/../Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-ZAP4pItPCn5VBoG1np_WyLAI';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

try {
    $notif = new Notification();
}
catch (\Exception $e) {
    exit($e->getMessage());
}

include '../../partials/_dbconnect.php';
session_start();


$notif = $notif->getResponse();
$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

$data = json_decode(json_encode($notif), true);
//     $userId = $_SESSION['userId'];

// var_dump($userId);
// die;

if ($transaction == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    if ($type == 'credit_card') {
        if ($fraud == 'challenge') {

            // $updatesql = "UPDATE `viewcart` SET `alamat`='$alamat', `phone`='$phone' WHERE `status`=0";
            // $updateresult = mysqli_query($conn, $updatesql);
            // TODO set payment status in merchant's database to 'Challenge by FDS'
            // TODO merchant should decide whether this transaction is authorized or not in MAP
            echo "Transaction order_id: " . $order_id ." is challenged by FDS";
        } else {
            // TODO set payment status in merchant's database to 'Success'
            echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
        }
    }
    echo '<script>alert("Terima Kasih Sudah Memesan di Catering Kami ' .$orderId. '.");
    window.location.href="/viewOrder.php";  
    </script>';
    exit();
    
} else if ($transaction == 'settlement') {
    $bank = $data['va_numbers'][0]['bank'];
    $va_number = $data['va_numbers'][0]['va_number'];
    $va = $va_number;
    // var_dump($bank, $va);
    // die;
    $updatesql = "UPDATE `orders` SET `bank`='$bank', `status`=1, `va_number`='$va' WHERE `id_unik`='$order_id'";
    $updateresult = mysqli_query($conn, $updatesql);
    
    // $sql = "SELECT * FROM `orders` WHERE `id_unik`= $order_id";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
    // var_dump($row);
    // die;
        // $passSql = "SELECT * FROM orders JOIN users on orders.userId = users.id ORDER BY orderId DESC LIMIT 1"; 
        // $passResult = mysqli_query($conn, $passSql);
        // $passRow=mysqli_fetch_array($passResult);

        // $userId = $passRow['id'];
        // $orderId = $passRow['orderId'];
        // $addSql = "SELECT * FROM `viewcart` WHERE userId='$userId'"; 
        //         $addResult = mysqli_query($conn, $addSql);
        //         while($addrow = mysqli_fetch_assoc($addResult)){
        //             $produkId = $addrow['produkId'];
        //             $itemQuantity = $addrow['itemQuantity'];
        //             $itemSql = "INSERT INTO `orderitems` (`orderId`, `produkId`, `itemQuantity`) VALUES ('$orderId', '$produkId', '$itemQuantity')";
        //             $itemResult = mysqli_query($conn, $itemSql);
        //         }
        // $deletesql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";   
        // $deleteresult = mysqli_query($conn, $deletesql);
    // TODO set payment status in merchant's database to 'Settlement'
    echo '<script>alert("Pembayaran Anda Berhasil");
    window.location.href="http://localhost:8080/cateringtrio/";  
    </script>';
    exit();
    
    // echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
} else if ($transaction == 'pending') {
    // TODO set payment status in merchant's database to 'Pending'
    echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
} else if ($transaction == 'deny') {
    // TODO set payment status in merchant's database to 'Denied'
    echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
} else if ($transaction == 'expire') {
    // TODO set payment status in merchant's database to 'expire'
    echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
} else if ($transaction == 'cancel') {
    // TODO set payment status in merchant's database to 'Denied'
    echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
}

function printExampleWarningMessage() {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo 'Notification-handler are not meant to be opened via browser / GET HTTP method. It is used to handle Midtrans HTTP POST notification / webhook.';
    }
    if (strpos(Config::$serverKey, 'SB-Mid-server-ZAP4pItPCn5VBoG1np_WyLAI') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-ZAP4pItPCn5VBoG1np_WyLAI\';');
        die();
    }   
}
