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

    // Load patients on page load if the table exists
    if ($('#patientTableBody').length) {
        loadPatients();
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
            },
            error: function() {
                alert('An error occurred while adding the patient. Please try again.');
            }
        });
    });

    // Initialize Appointment Chart (dashboard only)
    const chartCanvas = document.getElementById('appointmentChart');
    if (chartCanvas) {
        const ctx = chartCanvas.getContext('2d');
        const appointmentChart = new Chart(ctx, {
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

    // Load summary data on page load (dashboard only)
    if ($('#totalPatients').length) {
        loadDashboardSummary();
    }
});