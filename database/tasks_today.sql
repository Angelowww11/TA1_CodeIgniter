CREATE DATABASE IF NOT EXISTS tasks_today
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tasks_today;

DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS users;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    task_date DATE NOT NULL,
    created_at DATETIME NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL
);

INSERT INTO tasks (title, status, task_date, created_at) VALUES
('Review today''s priorities', 'completed', CURDATE(), NOW()),
('Finish the dashboard views', 'in progress', CURDATE(), NOW()),
('Test the database filters', 'pending', CURDATE(), NOW()),
('Update the project documentation', 'pending', CURDATE(), NOW()),
('Create the database schema', 'completed', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW()),
('Set up CodeIgniter routing', 'completed', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW()),
('Prepare the GitHub submission', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Deploy and verify the live website', 'pending', DATE_ADD(CURDATE(), INTERVAL 2 DAY), NOW());

INSERT INTO users (username, full_name, email, created_at) VALUES
('angelowww11', 'Angelo Kacey N. Pineda', 'angelowww11@example.com', NOW());
