<?php
include 'include/config.php';
$booking_id = $_GET['booking_id'];
$res = mysqli_query($con, "SELECT ambulance_lat, ambulance_lng FROM ambulance_bookings WHERE id=" . intval($booking_id));
$row = mysqli_fetch_assoc($res);
echo json_encode(['lat' => $row['ambulance_lat'], 'lng' => $row['ambulance_lng']]);
?> 