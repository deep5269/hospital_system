<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: pages/dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hospital Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-card">
        <h2>Hospital Management System</h2>
        <form id="loginForm">
            <div class="mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div id="errorMessage" class="error-message"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle Login Form Submission
            $('#loginForm').submit(function(e) {
                e.preventDefault(); // Prevent form from reloading the page

                // Clear previous error message
                $('#errorMessage').hide();

                // Get form data
                const formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    url: 'ajax/login.php',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response === 'success') {
                            // Redirect to dashboard on successful login
                            window.location.href = 'pages/dashboard.php';
                        } else {
                            // Show error message
                            $('#errorMessage').text(response).fadeIn();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors
                        $('#errorMessage').text('An error occurred. Please try again.').fadeIn();
                    }
                });
            });
        });
    </script>
</body>
</html>
