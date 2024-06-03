<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: loginadmin.php");
    exit;
}
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        .container {
            width: 50%;
            margin: 50px auto;
        }
        input[type="text"], input[type="email"], textarea, input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registration Form</h2>
        <form method="POST" action="d_registerprocess.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="id">ID:</label>
            <input type="id" id="id" name="id" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea>

            <label for="mobile_number">Mobile Number:</label>
            <input type="tel" id="mobile_number" name="mobile_number" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password"required>

            <input type="submit" value="Register">

            <label>If you have already registered <a href="loginform.php">Login here</a></label>

        </form>
    </div>
</body>
</html>
