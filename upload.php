<?php
if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    include "db_conn.php";

    // Fetching form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $profit_percentage = $_POST['profit_percentage']; // Fetching profit percentage
    $category = $_POST['category'];
    $description = $_POST['description'];
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 1250000000) {
            $em = "Sorry, your file is too large.";
            header("Location: upload.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                // Generate unique product ID
                $product_id = generateProductID($conn);

                // Calculating web price
                $web_price = $price + ($price * ($profit_percentage / 100));

                // Generating unique image name
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Inserting data into the database
                $sql = "INSERT INTO product(pid, name, price, webprice, category, description, image) VALUES('$product_id', '$name', '$price', '$web_price', '$category', '$description', '$new_img_name')";
                mysqli_query($conn, $sql);
                header("Location: productshow.php");
                exit();
            } else {
                $em = "You can't upload files of this type";
                header("Location: upload.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: upload.php?error=$em");
        exit();
    }
} else {
    header("Location: upload.php");
    exit();
}

// Function to generate a random 5-digit product ID with prefix "P"
function generateProductID($conn) {
    $product_id = "";
    do {
        $product_id = "P" . sprintf("%05d", rand(0, 99999));
        $sql = "SELECT * FROM product WHERE pid='$product_id'";
        $result = mysqli_query($conn, $sql);
    } while (mysqli_num_rows($result) > 0);
    return $product_id;
}
?>
