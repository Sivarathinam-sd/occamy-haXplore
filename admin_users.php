<?php
require "auth_check.php";
include "db.php";

/* 🔐 ADMIN ONLY */
if ($role != 1) {
    die("Access denied");
}

/* Fetch all users */
$users = mysqli_query($conn, "
    SELECT id, fnm, unm, pnm, role 
    FROM users 
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin – Users</title>

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: #f4f6f9;
        margin: 0;
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

    h2 {
        text-align: center;
        margin: 25px 0;
        color: #333;
    }

    table {
        width: 90%;
        margin: auto;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    th {
        background: #34495e;
        color: #fff;
    }

    tr:hover {
        background: #f1f1f1;
    }

    .role-admin { color: #c0392b; font-weight: bold; }
    .role-farmer { color: #2e7d32; font-weight: bold; }
    .role-officer { color: #1565c0; font-weight: bold; }

    .back {
        margin: 20px auto;
        width: 90%;
        text-align: right;
    }

    .back a {
        background: #3498db;
        color: #fff;
        padding: 10px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }
</style>
</head>

<body>

<header>
    <h3>Admin Panel</h3>
    <a href="logout.php">Logout</a>
</header>

<h2>Registered Users</h2>

<div class="back">
    <a href="admin_dashboard.php">⬅ Back to Dashboard</a>
</div>

<table>
<tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Username</th>
    <th>Phone</th>
    <th>Role</th>
</tr>

<?php while ($u = mysqli_fetch_assoc($users)) { ?>
<tr>
    <td><?= $u['id'] ?></td>
    <td><?= htmlspecialchars($u['fnm']) ?></td>
    <td><?= htmlspecialchars($u['unm']) ?></td>
    <td><?= htmlspecialchars($u['pnm']) ?></td>
    <td>
        <?php
            if ($u['role'] == 1)
                echo "<span class='role-admin'>Admin</span>";
            elseif ($u['role'] == 2)
                echo "<span class='role-farmer'>Farmer</span>";
            else
                echo "<span class='role-officer'>Officer</span>";
        ?>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
