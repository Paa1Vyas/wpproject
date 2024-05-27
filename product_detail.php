<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: loginform.php");
    exit;
}

// Include config file
require_once "config.php";

// Initialize variables
$row = array();
$product_found = false;
$error_message = "";

// Check if pid is provided in the URL
if (isset($_GET["pid"]) && !empty(trim($_GET["pid"]))) {
    // Get the pid from the URL
    $pid = trim($_GET["pid"]);

    // Prepare a select statement
    $sql = "SELECT * FROM product WHERE pid = ?";

    // Attempt to execute the prepared statement
    $stmt = mysqli_prepare($link, $sql);
    if ($stmt) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $pid);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Store the result
            $result = mysqli_stmt_get_result($stmt);
            if ($result && mysqli_num_rows($result) == 1) {
                // Product found, fetch the details
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $product_found = true;
            } else {
                $error_message = "Product not found.";
            }
        } else {
            $error_message = "Failed to execute the statement: " . mysqli_error($link);
        }
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Failed to prepare the statement: " . mysqli_error($link);
    }
} else {
    $error_message = "Product ID not provided.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel='stylesheet' href='style/Product_detail.css'>
</head>

<body>
    <h2>Product Details</h2>
    <?php if ($product_found): ?>
    <div class='products_details'>


        <img src="uploads/<?php echo $row['image'] ?? ''; ?>" alt="Product Image" width="200">
        <div class="product_data">
            <p>Name: <?php echo $row['name'] ?? ''; ?></p>
            <p>Price: <?php echo $row['webprice'] ?? ''; ?></p>
            <p class='Description'>Description: <?php echo $row['description'] ?? ''; ?></p>
        </div>
    </div>
    <form action="registration.php" method="post">
        <input type="hidden" name="pid" value="<?php echo $row['pid'] ?? ''; ?>">
        <?php foreach ($_SESSION as $key => $value): ?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php endforeach; ?>
        <input type="submit" value="Buy Now" class='buy'>
    </form>
    <?php else: ?>
    <p><?php echo $error_message; ?></p>
    <?php endif; ?>
</body>

</html>