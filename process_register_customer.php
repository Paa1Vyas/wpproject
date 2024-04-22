<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trail_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate unique and random 10-digit customer ID with prefix "C"
$customer_id = "C" . str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);

// Get data from the registration form
$name = $_POST['name'];
$password = $_POST['password'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];

// SQL query to insert user data into database
$sql = "INSERT INTO users (c_id, c_name, c_password, mobilenumber, emailaddress) VALUES ('$customer_id', '$name', '$password', '$mobile', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful! Your Customer ID is: " . $customer_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
