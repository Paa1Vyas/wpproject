<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trial_project";
$i=1;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve form data

$product_name = $_POST['product_name'];
$price=$_POST['product_price'];
$category=$_POST['category'];
$c_name=$_POST['c_name'];
$mobile_number = $_POST['mobile_number'];
$email=$_POST['email'];
$address=$_POST['address'];

$orderid = generateOrderID();
$orderdate=date("Y-m-d");
$status= "NOT DELIVERED!!!";
$product_id = $_POST['pid'];
$customer_id = $_POST['c_id'];






// Insert data into the database
$sql = "INSERT INTO pendingorder ( orderid, start_date, status, c_name, mobilenumber, email, address, p_name, price, category, pid, c_id) VALUES ('$orderid', '$orderdate', '$status','$c_name','$mobile_number','$email','$address','$product_name','$price','$category','$product_id','$customer_id')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
