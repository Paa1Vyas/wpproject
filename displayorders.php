<!DOCTYPE html>
<html>
<head>
    <title>Display Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Accepted Orders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Start Date</th>
            <th>Delivery Date</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Action</th> <!-- New column for the button -->
        </tr>
       
        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "trial_project");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Function to update order status and end date
        function updateOrderStatus($conn, $orderid) {
            // Get the current date
            $current_date = date("Y-m-d");
            
           
            $sql_update = "UPDATE orders SET status='DELIVERED!!!', end_date='$current_date' WHERE orderid='$orderid'";
            
            if ($conn->query($sql_update) === TRUE) {
                echo "Status updated successfully for Order ID: $orderid <br>";
            } else {
                echo "Error updating status: " . $conn->error . "<br>";
            }
        }

        // Fetch data from orders table
        $sql = "SELECT orderid, start_date,end_date, status, c_name, address, p_name, price, category FROM orders ORDER BY start_date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["orderid"]."</td>";
                echo "<td>".$row["start_date"]."</td>";
                echo "<td>".$row["end_date"]."</td>";
                echo "<td>".$row["status"]."</td>";
                echo "<td>".$row["c_name"]."</td>";
                echo "<td>".$row["address"]."</td>";
                echo "<td>".$row["p_name"]."</td>";
                echo "<td>".$row["price"]."</td>";
                echo "<td>".$row["category"]."</td>";
                // Add a form with a button to update status
                echo "<td>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='orderid' value='".$row["orderid"]."'>";
                echo "<input type='submit' name='update_status' value='Update Status'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No orders found</td></tr>";
        }

        // Check if the update status button is clicked
        if(isset($_POST['update_status']) && isset($_POST['orderid'])) {
            // Call the updateOrderStatus function with the orderid
            updateOrderStatus($conn, $_POST['orderid']);
        }

        // Close connection
        $conn->close();
        ?>
    </table>
</body>
</html>
