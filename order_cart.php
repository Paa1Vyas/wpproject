<!DOCTYPE html>
<html lang="en">
    <head>   
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping Cart</title>
    </head>
    <body>
        <h1>Products</h1>
        <ul>
            <?php
            include 'connect.php';

            // Fetch products from the database

            $sql = "SELECT * FROM product";
            $result = $conn->query($sql);
            

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . $row["name"] . $row["price"] . " <button onclick='addToCart({$row['pid']})'>Add to Cart</button></li>";

                }
            } else {
                echo "No products available.";
            }
            ?>
        </ul>

        <h1>Shopping Cart</h1>
        <div id="cart"></div>

        <script>
            function addToCart(pid) {
                
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                        // showCart();
                    }
                };
                alert()
                xhttp.open("POST", "addtocart.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("pid=" + pid);
                console.log("added to cart")
                showCart();
            }

            function showCart() {
                console.log("Show Cart")
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("cart").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "viewcart.php", true);
                xhttp.send();
            }

            // Initial load of the cart
            showCart();
        </script>
    </body>
    </html>
