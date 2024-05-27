<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['customer_id'])) {
    // User is logged in, fetch customer ID
    $customer_id = $_SESSION['customer_id'];
} else {
    // User is not logged in, set customer ID to empty string
    $customer_id = "";
}

echo "<link rel='stylesheet' type='text/css' href='style/display_products.css'>";

// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "trial_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT pid, name, webprice, category, description, image FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) { ?>
        <div class="product">
            <!-- Display product image -->
            <td><img src="uploads/<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>" ></td>
            <form action="registration.php" method="POST">
                <input type="hidden" name="pid" value="<?php echo $row["pid"]; ?>">
                <!-- Pass customer ID if logged in -->
                <?php if(!empty($customer_id)) { ?>
                    <input type="hidden" name="cid" value="<?php echo $customer_id; ?>">
                <?php } ?>
                <!-- Display Buy Now button -->
                <!-- <input type="submit" value="Buy Now"> -->
            </form>
        </div>
    <?php }
    // Link to view orders
    echo "<a href='view_corders.php?cid=" . $customer_id . "'>View Orders</a>";
} else {
    echo "No products found.";
}

// Close the database connection
$conn->close();
?>
