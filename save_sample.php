<?php
require "auth_check.php";
include "db.php";

$user_id = $user_id; // from JWT

$receiver_name = $_POST['receiver_name'];
$receiver_type = $_POST['receiver_type'];
$sample_product = $_POST['sample_product'];
$quantity = $_POST['quantity'];
$purpose = $_POST['purpose'];
$date = $_POST['distribution_date'];
$notes = $_POST['notes'];

$sql = "INSERT INTO sample_distributions
(user_id, receiver_name, receiver_type, sample_product, quantity, purpose, distribution_date, notes)
VALUES
('$user_id','$receiver_name','$receiver_type','$sample_product','$quantity','$purpose','$date','$notes')";

if (mysqli_query($conn, $sql)) {
    echo "Sample distribution recorded successfully";
} else {
    echo "Error saving sample data";
}
