<?php
include "db.php";
require "jwt_helper.php";

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

        echo ucfirst($row['role']) . " Login Successful<br>";
        echo "JWT Token Generated";
        exit;

    } else {
        echo "Invalid Username or Password";
    }
}
?>

<form method="post">
    <h2>User Login</h2>
    Username: <input type="text" name="unm" required><br><br>
    Password: <input type="password" name="pwd" required><br><br>
    <button type="submit">Login</button>
</form>
