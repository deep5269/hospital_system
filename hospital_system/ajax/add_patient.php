<?php
include('../includes/config.php');

$data = $_POST;
$sql = "INSERT INTO patients (name, gender, dob, contact, address) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", 
    $data['name'],
    $data['gender'],
    $data['dob'],
    $data['contact'],
    $data['address']
);

if($stmt->execute()) {
    echo "Patient added successfully";
} else {
    echo "Error: " . $conn->error;
}
?>