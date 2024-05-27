<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Database credentials
    $servername = "localhost";
    $username = "root";
    $db_password = ""; // Your database password
    $dbname = "trial_project";

    // Create connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch customer data
    $sql = "SELECT * FROM customer WHERE email_address='$email' AND c_password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Authentication successful
        $row = $result->fetch_assoc();
        
        // Store user data in session for later use
        $_SESSION["customer_id"] = $row["c_id"];
        $_SESSION["customer_name"] = $row["c_name"];
        // Add more session variables as needed
        
        // Redirect to a dashboard or another page
        header("Location: display_products.php");
        exit();
    } else {
        // Authentication failed
        echo "Invalid email or password.";
    }

    // Close the database connection
    $conn->close();
}
?>
