<?php
session_start();
include 'connect.php';
function generateCartID() {
    $prefix = "CART";
    $digits = 10 - strlen($prefix);
    $randomDigits = '';
    for ($i = 0; $i < $digits; $i++) {
        $randomDigits .= mt_rand(0, 9);
    }
    return $prefix . $randomDigits;
}

if(isset($_POST['productid'])) {
    $product_id = $_POST['productid'];
    $c_id="C02";
    $cartid=generateCartID();

    // Add product to the cart
    $sql = "INSERT INTO cart (cartid,pid, quantity,c_id) VALUES ($cartid,$product_id, 1,$c_id)";
    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
