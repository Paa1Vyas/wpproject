<!DOCTYPE html>
<html>
<head>
    <title>Update Products</title>
    <link rel="stylesheet" href='style/productshow.css'>
</head>
<body>
    <h2>Update Products</h2>
    <?php include 'sidebar.php' ?>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Margined Price</th>
            <th>Category</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        <?php
        // Database connection
        include "db_conn.php";

        // Fetch data from product table
        $sql = "SELECT pid, name, price, webprice, category, description, image FROM product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // Calculate margined price
                

                echo "<tr>";
                echo "<td>". $row["pid"] ."</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>₹" . $row["price"] . "</td>";
                echo "<td>₹" . $row["webprice"] . "</td>"; // Display web price
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
            echo "<tr><td colspan='8'>No products found</td></tr>";
        }

        // Process delete request
        if(isset($_POST['delete'])) {
            $delete_pid = $_POST['delete_pid'];
            $sql = "DELETE FROM product WHERE pid='$delete_pid'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Product deleted successfully');</script>";
                echo "<script>window.location.href='productshow.php';</script>";
            } else {
                echo "Error deleting product: " . $conn->error;
            }
        }
        ?>
    </table>
</body>
</html>
