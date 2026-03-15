<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

include('../includes/config.php');

$response = [
    'totalPatients'     => 0,
    'totalDoctors'      => 0,
    'totalAppointments' => 0
];

// Get total patients
$result = $conn->query("SELECT COUNT(*) as total FROM patients");
if ($result) {
    $response['totalPatients'] = (int) $result->fetch_assoc()['total'];
}

// Get total doctors
$result = $conn->query("SELECT COUNT(*) as total FROM doctors");
if ($result) {
    $response['totalDoctors'] = (int) $result->fetch_assoc()['total'];
}

// Get total appointments
$result = $conn->query("SELECT COUNT(*) as total FROM appointments");
if ($result) {
    $response['totalAppointments'] = (int) $result->fetch_assoc()['total'];
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
?>
