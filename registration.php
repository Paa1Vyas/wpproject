<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['customer_id'])) {
    // User is logged in, fetch customer ID
    $c_id = $_SESSION['customer_id'];
} else {
    // User is not logged in, handle accordingly
    // Redirect to login page or display a message
    header("Location: loginadmin.php");
    exit();
}

// Fetch the product ID from the URL parameter
if(isset($_GET['pid'])) {
    $p_id = $_GET['pid'];
} else if(isset($_POST['pid'])) {
    $p_id = $_POST['pid'];
} else {
    // Handle case where pid is not provided
    echo "Product ID not provided.";
    exit();
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

// Fetch data from the database for the specified product ID and customer ID
$sql = "SELECT pid, name, price, category, c_name, mobilenumber, email_address, Address FROM product JOIN customer WHERE c_id='$c_id' && pid='$p_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_name = $row["name"];
    $price = $row["price"];
    $category = $row["category"];
    $customer_name = $row["c_name"];
    $mobile_number = $row["mobilenumber"];
    $email = $row["email_address"];
    $address = $row["Address"];
} else {
    echo "No results found for product ID: $p_id<br>";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
</head>
<body>
    <h2>Order Form</h2>
    <form action="process_order.php" method="POST">
        <h3>Product</h3>
        <input type="hidden" name="pid" value="<?php echo $p_id; ?>">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>"><br><br>

        <label for="product_price">Product Price:</label>
        <input type="text" id="product_price" name="product_price" value="<?php echo $price; ?>"><br><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo $category; ?>"><br><br>

        <!-- Customer Details -->
        <h3>Customer Details</h3>
        <label for="c_name">Customer Name:</label>
        <input type="text" id="c_name" name="c_name" value="<?php echo $customer_name; ?>"><br><br>

        <label for="mobile_number">Mobile Number:</label>
        <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $mobile_number; ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address"><?php echo $address; ?></textarea><br><br>

        <h3>Customize</h3>
        <label for="customize">Customize:</label><br>
        <textarea id="customize" name="customize" rows="5" cols="50"></textarea><br><br>

        <input type="hidden" name="pid" value="<?php echo $p_id; ?>">
        <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">

        <input type="submit" value="Submit">
    </form>
</body>
</html>
