<?php
// Establish database connection
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "trial_project"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST["category_name"];

    // Generate a new unique category ID
    $unique_id_found = false;
    $max_attempts = 100; // Maximum attempts to find a unique ID
    $attempt_count = 0;

    while (!$unique_id_found && $attempt_count < $max_attempts) {
        // Generate a random three-digit number
        $random_number = mt_rand(100, 999);

        // Construct category ID with prefix "C" and random number
        $category_id = "C" . $random_number;

        // Check if the generated ID already exists in the table
        $sql = "SELECT * FROM category WHERE cid = '$category_id'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            // ID doesn't exist, set unique_id_found to true
            $unique_id_found = true;
        }

        $attempt_count++;
    }

    if (!$unique_id_found) {
        die("Failed to generate a unique category ID. Please try again.");
    }

    // Insert category into the database
    $sql = "INSERT INTO category (cid, name) VALUES ('$category_id', '$category_name')";
    if ($conn->query($sql) === TRUE) {
        echo "New category added successfully";
        header("Location: createcategory.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
