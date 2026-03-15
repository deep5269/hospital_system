<?php
include('../includes/config.php');

$response = [
    'totalPatients' => 0,
    'totalDoctors' => 0,
    'totalAppointments' => 0
];

// Get total patients
$sql = "SELECT COUNT(*) as total FROM patients";
$result = $conn->query($sql);
if ($result) {
    $response['totalPatients'] = $result->fetch_assoc()['total'];
}

// Get total doctors
$sql = "SELECT COUNT(*) as total FROM doctors";
$result = $conn->query($sql);
if ($result) {
    $response['totalDoctors'] = $result->fetch_assoc()['total'];
}

// Get total appointments
$sql = "SELECT COUNT(*) as total FROM appointments";
$result = $conn->query($sql);
if ($result) {
    $response['totalAppointments'] = $result->fetch_assoc()['total'];
}

echo json_encode($response);
$conn->close();
?>