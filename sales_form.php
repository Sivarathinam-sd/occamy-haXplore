<?php
require "auth_check.php";
include "db.php";

/* Fetch products */
$products = mysqli_query($conn, "SELECT * FROM products WHERE status='active'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Entry</title>
    <style>
        body { font-family: Arial; background:#f4f6f8; }
        form {
            background:#fff;
            padding:20px;
            width:350px;
            margin:40px auto;
            border-radius:8px;
        }
        input, select, button {
            width:100%;
            padding:8px;
            margin:8px 0;
        }
        button {
            background:#2ecc71;
            border:none;
            color:#fff;
        }
    </style>
</head>
<body>

<form action="save_sale.php" method="POST">
    <h3>Sales Entry</h3>

    <!-- Sale Type -->
    <label>Sale Type</label>
    <select name="sale_type" required>
        <option value="">Select</option>
        <option value="B2C">B2C - Farmer</option>
        <option value="B2B">B2B - Distributor</option>
    </select>

    <label>Buyer Name</label>
    <input type="text" name="buyer_name" required>

    <!-- Product -->
    <label>Product</label>
    <select name="product_sku" required>
        <option value="">Select Product</option>
        <?php while ($p = mysqli_fetch_assoc($products)) { ?>
            <option value="<?= $p['sku'] ?>">
                <?= $p['product_name'] ?> (<?= $p['pack_size'] ?>)
            </option>
        <?php } ?>
    </select>

    <label>Pack Size</label>
    <input type="text" name="pack_size" required>

    <label>Quantity Sold</label>
    <input type="number" name="quantity" required>

    <!-- Mode -->
    <label>Mode</label>
    <select name="mode" required>
        <option value="Direct">Direct</option>
        <option value="Via Distributor">Via Distributor</option>
    </select>

    <!-- Repeat -->
    <label>Repeat Order?</label>
    <select name="repeat_order" required>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>

    <!-- JWT USER ID -->
    <input type="hidden" name="user_id" value="<?= $user_id ?>">

    <button type="submit">Submit Sale</button>
</form>

</body>
</html>
