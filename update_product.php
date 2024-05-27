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

// Check if product ID is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $pid = $conn->real_escape_string($_GET['id']);

    // Fetch product details based on the provided pid
    $sql = "SELECT * FROM product WHERE pid = '$pid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data
        $row = $result->fetch_assoc();
        // Display form with pre-filled product details for update
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Update Product</title>
        </head>
        <body>
            <h2>Update Product</h2>
            <form action="process_update_product.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br>
                <label for="price">Original Price:</label><br>
                <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>"><br>
                <label for="price">Marginal Price:</label><br>
                <input type="text" id="webprice" name="webprice" value="<?php echo $row['webprice']; ?>"><br>
                <label for="category">Category:</label><br>
                <input type="text" id="category" name="category" value="<?php echo $row['category']; ?>"><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description"><?php echo $row['description']; ?></textarea><br>
                <label for="image">Image:</label><br>
                <input type="file" id="image" name="image" value="<?php echo $row['image']; ?>"><br>
                <button type="submit" formaction="process_update_product.php">Update</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not provided.";
}

// Close connection
$conn->close();
?>
