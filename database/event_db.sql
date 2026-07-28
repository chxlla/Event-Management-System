CREATE DATABASE event_db;
USE event_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    user_type ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200),
    description TEXT,
    event_date DATE,
    location VARCHAR(100),
    created_by INT
);

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_id INT
);

-- Default admin account for first login.
-- Email: admin@example.com  Password: admin123
-- IMPORTANT: change this password immediately after your first login.
INSERT INTO users (username, email, password, user_type)
VALUES ('admin', 'admin@example.com', '$2y$10$TA4kmOmfBg3qwn3AAq17i.fifbGLFRghInu/oOX6/HrsY/LuvWKkK', 'admin');
