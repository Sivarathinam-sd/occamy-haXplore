<?php
session_start();
include "db.php"; // Database connection

// Only allow Admin (role 1) to access this page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("Location: unauthorized.php"); // redirect if not admin
    exit;
}

// Fetch data from sample_distribution table
$sql = "SELECT * FROM sample_distributions ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Officer Form - Sample Distribution</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        h1 { color: #007bff; }
        a.button { background-color: #007bff; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; }
        a.button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>Officer Form - Sample Distribution</h1>
    <a href="admin_dashboard.php" class="button">Back to Dashboard</a>

    <?php if(mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Sample Name</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Receiver Name</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['sample_product']) ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['distribution_date'] ?></td>
                    <td><?= htmlspecialchars($row['receiver_name']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No sample distributions found.</p>
    <?php endif; ?>
</body>
</html>
