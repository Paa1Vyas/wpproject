<?php
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

// Function to generate random order ID
function generateOrderID() {
    $prefix = "ORD";
    $digits = 10 - strlen($prefix);
    $randomDigits = '';
    for ($i = 0; $i < $digits; $i++) {
        $randomDigits .= mt_rand(0, 9);
    }
    return $prefix . $randomDigits;
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_POST["pid"];
    $c_id = $_POST["c_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $category = $_POST["category"];
    $c_name = $_POST["c_name"];
    $mobile_number = $_POST["mobile_number"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $orderdate = date("y-m-d");
    $status = "NOT DELIVERED!!!";
    $customize=$_POST["customize"];
    // Generate order ID
    $order_id = generateOrderID();

    // Insert data into database
    $sql = "INSERT INTO pendingorder (orderid, start_date,status, c_name, mobilenumber, email, address, p_name, price, category, pid, c_id, Cutomize)
            VALUES ('$order_id', '$orderdate','$status','$c_name','$mobile_number','$email','$address','$product_name','$product_price','$category','$pid','$c_id','$customize')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. Order ID: $order_id";
        header("Location: display_products.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
