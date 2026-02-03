<?php
session_start();
$role = $_GET['role'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Role</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #5d8f95, #acb6e5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .admin { background: #b03a2e; color: #fff; }
        .farmer { background: #2e7d32; }
        .officer { background: #1565c0; color: #fff; }
        .login { background: #4e73df; color: #fff; }
        .register { background: #1cc88a; color: #fff; }
    </style>
</head>

<body>
<div class="container">

<?php if (!$role): ?>

    <h2>Select Role</h2>

    <form action="admin_login.php" method="get">
        <button class="admin">Admin</button>
    </form>

    <form method="get">
        <input type="hidden" name="role" value="farmer">
        <button class="farmer">Farmer</button>
    </form>

    <form method="get">
        <input type="hidden" name="role" value="officer">
        <button class="officer">Officer</button>
    </form>

<?php else: ?>

    <h2><?= ucfirst($role) ?></h2>

    <form action="login.php" method="get">
        <button class="login">Already Registered? Login</button>
    </form>

    <form action="register.php" method="get">
        <input type="hidden" name="role" value="<?= $role ?>">
        <button class="register">New User? Register</button>
    </form>

<?php endif; ?>

</div>
</body>
</html>