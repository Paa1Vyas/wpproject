    <?php
    session_start();

    echo "Form submitted";  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["uname"];
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
        $sql = "SELECT * FROM admin WHERE uname='$uname' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Authentication successful
            $row = $result->fetch_assoc();
            
            // Store user data in session for later use
        
            
            // Redirect to a dashboard or another page
            header("Location: admin.html");
            exit();
        } else {
            // Authentication failed
            echo "Invalid email or password.";
        }

        // Close the database connection
        $conn->close();
    }
    ?>
