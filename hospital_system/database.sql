-- Hospital Management System - Database Schema
-- Run this script to create the database and tables.
-- Default admin credentials: username: admin, password: admin123

CREATE DATABASE IF NOT EXISTS hospital_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE hospital_db;

-- Users table (for authentication)
CREATE TABLE IF NOT EXISTS users (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50)                          NOT NULL UNIQUE,
    password VARCHAR(255)                         NOT NULL,
    role     ENUM('admin', 'doctor', 'nurse')     NOT NULL DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Patients table
CREATE TABLE IF NOT EXISTS patients (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)                        NOT NULL,
    gender     ENUM('Male', 'Female', 'Other')     NOT NULL,
    dob        DATE                                NOT NULL,
    contact    VARCHAR(20),
    address    TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Doctors table
CREATE TABLE IF NOT EXISTS doctors (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(100) NOT NULL,
    specialization VARCHAR(100),
    contact        VARCHAR(20),
    email          VARCHAR(100),
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Appointments table
CREATE TABLE IF NOT EXISTS appointments (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    patient_id       INT                                           NOT NULL,
    doctor_id        INT                                           NOT NULL,
    appointment_date DATETIME                                      NOT NULL,
    status           ENUM('Scheduled', 'Completed', 'Cancelled')  NOT NULL DEFAULT 'Scheduled',
    notes            TEXT,
    created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id)  REFERENCES doctors(id)  ON DELETE CASCADE
);

-- Default admin user (password: admin123)
INSERT INTO users (username, password, role)
VALUES ('admin', '$2y$10$I962CnF/sxgLOQRiRVplBOT2JUfkuYuNndrQfuD/U7sqyfD0AO5Li', 'admin')
ON DUPLICATE KEY UPDATE id = id;
