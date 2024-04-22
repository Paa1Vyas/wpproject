<?php
// Connect to MySQL
$conn = new mysqli('localhost', 'root', '', 'trial_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID and customer ID from the request
$product_id = $_POST['product_id']; // Assuming product ID is passed in the URL
$customer_id = "C02"; // Assuming a fixed customer ID for demonstration

// Generate random cart ID
$cart_id = "cart" . substr(md5(uniqid(rand(), true)), 0, 10);

// Assume quantity is 1 for now, you can adjust this as needed
$quantity = $_POST['quantity'];

// Insert data into cart table
$sql = "INSERT INTO cart (productid, c_id, quantity, cartid) VALUES ('$product_id', '$customer_id', '$quantity', '$cart_id')";

if ($conn->query($sql) === TRUE) {
    echo "Product added to cart successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
