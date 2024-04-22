<!DOCTYPE html>
<html>
<head>
    <title>Update Products</title>
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
    <h2>Update Products</h2>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

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

        // Fetch data from product table
        $sql = "SELECT pid, name, price, category, description, image FROM product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["pid"] ."</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>₹" . $row["price"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td><img src='uploads/" . $row["image"] . "' alt='" . $row["name"] . "' style='max-width: 100px;'></td>";
                echo "<td>";
                echo "<a href='update_product.php?id=" . $row["pid"] . "' style='background-color: blue; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Update</a>";
                echo "<form method='POST' style='display: inline; margin-left: 5px;'>";
                echo "<input type='hidden' name='delete_pid' value='" . $row["pid"] . "'>";
                echo "<button type='submit' name='delete' style='background-color: #f44336; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found</td></tr>";
        }

        // Close connection
        $conn->close();

        // Process delete request
        if(isset($_POST['delete'])) {
            include "db_conn.php";

            $delete_pid = $_POST['delete_pid'];
            $sql = "DELETE FROM product WHERE pid='$delete_pid'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Product deleted successfully');</script>";
                echo "<script>window.location.href='productshow.php';</script>";
            } else {
                echo "Error deleting product: " . $conn->error;
            }
            $conn->close();
        }
        ?>
    </table>
</body>
</html>
