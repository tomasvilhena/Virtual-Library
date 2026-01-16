CREATE DATABASE IF NOT EXISTS students_db;
USE students_db;

CREATE TABLE IF NOT EXISTS students 
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    final_grade INT NOT NULL
);
