<?php
require "jwt_helper.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin") {

      $token = generateJWT([
    'user_id' => 0,   // admin (hardcoded)
    'username' => 'admin',
    'role' => 1
]);


        setcookie("jwt", $token, time() + 3600, "/", "", false, true);

        /* ✅ SESSION SET (IMPORTANT) */
        $_SESSION['username'] = 'admin';
        $_SESSION['role'] = 1;

        /* ✅ REDIRECT TO ADMIN PAGE */
        header("Location: admin_dashboard.php");
        exit;

    } else {
        $error = "Invalid Admin Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #e74a3b, #f6c23e);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .admin-login-container {
        background: #ffffff;
        padding: 32px 36px;
        width: 360px;
        border-radius: 12px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.18);
    }

    .admin-login-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 6px;
        color: #555;
    }

    .form-group input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        outline: none;
        transition: 0.3s;
    }

    .form-group input:focus {
        border-color: #e74a3b;
        box-shadow: 0 0 0 2px rgba(231,74,59,0.15);
    }

    .btn-admin {
        width: 100%;
        padding: 12px;
        background: #e74a3b;
        border: none;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-admin:hover {
        background: #c0392b;
    }

    .admin-footer {
        text-align: center;
        margin-top: 15px;
        font-size: 13px;
        color: #777;
    }

    .error {
        color: red;
        text-align: center;
        margin-bottom: 10px;
        font-size: 14px;
    }
</style>
</head>

<body>

<div class="admin-login-container">

    <h2>Admin Login</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button class="btn-admin" type="submit">Login</button>

        <div class="admin-footer">
            Restricted access • Admin only
        </div>

    </form>

</div>

</body>
</html>
