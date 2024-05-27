<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>
    <h2>Add Category</h2>
    <h3>Existing Categories:</h3>
    <table>
        <tr>
            
            <th>Name</th>
            <th>Action</th>
        </tr>
        <?php
        // Establish database connection
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

        // Fetch existing categories from the database
        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
               
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>";
                echo "<a href='update_category.php?id=" . $row["cid"] . "' method='POST'>Update</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='delete_category.php?id=" . $row["cid"] . "' method='POST'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No categories found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
    <form method="post" action="crtcategory.php">
        <h3>Add New Category</h3>
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
