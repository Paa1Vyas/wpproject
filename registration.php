<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['customer_id'])) {
    // User is logged in, fetch customer ID
    $c_id = $_SESSION['customer_id'];
} else {
    // User is not logged in, handle accordingly
    // Redirect to login page or display a message
    header("Location: loginform.php");
    exit();
}

// Fetch the product ID from the URL parameter
if(isset($_GET['pid'])) {
    $p_id = $_GET['pid'];
} else if(isset($_POST['pid'])) {
    $p_id = $_POST['pid'];
} else {
    // Handle case where pid is not provided
    echo "Product ID not provided.";
    exit();
}

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

// Fetch data from the database for the specified product ID and customer ID
$sql = "SELECT pid, name, price, category, c_name, mobilenumber, email_address, Address FROM product JOIN customer WHERE c_id='$c_id' && pid='$p_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_name = $row["name"];
    $price = $row["price"];
    $category = $row["category"];
    $customer_name = $row["c_name"];
    $mobile_number = $row["mobilenumber"];
    $email = $row["email_address"];
    $address = $row["Address"];
} else {
    echo "No results found for product ID: $p_id<br>";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <link rel='stylesheet' href='style/registraion.css'>
</head>

<body>
    <h2>Order Form</h2>
    <form id="orderForm" method="POST">

        <h3>Product</h3>
        <input type="hidden" name="pid" value="<?php echo $p_id; ?>">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>"><br><br>

        <label for="product_price">Product Price:</label>
        <input type="text" id="product_price" name="product_price" value="<?php echo $price; ?>"><br><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo $category; ?>"><br><br>

        <!-- Customer Details -->
        <h3>Customer Details</h3>
        <label for="c_name">Customer Name:</label>
        <input type="text" id="c_name" name="c_name" value="<?php echo $customer_name; ?>"><br><br>

        <label for="mobile_number">Mobile Number:</label>
        <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $mobile_number; ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address"><?php echo $address; ?></textarea><br><br>

        <h3>Customize</h3>
        <label for="customize">Customize:</label><br>
        <textarea id="customize" name="customize" rows="5" cols="50"></textarea><br><br>

        <input type="hidden" name="pid" value="<?php echo $p_id; ?>">
        <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">

        <input type="button" value="Pay Now" id="submitButton">
        <!-- Changed type to "button" to prevent default form submission -->
    </form>

    <script>
    document.getElementById("submitButton").addEventListener("click", function() {
        // Fetch amount and currency
        var amount = document.getElementById("product_price").value;

        // Prepare options for Razorpay checkout
        var options = {
            key: 'rzp_test_3z40UJhhML6EE6',
            amount: amount * 100, // amount in paisa
            currency: 'INR',
            name: 'Your Company Name',
            description: 'Product Purchase',
            image: 'https://example.com/your_logo.png',
            handler: function(response) {
                // Handle payment success
                console.log(response);
                // Redirect or perform further actions as needed
                sendOrderData(response);
            },
            prefill: {
                name: '<?php echo $customer_name; ?>',
                email: '<?php echo $email; ?>',
                contact: '<?php echo $mobile_number; ?>'
            },
            theme: {
                color: '#F37254'
            }
        };

        // Open Razorpay checkout
        var rzp = new Razorpay(options);
        rzp.open();
    });

    function sendOrderData(response) {
        // Extracting relevant data from the response
        var paymentId = response.razorpay_payment_id;
        var orderId = response.razorpay_order_id;
        var signature = response.razorpay_signature;

        // Gather other form data
        var formData = new FormData(document.getElementById("orderForm"));

        // Append payment data to form data
        formData.append("payment_id", paymentId);
        formData.append("order_id", orderId);
        formData.append("signature", signature);

        // Send form data to process_order.php using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_order.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Order processing successful, handle response
                    console.log(xhr.responseText);
                    // Redirect or perform further actions as needed
                } else {
                    // Order processing failed, handle error
                    console.error("Error processing order:", xhr.responseText);
                    // Display error message to user or take appropriate action
                }
            }
        };
        xhr.send(formData); // Send form data
    }
    </script>

</body>

</html>