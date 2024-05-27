<!-- product_details.php -->
<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: loginform.php");
    exit;
}

// Include config file
require_once "config.php";


// Fetch images and corresponding pids from the database

$sql = "SELECT * FROM product";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Details</title>

    <link rel='stylesheet' href='style/display_products.css'>

</head>

<body>
    <?php include 'navbar.php';?>
    <main class='main'>
        <div class='product'>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <div class="cardDetail">
                <div class="card-bodyData">
                    <a href="product_detail.php?pid=<?php echo $row['pid']; ?>">
                        <div class="imgCenter">
                            <img src="uploads/<?php echo $row['image']; ?>" class='img product_image'
                                alt="Product Image">
                        </div>
                    </a>
                    <div class="productData">
                        <p>Name: <?php echo $row['name'] ?? ''; ?></p>
                        <p>Price: <?php echo $row['price'] ?? ''; ?></p>
                        <p class='Description'>Description: <?php echo $row['description'] ?? ''; ?></p>
                        <div class="buttonCenter">
                            <form action="registration.php" method="post">
                                <!-- Include the product ID as a hidden input -->
                                <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                                <!-- Optionally include the customer ID if it's in the session -->
                                <?php if(!empty($_SESSION['customer_id'])): ?>
                                <input type="hidden" name="cid" value="<?php echo $_SESSION['customer_id']; ?>">
                                <?php endif; ?>
                                <!-- Include all session variables -->
                                <?php foreach ($_SESSION as $key => $value): ?>
                                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
                                <?php endforeach; ?>
                                <input class="buyButton" type="submit" value="buy">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>

</html>