<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo "Unauthorized";
    exit();
}

include('../includes/config.php');

$name    = trim($_POST['name'] ?? '');
$gender  = trim($_POST['gender'] ?? '');
$dob     = trim($_POST['dob'] ?? '');
$contact = trim($_POST['contact'] ?? '');
$address = trim($_POST['address'] ?? '');

// Validate required fields
if (empty($name) || empty($gender) || empty($dob)) {
    echo "Name, gender, and date of birth are required.";
    exit();
}

// Validate date format (YYYY-MM-DD)
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob) || !checkdate(
    (int) substr($dob, 5, 2),
    (int) substr($dob, 8, 2),
    (int) substr($dob, 0, 4)
)) {
    echo "Invalid date of birth.";
    exit();
}

$sql = "INSERT INTO patients (name, gender, dob, contact, address) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $gender, $dob, $contact, $address);

if ($stmt->execute()) {
    echo "Patient added successfully";
} else {
    error_log("add_patient error: " . $conn->error);
    echo "An error occurred. Please try again.";
}
?>
