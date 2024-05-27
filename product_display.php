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
    <!-- dropdown menu navbar mare teni file alag thi banavani -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel='stylesheet' href='style/display_products.css'>

</head>

<body>
    <?php include 'navbar.php';?>
    <main class='main'>
        <div class='product'>





            <?php while($row = mysqli_fetch_array($result)): ?>
            <!-- Create a link around each image with the product ID (pid) as a query parameter -->


            <!-- <h3 class='text'>text</h3> -->
            <div class="cardDetail">

                <div class="card-bodyData">

                    <a href="product_detail.php?pid=<?php echo $row['pid']; ?>">
                        <div class="imgCenter">
                            <img src="uploads/<?php echo $row['image']; ?>" class='img' alt="Product Image">
                        </div>
                    </a>
                    <div class="productData">
                        <p>Name: <?php echo $row['name'] ?? ''; ?></p>
                        <p>Price: <?php echo $row['price'] ?? ''; ?></p>
                        <p class='Description'>Description: <?php echo $row['description'] ?? ''; ?></p>
                    </div>
                    <form action="registration.php" method="post">
                        <?php foreach ($_SESSION as $key => $value): ?>
                        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
                        <?php endforeach; ?>
                        <input type="submit" value="buy">
                    </form>

                </div>
            </div>








            <?php endwhile; ?>
        </div>
    </main>
</body>

</html>