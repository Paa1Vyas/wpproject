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
        <form method="POST" action="register_process.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea>

            <label for="mobile_number">Mobile Number:</label>
            <input type="tel" id="mobile_number" name="mobile_number" required>

            <input type="submit" value="Register">

        </form>
    </div>
</body>
</html>
