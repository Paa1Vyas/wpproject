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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $cid = $_POST['cid'];
    $c_name = $_POST['category_name'];
    
    $sql = "DELETE FROM category WHERE cid='$cid'";


    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
        header("Location: createcategory.php?error=$em");
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
