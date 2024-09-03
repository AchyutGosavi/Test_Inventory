CREATE DATABASE IF NOT EXISTS asset_inventory;

USE asset_inventory;

CREATE TABLE IF NOT EXISTS assets (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_name VARCHAR(255) NOT NULL,
    employee_id VARCHAR(50) NOT NULL,
    cpu_no VARCHAR(50) NOT NULL,
    asset_tag VARCHAR(50) NOT NULL,
    service_tag VARCHAR(50) NOT NULL,
    purchase_date DATE NOT NULL,
    issued_status ENUM('Issued', 'Not Issued') NOT NULL,
    issued_date DATE,
    verification_status ENUM('Verified', 'Not Verified') NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);