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
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $webprice =$_POST['webprice'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Check if image file is uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $image_folder = "uploads/"; // Folder to store images
        
        // Move uploaded image to destination folder
        move_uploaded_file($temp_name, $image_folder.$image);
        
        // Update product data including image
        $sql = "UPDATE product SET name='$name', price='$price', webprice='$webprice', category='$category', description='$description', image='$image' WHERE pid='$pid'";
    } else {
        // Update product data excluding image
        $sql = "UPDATE product SET name='$name', price='$price', webprice='$webprice', category='$category', description='$description' WHERE pid='$pid'";
    }

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully.";
        header("Location: productshow.php?error=$em");
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
