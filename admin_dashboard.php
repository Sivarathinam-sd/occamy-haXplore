<?php
require "auth_check.php";
include "db.php";

/* 🔐 Admin only */
if ($role != 1) {
    die("Access denied");
}

/* ====== COUNTS ====== */
$totalUsers   = $conn->query("SELECT COUNT(*) c FROM users")->fetch_assoc()['c'];
$totalFarmers = $conn->query("SELECT COUNT(*) c FROM users WHERE role=2")->fetch_assoc()['c'];
$totalOfficers= $conn->query("SELECT COUNT(*) c FROM users WHERE role=3")->fetch_assoc()['c'];
$totalSales   = $conn->query("SELECT COUNT(*) c FROM sales")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
    body {
        font-family: "Segoe UI", sans-serif;
        margin: 0;
        background: #f4f6f9;
    }
    header {
        background: #b03a2e;
        color: #fff;
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    header a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
    }
    .container {
        padding: 30px;
    }
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    .card {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        text-align: center;
    }
    .card h2 {
        margin: 0;
        font-size: 32px;
        color: #333;
    }
    .card p {
        margin-top: 8px;
        color: #777;
    }
    .actions {
        margin-top: 30px;
        display: flex;
        gap: 15px;
    }
    .actions a {
        padding: 12px 20px;
        background: #e74c3c;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }
    .actions a.blue { background:#3498db; }
    .actions a.green { background:#2ecc71; }
</style>
</head>

<body>

<header>
    <h2>Admin Dashboard</h2>
    <a href="logout.php">Logout</a>
</header>

<div class="container">

    <div class="cards">
        <div class="card">
            <h2><?= $totalUsers ?></h2>
            <p>Total Users</p>
        </div>
        <div class="card">
            <h2><?= $totalFarmers ?></h2>
            <p>Farmers</p>
        </div>
        <div class="card">
            <h2><?= $totalOfficers ?></h2>
            <p>Officers</p>
        </div>
        <div class="card">
            <h2><?= $totalSales ?></h2>
            <p>Total Sales</p>
        </div>
    </div>

    <div class="actions">
        <a href="admin_sales_view.php" class="blue">View Sales</a>
        <a href="admin_users.php" class="green">View Users</a>
    </div>

</div>

</body>
</html>
