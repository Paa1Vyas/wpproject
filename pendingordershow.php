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
            <th>Customize</th>
            <th>Order Confirmation</th>
        </tr>
       
       
        <?php
        // Database connection
        $mysqli = new mysqli("localhost", "root", "", "trial_project");

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

    
    

        

        // Fetch data from pendingorder table
        $sql = "SELECT orderid, start_date, status, c_name, address, p_name, price, category, Cutomize FROM pendingorder ORDER BY start_date DESC";
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
                echo "<td>".$row["Cutomize"]."</td>";
                
                echo "<td>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='orderid' value='".$row["orderid"]."'>";
                echo "<button type='submit' name='action' value='accept' formaction='process_accept.php'>Accept</button>";
                echo "<span style='margin-left: 10px; margin-right: 10px;'></span>"; 
                echo "<input type='hidden' name='orderid' value='".$row["orderid"]."'>";
                echo "<button type='submit' name='action' value='reject' formaction='process_reject.php'>Reject</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";

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
