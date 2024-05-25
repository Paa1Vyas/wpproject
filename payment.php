<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");
// header("Access-Control-Allow-Methods: *");
// Endpoint to create a Razorpay order
// You need to install Razorpay PHP SDK for this to workphp';
require 'razorpay-php-2.9.0/Razorpay.php';


use Razorpay\Api\Api;

$api_key = 'rzp_test_3z40UJhhML6EE6';
$api_secret = '6uVsR3m8YxHwg6vRzBRbj4Pd';

$api = new Api($api_key, $api_secret);

// Handle the creation of a Razorpay order
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $amount = $_POST['amount']; // Amount in paisa
    $currency = $_POST['currency'];

    try {
        $order = $api->order->create(array(
            'amount' => $amount*100,
            'currency' => "INR",
            'receipt' => 'order_rcptid_' . time(),
            'payment_capture' => 1,
        ));

        header('Content-Type: application/json');
        echo json_encode($order);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array('error' => $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid request'));
}
?>
