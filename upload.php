<?php 

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    include "db_conn.php";

    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";

    $name = $_POST['name'];
    $price = $_POST['price'];
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
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                // Generate product ID
                $sql_count = "SELECT COUNT(*) AS total FROM product";
                $result = mysqli_query($conn, $sql_count);
                $row = mysqli_fetch_assoc($result);
                $product_id = "P" . sprintf("%03d", $row['total'] + 1); // Generating product ID

                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql = "INSERT INTO product(pid, name, price, category, description, image) VALUES('$product_id', '$name', '$price', '$category', '$description', '$new_img_name')";
                mysqli_query($conn, $sql);
                header("Location: productshow.php");
            } else {
                $em = "You can't upload files of this type";
                header("Location: upload.php?error=$em");
            }
        }
    } else {
        $em = "unknown error occurred!";
        header("Location: upload.php?error=$em");
    }
} else {
    header("Location: upload.php");
}
?>
