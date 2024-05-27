<?php
session_start();
include 'connect.php';

$sql = "SELECT product.pid, product.name, product.price, cart.quantity FROM product  INNER JOIN cart ON product.pid = cart.productid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Product: " . $row["name"]. " - Price: $" . $row["price"]. " - Quantity: " . $row["quantity"]. "<br>";
    }
} else {
    echo "Cart is empty.";
}
?>
