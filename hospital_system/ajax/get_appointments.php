<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    exit();
}
include('../includes/config.php');

$sql = "SELECT a.id, p.name AS patient_name, d.name AS doctor_name,
               a.appointment_date, a.status, a.notes
        FROM appointments a
        JOIN patients p ON a.patient_id = p.id
        JOIN doctors d ON a.doctor_id = d.id
        ORDER BY a.appointment_date DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $statusClass = '';
        if ($row['status'] === 'Completed') $statusClass = 'text-success fw-bold';
        elseif ($row['status'] === 'Cancelled') $statusClass = 'text-danger fw-bold';
        else $statusClass = 'text-primary fw-bold';

        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['patient_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['doctor_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['appointment_date']) . '</td>';
        echo '<td class="' . $statusClass . '">' . htmlspecialchars($row['status']) . '</td>';
        echo '<td>' . htmlspecialchars($row['notes']) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6" class="text-center">No appointments found</td></tr>';
}

$conn->close();
?>
