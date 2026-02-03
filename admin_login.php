<?php
require "jwt_helper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin") {

        /* 🔐 Generate JWT */
        $token = generateJWT([
            'username' => 'admin',
            'role' => 1
        ]);

        setcookie("jwt", $token, time() + 3600, "/", "", false, true);

        echo "Admin Login Successful<br>";
        echo "JWT Token Generated";
        exit;
    } else {
        echo "Invalid Admin Credentials";
    }
}
?>

<form method="post">
    <h2>Admin Login</h2>
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>