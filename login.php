<?php
include "db.php";
require "jwt_helper.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unm = $_POST['unm'];
    $pwd = $_POST['pwd'];

    $res = $conn->query("SELECT * FROM users WHERE unm='$unm' AND pwd='$pwd'");

    if ($res->num_rows == 1) {
        $row = $res->fetch_assoc();

        /* 🔐 Generate JWT */
        $token = generateJWT([
            'user_id' => $row['id'],
            'username' => $row['unm'],
            'role' => $row['role']
        ]);

        setcookie("jwt", $token, time() + 3600, "/", "", false, true);

        /* ✅ SESSION SET (IMPORTANT FIX) */
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        /* ✅ ROLE BASED REDIRECT */
        if ($row['role'] == 'admin') {
            header("Location: admin_sales_view.php");
        } else {
            header("Location: sales_form.php");
        }
        exit;

    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Login</title>

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #6ba992, #4e73df);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .login-container {
        background: #ffffff;
        padding: 30px 35px;
        width: 360px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .login-container h2 {
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
        border-color: #1cc88a;
        box-shadow: 0 0 0 2px rgba(28,200,138,0.15);
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        background: #1cc88a;
        border: none;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #17a673;
    }

    .login-footer {
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

<div class="login-container">

    <h2>User Login</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="unm" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="pwd" required>
        </div>

        <button class="btn-login" type="submit">Login</button>

        <div class="login-footer">
            Secure login using JWT authentication
        </div>

    </form>

</div>

</body>
</html>
