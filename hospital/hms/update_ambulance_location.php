<?php
include 'include/config.php';
$data = json_decode(file_get_contents('php://input'), true);
$booking_id = $data['booking_id'];
$lat = $data['lat'];
$lng = $data['lng'];
if ($booking_id && $lat && $lng) {
    $stmt = mysqli_prepare($con, "UPDATE ambulance_bookings SET ambulance_lat=?, ambulance_lng=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ddi", $lat, $lng, $booking_id);
    mysqli_stmt_execute($stmt);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Missing data']);
}
?> 