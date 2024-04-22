<?php
// Connect to MySQL
$conn = new mysqli('localhost', 'root', '', 'trial_project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from database
$sql = "SELECT pid, name, price FROM product";
$result = $conn->query($sql);

// Display products
if ($result->num_rows > 0) {
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<li>{$counter}. {$row['name']} - \${$row['price']} ";
        echo "<form action='add_to_cart.php' method='post'>";
        echo "<input type='hidden' name='product_id' value='{$row['pid']}'>";
        echo "<input type='number' name='quantity' value='1' min='1'>";
        echo "<button type='submit'>Add to Cart</button>";
        echo "</form></li>";
        $counter++;
    }
} else {
    echo "No products available.";
}

// Close connection
$conn->close();
?>
