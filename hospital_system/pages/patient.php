<?php include('includes/header.php'); ?>

<h2>Patient Management</h2>
<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add New Patient</button>

<!-- Patient Table -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="patientTableBody">
        <!-- AJAX loaded data -->
    </tbody>
</table>

<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal">
    <!-- Modal content here -->
</div>

<?php include('includes/footer.php'); ?>