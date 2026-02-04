<?php
session_start();

/* 🔐 Destroy session */
session_unset();
session_destroy();

/* 🍪 Remove JWT cookie */
if (isset($_COOKIE['jwt'])) {
    setcookie("jwt", "", time() - 3600, "/", "", false, true);
}

/* 🔁 Redirect to role selection */
header("Location: admin_login.php");
exit;
