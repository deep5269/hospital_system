$(document).ready(function() {
    // Load patients
    function loadPatients() {
        $.ajax({
            url: '../ajax/get_patients.php',
            method: 'GET',
            success: function(response) {
                $('#patientTableBody').html(response);
            }
        });
    }

    // Load doctors
    function loadDoctors() {
        $.ajax({
            url: '../ajax/get_doctors.php',
            method: 'GET',
            success: function(response) {
                $('#doctorTableBody').html(response);
            }
        });
    }

    // Load appointments
    function loadAppointments() {
        $.ajax({
            url: '../ajax/get_appointments.php',
            method: 'GET',
            success: function(response) {
                $('#appointmentTableBody').html(response);
            }
        });
    }

    // Add Patient
    $('#addPatientForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '../ajax/add_patient.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                loadPatients();
                $('#addPatientModal').modal('hide');
                $('#addPatientForm')[0].reset();
            }
        });
    });

    // Add Doctor
    $('#addDoctorForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '../ajax/add_doctor.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                loadDoctors();
                $('#addDoctorModal').modal('hide');
                $('#addDoctorForm')[0].reset();
            }
        });
    });

    // Add Appointment
    $('#addAppointmentForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '../ajax/add_appointment.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                loadAppointments();
                $('#addAppointmentModal').modal('hide');
                $('#addAppointmentForm')[0].reset();
            }
        });
    });

    // Initialize Appointment Chart (only on dashboard)
    const chartCanvas = document.getElementById('appointmentChart');
    if (chartCanvas) {
        const ctx = chartCanvas.getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Appointments',
                    data: [12, 19, 3, 5, 2, 3, 10],
                    backgroundColor: 'rgba(44, 123, 229, 0.2)',
                    borderColor: 'rgba(44, 123, 229, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Load Dashboard Summary Data
    function loadDashboardSummary() {
        $.ajax({
            url: '../ajax/get_dashboard_summary.php',
            method: 'GET',
            success: function(response) {
                const data = JSON.parse(response);
                $('#totalPatients').text(data.totalPatients);
                $('#totalDoctors').text(data.totalDoctors);
                $('#totalAppointments').text(data.totalAppointments);
            }
        });
    }

    // Load appropriate data based on current page
    if ($('#totalPatients').length) {
        loadDashboardSummary();
    }
    if ($('#patientTableBody').length) {
        loadPatients();
    }
    if ($('#doctorTableBody').length) {
        loadDoctors();
    }
    if ($('#appointmentTableBody').length) {
        loadAppointments();
    }
});