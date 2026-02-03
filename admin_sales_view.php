<?php
require "auth_check.php";   // JWT validation happens here
include "db.php";

/* 🔐 ADMIN CHECK (ROLE = 1) */
if ($role != 1) {
    die("Access denied");
}

/* Fetch sales data */
$data = mysqli_query($conn, "SELECT * FROM sales ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Sales</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 30px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #3498db;
            color: white;
        }
    </style>
</head>
<body>

<h2 align="center">Sales Overview</h2>

<table>
<tr>
    <th>User ID</th>
    <th>Type</th>
    <th>Buyer</th>
    <th>SKU</th>
    <th>Pack</th>
    <th>Qty</th>
    <th>Mode</th>
    <th>Repeat</th>
    <th>Date</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $row['user_id'] ?></td>
    <td><?= $row['sale_type'] ?></td>
    <td><?= $row['buyer_name'] ?></td>
    <td><?= $row['product_sku'] ?></td>
    <td><?= $row['pack_size'] ?></td>
    <td><?= $row['quantity'] ?></td>
    <td><?= $row['mode'] ?></td>
    <td><?= $row['repeat_order'] ?></td>
    <td><?= $row['created_at'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>
