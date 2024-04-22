<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['customer_id'])) {
    // User is logged in, fetch customer ID
    $customer_id = $_SESSION['customer_id'];
} else {
    // User is not logged in
    echo "Please log in to view orders.";
    exit;
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

// Fetch orders from the database for the specific customer id
$sql = "SELECT orders.*, product.image FROM orders JOIN product ON orders.pid = product.pid WHERE orders.c_id = '$customer_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Display order details
        echo "<div>";
        echo "<p>Order ID: " . $row["orderid"] . "</p>";
        echo "<p>Product Name: " . $row["p_name"] . "</p>";
        echo "<p>Price: " . $row["price"] . "</p>";
        echo "<p>Category: " . $row["category"] . "</p>";
        echo "<p>Customize: " . $row["Cutomize"] . "</p>";
        echo "<td><img src='uploads/" . $row["image"] . "'  style='max-width: 100px;'></td>";
        echo "<p>Delivery Status: " . $row["status"] . "</p>";
        
        // Display the product image
        
        
        // Add more details as needed
        echo "</div>";
    }
} else {
    echo "No orders found for this customer.";
}

// Close the database connection
$conn->close();
?>
