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
$sql = "SELECT pid, name, webprice, category, description, image FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row["name"] . "</h3>";
        echo "<p>Price:₹    " . $row["webprice"] . "</p>";
        echo "<p>Category: " . $row["category"] . "</p>";
        echo "<p>Description: " . $row["description"] . "</p>";
        echo "<td><img src='uploads/" . $row["image"] . "' alt='" . $row["name"] . "' style='max-width: 100px;'></td>";
        echo "<form action='registration.php' method='POST'>";
        echo "<input type='hidden' name='pid' value='" . $row["pid"] . "'>";
        // Pass customer ID if logged in
        if(!empty($customer_id)) {
            echo "<input type='hidden' name='cid' value='" . $customer_id . "'>";
        }
        echo "<input type='submit' value='Buy Now'>";
        echo "</form>";
        echo "</div>";
    }
    echo "<a href='view_corders.php?cid=" . $customer_id . "'>View Orders</a>";

} else {
    echo "No products found.";
}

// Close the database connection
$conn->close();
?>
