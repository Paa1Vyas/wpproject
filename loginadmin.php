<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="admin_login_process.php" method="POST">
        <label for="uname">Username:</label>
        <input type="text" id="uname" name="uname"><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Login" onsubmit="admin_login_process.php">
    </form>
</body>
</html>
