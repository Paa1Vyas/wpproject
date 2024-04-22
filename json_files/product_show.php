<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "trial_project"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Array to hold product data
$products = array();

// Fetch data from product table
$sql = "SELECT name, price, category, description, image FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each row in the result set
    while($row = $result->fetch_assoc()) {
        // Add product data to the array
        $product = array(
            "name" => $row["name"],
            "price" => $row["price"],
            "category" => $row["category"],
            "description" => $row["description"],
            "image" => $row["image"]
        );
        $products[] = $product;
    }
}

// Close connection
$conn->close();

// Encode the products array into JSON format
$json_output = json_encode($products);

// Output the JSON
echo $json_output;
?>
