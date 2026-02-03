<?php
require "jwt_helper.php";

if (!isset($_COOKIE['jwt'])) {
    header("Location: login.php");
    exit;
}

$payload = verifyJWT($_COOKIE['jwt']);

if (!$payload) {
    header("Location: login.php");
    exit;
}

/* Make JWT data available globally */
$user_id = $payload['user_id'] ?? null;
$role    = $payload['role'];
