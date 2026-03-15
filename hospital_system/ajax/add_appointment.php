<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit();
}
include('../includes/config.php');

$data = $_POST;
$sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, status, notes) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisss",
    $data['patient_id'],
    $data['doctor_id'],
    $data['appointment_date'],
    $data['status'],
    $data['notes']
);

if ($stmt->execute()) {
    echo "Appointment added successfully";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
