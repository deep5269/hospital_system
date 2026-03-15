# Hospital Management System

A PHP-based Hospital Management System with login, patient management, and a dashboard.

## Features

- Secure user authentication (login/logout) with session management
- Dashboard with summary statistics (patients, doctors, appointments)
- Patient management (add/view patients)
- Responsive design using Bootstrap 5

## Requirements

- PHP 7.4 or higher (with `mysqli` extension)
- MySQL / MariaDB
- A web server such as Apache or Nginx

## Setup

### 1. Clone and Place Files

Place the project files in your web server's document root (e.g. `/var/www/html/hospital_system`).

### 2. Create the Database

Log in to MySQL and run the following SQL to set up the database and a default admin user:

```sql
CREATE DATABASE IF NOT EXISTS hospital_db;
USE hospital_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'doctor', 'nurse') NOT NULL DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    dob DATE NOT NULL,
    contact VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialization VARCHAR(100),
    contact VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATETIME NOT NULL,
    status ENUM('Scheduled', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Scheduled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
);

-- Insert a default admin user (password: admin123)
INSERT INTO users (username, password, role)
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
```

> **Note:** The default password hash above corresponds to `admin123`. Change this immediately after first login.

### 3. Configure Database Connection

Edit `includes/config.php` to match your database credentials:

```php
$host = 'localhost';
$user = 'root';
$pass = 'your_password';
$db   = 'hospital_db';
```

### 4. Access the Application

Open your browser and navigate to:

```
http://localhost/hospital_system/login.php
```

Log in with:
- **Username:** `admin`
- **Password:** `admin123`

## Project Structure

```
hospital_system/
├── ajax/
│   ├── add_patient.php          # AJAX: add a new patient
│   ├── get_dashboard_summary.php # AJAX: dashboard statistics
│   └── login.php                # AJAX: authenticate user
├── css/
│   └── style.css                # Custom styles
├── includes/
│   ├── config.php               # Database connection
│   ├── footer.php               # Shared page footer
│   ├── header.php               # Shared page header
│   └── sidebar.php              # Shared navigation sidebar
├── js/
│   └── custom.js                # Custom JavaScript
├── pages/
│   ├── dashboard.php            # Dashboard page (protected)
│   ├── logout.php               # Logout handler
│   └── patient.php              # Patient management page (protected)
└── login.php                    # Login page
```
