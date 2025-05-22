-- Database and table setup for Student Management System
CREATE DATABASE IF NOT EXISTS school;
USE school;

-- Users table for login
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Students table
CREATE TABLE IF NOT EXISTS student (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_no VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(255) NOT NULL,
  gender ENUM('Male','Female') NOT NULL,
  dob DATE NOT NULL,
  age INT NOT NULL,
  department VARCHAR(100) NOT NULL,
  address TEXT
);
