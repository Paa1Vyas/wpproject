<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "trial_project");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Array to hold pending orders
$pending_orders = array();

// Fetch data from rejectorder table
$sql = "SELECT orderid, start_date, status, c_name, address, p_name, price, category FROM rejectorder ORDER BY start_date DESC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Loop through each row in the result set
    while($row = $result->fetch_assoc()) {
        // Extract data from the row
        $order = array(
            "orderid" => $row["orderid"],
            "start_date" => $row["start_date"],
            "status" => $row["status"],
            "c_name" => $row["c_name"],
            "address" => $row["address"],
            "p_name" => $row["p_name"],
            "price" => $row["price"],
            "category" => $row["category"]
        );
        // Add order data to the array
        $pending_orders[] = $order;
    }
}

// Close connection
$mysqli->close();

// Encode the pending orders array into JSON format
$json_output = json_encode($pending_orders);

// Output the JSON
echo $json_output;
?>
