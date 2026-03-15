<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}
include('../includes/config.php');

// Fetch patients and doctors for the modal dropdowns
$patients = $conn->query("SELECT id, name FROM patients ORDER BY name");
$doctors  = $conn->query("SELECT id, name FROM doctors ORDER BY name");
?>
<?php include('../includes/header.php'); ?>
<?php include('../includes/sidebar.php'); ?>

<div class="main-content">
    <div class="container-fluid p-4">
        <h2 class="mb-4">Appointment Management</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">
            <i class="fas fa-plus me-2"></i>Add New Appointment
        </button>

        <!-- Appointment Table -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date &amp; Time</th>
                            <th>Status</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentTableBody">
                        <!-- AJAX loaded data -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Appointment Modal -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Appointment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addAppointmentForm">
                    <div class="mb-3">
                        <label class="form-label">Patient</label>
                        <select class="form-select" name="patient_id" required>
                            <option value="">Select Patient</option>
                            <?php if ($patients && $patients->num_rows > 0): ?>
                                <?php while ($p = $patients->fetch_assoc()): ?>
                                    <option value="<?= htmlspecialchars($p['id']) ?>">
                                        <?= htmlspecialchars($p['name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Doctor</label>
                        <select class="form-select" name="doctor_id" required>
                            <option value="">Select Doctor</option>
                            <?php if ($doctors && $doctors->num_rows > 0): ?>
                                <?php while ($d = $doctors->fetch_assoc()): ?>
                                    <option value="<?= htmlspecialchars($d['id']) ?>">
                                        <?= htmlspecialchars($d['name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Appointment Date &amp; Time</label>
                        <input type="datetime-local" class="form-control" name="appointment_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Appointment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
