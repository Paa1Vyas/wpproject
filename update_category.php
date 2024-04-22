<?php
if(isset($_GET['id'])) {
    // Database connection details
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

    // Get category ID from the URL parameter
    $cid = $conn->real_escape_string($_GET['id']);

    // Fetch category details from the database
    $sql = "SELECT * FROM category WHERE cid = '$cid'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $category_name = $row['name']; // Get the current category name
    } else {
        echo "Category not found";
        exit;
    }

    // Close the connection
    $conn->close();
} else {
    echo "Category ID not provided";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Category</title>
</head>
<body>
    <h2>Update Category</h2>
    <form method="post" action="process_update_category.php" enctype="multipart/form-data">
        <input type="hidden" name="cid" value="<?php echo $cid; ?>">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" value="<?php echo $category_name; ?>" required>
        <button type="submit" formaction="process_update_category.php">Update</button>
    </form>
</body>
</html>
