CREATE DATABASE todo;


CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255)
) DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE IF NOT EXISTS tasks(
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(255),
    task TEXT,
    status TINYINT DEFAULT '0'
) DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
