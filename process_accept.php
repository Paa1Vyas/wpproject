<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'accept') {
    // Database connection
    $mysqli = new mysqli("localhost", "root", "", "trial_project");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Get the order ID from the form submission
    $orderid = $_POST['orderid'];

    // Prepare a SQL statement to move the specific order to the 'orders' table
    $sql_insert = "INSERT INTO orders (orderid, start_date, status, c_name, address, p_name, price, mobilenumber, email, category,pid, c_id, Cutomize) 
                    SELECT orderid, start_date, status, c_name, address, p_name, price, mobilenumber, email, category, pid, c_id, Cutomize 
                    FROM pendingorder 
                    WHERE orderid = '$orderid'";

    // Execute the insert query
    if ($mysqli->query($sql_insert) === TRUE) {
        // Delete the accepted order from the 'pendingorder' table
        $sql_delete = "DELETE FROM pendingorder WHERE orderid = '$orderid'";
        $mysqli->query($sql_delete);

        echo "Order ID: $orderid has been accepted and moved successfully.";
    } else {
        echo "Error accepting order: " . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
} else {
    // Redirect back to the display orders page if accessed directly
    header("Location: display_orders.php");
    exit();
}
?>
