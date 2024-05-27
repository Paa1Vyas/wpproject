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
    <h2>Pending Orders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Start Date</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Order Confirmation</th>
        </tr>
       
       
        <?php
        // Database connection
        $mysqli = new mysqli("localhost", "root", "", "trial_project");

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        function acceptorder($conn){
            $sql_select = "SELECT orderid, start_date, status, c_name, address, p_name, price, category FROM pendingorder ORDER BY start_date";

$result1 = $conn->query($sql_select);

if ($result1->num_rows > 0) {
    // Loop through each row in the result set
    while ($row = $result1->fetch_assoc()) {
        // Extract data from the row
        $orderid = $row['orderid'];
        $start_date = $row['start_date'];
        $status = $row['status'];
        $c_name = $row['c_name'];
        $address = $row['address'];
        $p_name = $row['p_name'];
        $price = $row['price'];
        $category = $row['category'];

        // SQL query to insert data into orders table
    
                    $sql_insert = "INSERT INTO rejectorder (orderid, start_date, status, c_name, address, p_name, price, category) 
                    VALUES ('$orderid', '$start_date', '$status', '$c_name', '$address', '$p_name', '$price', '$category')";

        // Execute the insert query
        if ($conn->query($sql_insert) === TRUE) {
            echo "Record moved successfully. Order ID: $orderid <br>";
        } else {
            echo "Error moving record: " . $conn->error . "<br>";
        }
        }
        
    }
}
        

        // Fetch data from pendingorder table
        $sql = "SELECT orderid, start_date, status, c_name, address, p_name, price, category FROM rejectorder ORDER BY start_date DESC";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["orderid"]."</td>";
                echo "<td>".$row["start_date"]."</td>";
                echo "<td>".$row["status"]."</td>";
                echo "<td>".$row["c_name"]."</td>";
                echo "<td>".$row["address"]."</td>";
                echo "<td>".$row["p_name"]."</td>";
                echo "<td>".$row["price"]."</td>";
                echo "<td>".$row["category"]."</td>";
                
               

            }
        } else {
            echo "<tr><td colspan='8'>No orders found</td></tr>";
        }

        // Close connection
        $mysqli->close();
        ?>
    </table>
</body>
</html>
