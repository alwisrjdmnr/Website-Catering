<?php

// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;
require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-ZAP4pItPCn5VBoG1np_WyLAI';
Config::$clientKey = 'SB-Mid-client-MlZYkrlnmfWtkfIy';

include '../../../partials/_dbconnect.php';
// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// Required
$userId = $_POST['user_id'];
$id = $_POST['id'];

        $passSql = "SELECT * FROM orders JOIN users on orders.userId = users.id WHERE orderId=$id"; 
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_array($passResult);

// $lokasi = $passRow['lokasi'];
// var_dump($passRow);
// die;
// // $sql = "INSERT INTO `orders` (`userId`, `address`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`, `tujuan`) VALUES ('$userId', '$alamat', '$phone', '$ongkir', '1', '0', current_timestamp(), '$lokasi')";
// // $result = mysqli_query($conn, $sql);


// // $updatesql = "UPDATE `viewcart` SET `alamat`='$alamat', `phone`='$phone', `status`=1 WHERE `userId`='$userId'";
// // $updateresult = mysqli_query($conn, $updatesql);

// $existSql = "SELECT * FROM `viewcart` WHERE `status`=1 ORDER BY order_id DESC LIMIT 1";
// $result = mysqli_query($conn, $existSql);
// $numExistRows = mysqli_fetch_array($result);
$order_id = $passRow['id_unik'];

$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => $passRow['amount'], // no decimal allowed for creditcard
);
// var_dump($numExistRows);
// $count = "SELECT count(*) as `total_harga` from `viewcart` WHERE `status`=0";
// $resultcount=mysqli_query($conn, $count);
// $data=mysqli_fetch_assoc($resultcount);
// $jumlah = $data['total_harga'];
// Optional

$item1_details = [
    'id' => $passRow['orderId'],
    'price' => $passRow['amount'],
    'quantity' => 1,
    'name' => $passRow['address']
];

$order = $transaction_details['order_id'];

$updatesql = "UPDATE `orders` SET `id_unik`='$order' WHERE `orderId`='$id'";
$updateresult = mysqli_query($conn, $updatesql);
// $item_details = array();
// $total = 0;
// while ($row = mysqli_fetch_assoc($result)) {
//     $total = $row['total_harga'];
//     $item2_details = array(
//         'id' => $row['cartItemId'],
//         'price' => $ongkir,
//         'quantity' => 1,
//         'name' => $row['order_id']
//     );
//     array_push($item_details, $item2_details);
// }

// Optional
$item_details = array ($item1_details);
// var_dump($item_details, $transaction_details);
// die;

// Optional
// $billing_address = array(
//     'first_name'    => "Andri",
//     'last_name'     => "Litani",
//     'address'       => "Mangga 20",
//     'city'          => "Jakarta",
//     'postal_code'   => "16602",
//     'phone'         => "081122334455",
//     'country_code'  => 'IDN'
// );

// Optional
// $shipping_address = array(
//     'first_name'    => "Obet",
//     'last_name'     => "Supriadi",
//     'address'       => "Manggis 90",
//     'city'          => "Jakarta",
//     'postal_code'   => "16601",
//     'phone'         => "08113366345",
//     'country_code'  => 'IDN'
// );

// Optional
// $customer_details = array(
//     'first_name'    => "Andri",
//     'last_name'     => "Litani",
//     'email'         => "andri@litani.com",
//     'phone'         => "081122334455",
//     'billing_address'  => $billing_address,
//     'shipping_address' => $shipping_address
// );

// Optional, remove this to display all available payment methods
// $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');

// Fill transaction details
$transaction = array(
    // 'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    // 'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
}
catch (\Exception $e) {
    echo $e->getMessage();
}

// echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
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

?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <br>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <p>Selesaikan pembayaran sekarang dengan memilih metode pembayaran</p>
                <button id="pay-button" class="btn btn-primary">Pilih metode pembayaran</button>
                        <!--<pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> -->

                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-MlZYkrlnmfWtkfIy"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay('<?php echo $snap_token?>', {
                    // Optional
                    onSuccess: function(result){
                        window.location.href='http://localhost:8080/CateringTrio/viewOrder.php';
                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onPending: function(result){
                        window.location.href='http://localhost:8080/CateringTrio/viewOrder.php'
                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result){
                        window.location.href='http://localhost:8080/CateringTrio/viewOrder.php'
                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                });
            };
        </script>
            </div>
        </div>
    </div>
</body>
</html>

