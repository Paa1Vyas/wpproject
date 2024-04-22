<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['customer_id'])) {
    // User is logged in, fetch customer ID
    $customer_id = $_SESSION['customer_id'];
} else {
    // User is not logged in, set customer ID to empty string
    $customer_id = "";
}

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trial_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT p_name, price, category, cutomize from orders WHERE c_id='$customer_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row["p_name"] . "</h3>";
        echo "<p>Price: $" . $row["price"] . "</p>";
        echo "<p>Category: " . $row["category"] . "</p>";
        echo "<p>Description: " . $row["cutomize"] . "</p>";
        echo "";
        //add anchor for order creation
    }
} else {
    echo "No orders found.";
}

?>