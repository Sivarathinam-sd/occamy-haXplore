<?php
require "auth_check.php";
include "db.php";

/* Trust JWT, not POST */
$user_id      = $user_id;
$sale_type    = $_POST['sale_type'];
$buyer_name   = $_POST['buyer_name'];
$product_sku = $_POST['product_sku'];
$pack_size    = $_POST['pack_size'];
$quantity     = $_POST['quantity'];
$mode         = $_POST['mode'];
$repeat_order = $_POST['repeat_order'];

$sql = "INSERT INTO sales
(user_id, sale_type, buyer_name, product_sku, pack_size, quantity, mode, repeat_order)
VALUES
('$user_id','$sale_type','$buyer_name','$product_sku','$pack_size','$quantity','$mode','$repeat_order')";


if (mysqli_query($conn, $sql)) {
    echo "Sale recorded successfully";
} else {
    echo "Error saving sale";
}
