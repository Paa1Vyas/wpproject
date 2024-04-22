<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Users</h2>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by Name">
        <button type="submit">Search</button>
    </form>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Email Address</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        <?php
        // Database connection
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

        // Initialize search variable
        $search = "";

        // Check if search parameter is provided
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            // Sanitize the input to prevent SQL injection
            $search = $conn->real_escape_string($_GET['search']);
        }

        // Fetch data from customer table based on search parameter
        if(!empty($search)) {
            $sql = "SELECT c_id, c_name, mobilenumber, email_address, Address FROM customer WHERE c_name LIKE '%$search%'";
        } else {
            $sql = "SELECT c_id, c_name, mobilenumber, email_address, Address FROM customer";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["c_id"] ."</td>";
                echo "<td>" . $row["c_name"] . "</td>";
                echo "<td>" . $row["mobilenumber"] . "</td>";
                echo "<td>" . $row["email_address"] . "</td>";
                echo "<td>" . $row["Address"] . "</td>";
                echo "<td>";
                echo "<form method='POST' style='display: inline;'>";
                echo "<input type='hidden' name='delete_cid' value='" . $row["c_id"] . "'>";
                echo "<button type='submit' name='delete' class='delete-button'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No users found</td></tr>";
        }

        // Close connection
        $conn->close();

        // Process delete request
        if(isset($_POST['delete'])) {
            $delete_cid = $_POST['delete_cid'];

            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Delete row from customer table
            $sql = "DELETE FROM customer WHERE c_id='$delete_cid'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('User deleted successfully');</script>";
                echo "<script>window.location.href='manageuser.php';</script>";
            } else {
                echo "Error deleting user: " . $conn->error;
            }
            $conn->close();
        }
        ?>
    </table>
</body>
</html>
