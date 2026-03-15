<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit();
}
include('../includes/config.php');

$sql = "SELECT id, name, gender, dob, contact, address FROM patients ORDER BY id DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['gender']) . '</td>';
        echo '<td>' . htmlspecialchars($row['dob']) . '</td>';
        echo '<td>' . htmlspecialchars($row['contact']) . '</td>';
        echo '<td>' . htmlspecialchars($row['address']) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6" class="text-center">No patients found</td></tr>';
}

$conn->close();
?>
