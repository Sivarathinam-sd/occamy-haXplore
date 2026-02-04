<?php
include "db.php";

$meeting_type = $_POST['meeting_type'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

if ($meeting_type === "one_on_one") {
    $stmt = $conn->prepare(
        "INSERT INTO meetings
        (meeting_type, person_name, category, phone, business_potential, latitude, longitude)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "sssssss",
        $meeting_type,
        $_POST['person_name'],
        $_POST['category'],
        $_POST['phone'],
        $_POST['business_potential'],
        $lat,
        $lng
    );
} else {
    $stmt = $conn->prepare(
        "INSERT INTO meetings
        (meeting_type, village_name, attendees, group_meeting_type, latitude, longitude)
        VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "ssisss",
        $meeting_type,
        $_POST['village_name'],
        $_POST['attendees'],
        $_POST['group_meeting_type'],
        $lat,
        $lng
    );
}

$stmt->execute();
$stmt->close();
$conn->close();

echo "Meeting saved successfully";
