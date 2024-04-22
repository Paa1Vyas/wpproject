<?php
// Establish database connection
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

// Array to hold category names
$categories = array();

// Fetch existing categories from the database
$sql = "SELECT * FROM category";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Add category name to the array
        $categories[] = $row["name"];
    }
} else {
    // No categories found
    $categories[] = "No categories found";
}

// Close connection
$conn->close();

// Encode the categories array into JSON format
$json_output = json_encode($categories);

// Output the JSON
echo $json_output;
?>
