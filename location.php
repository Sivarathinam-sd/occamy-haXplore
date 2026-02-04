<?php
$data = json_decode(file_get_contents("php://input"), true);

$lat = $data['lat'] ?? 0;
$lng = $data['lng'] ?? 0;

// variables assigned here
$response = [
  "lat" => $lat,
  "lng" => $lng
];

header("Content-Type: application/json");
echo json_encode($response);
