<?php
// Include database connection file
include "db_conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobilenumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email_address']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $customer_id = generateCustomerID($conn);

    // Insert user data into database
    $sql = "INSERT INTO customer (c_id, name, mobilenumber, email_address, address) VALUES ('$customer_id','$name','$mobile_number',  '$email', '$address')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function generateCustomerID($conn) {
    $sql = "SELECT MAX(c_id) AS max_id FROM customer";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];
    $customer_id = 'C' . ($max_id . 1); // Append the incremented ID to 'C'
    return $customer_id;
}

// Close database connection
mysqli_close($conn);
?>
