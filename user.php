<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <link rel="stylesheet" href="style/account.css">
</head>

<body>
    <h1>User Account</h1>
    <div class="account-info">
        <h2>Personal Details</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['c_name']); ?></p>
        <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($user['mobilenumber']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email_address']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['Address']); ?></p>
    </div>
    <div class="purchase-history">
        <h2>Purchase History</h2>
        <?php if (count($purchases) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $purchase): ?>
                <tr>
                    <td><?php echo htmlspecialchars($purchase['orderid']); ?></td>
                    <td><?php echo htmlspecialchars($purchase['start_date']); ?></td>
                    <td><?php echo htmlspecialchars($purchase['status']); ?></td>
                    <td><?php echo htmlspecialchars($purchase['p_name']); ?></td>
                    <td><?php echo htmlspecialchars($purchase['price']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No purchase history available.</p>
        <?php endif; ?>
    </div>
    <div class="account-actions">
        <a href="edit_account.php">Edit Account</a> | <a href="logout.php">Logout</a>
    </div>
</body>

</html>