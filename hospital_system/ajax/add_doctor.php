<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit();
}
include('../includes/config.php');

$data = $_POST;
$sql = "INSERT INTO doctors (name, specialization, contact, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss",
    $data['name'],
    $data['specialization'],
    $data['contact'],
    $data['email']
);

if ($stmt->execute()) {
    echo "Doctor added successfully";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
