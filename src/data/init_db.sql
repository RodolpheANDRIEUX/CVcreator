CREATE DATABASE IF NOT EXISTS cv_creator_db;
USE cv_creator_db;

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS CV (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    thumbnail VARCHAR(255),
    template_path VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS Color (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    color1 VARCHAR(255),
    color2 VARCHAR(255),
    color3 VARCHAR(255),
    color4 VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS CV_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birth_date DATE,
    profile_pic VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255),
    cv_id INT,
    color_id INT,
    FOREIGN KEY (cv_id) REFERENCES CV(id),
    FOREIGN KEY (color_id) REFERENCES Color(id)
);

CREATE TABLE IF NOT EXISTS Interest (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    cv_content_id INT,
    FOREIGN KEY (cv_content_id) REFERENCES CV_content(id)
);

CREATE TABLE IF NOT EXISTS Professional_experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    cv_content_id INT,
    FOREIGN KEY (cv_content_id) REFERENCES CV_content(id)
);

CREATE TABLE IF NOT EXISTS Education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    cv_content_id INT,
    FOREIGN KEY (cv_content_id) REFERENCES CV_content(id)
);

CREATE TABLE IF NOT EXISTS Skill (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    cv_content_id INT,
    FOREIGN KEY (cv_content_id) REFERENCES CV_content(id)
);

CREATE TABLE IF NOT EXISTS License (
   id INT AUTO_INCREMENT PRIMARY KEY,
   type VARCHAR(255) NOT NULL,
   cv_content_id INT,
   FOREIGN KEY (cv_content_id) REFERENCES CV_content(id)
);

CREATE TABLE IF NOT EXISTS License_link (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cv_content_id INT,
    FOREIGN KEY (cv_content_id) REFERENCES CV_content(id),
    license_id INT,
    FOREIGN KEY (license_id) REFERENCES License(id)
);

CREATE TABLE IF NOT EXISTS Language (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    level VARCHAR(255) NOT NULL,
    cv_content_id INT,
    FOREIGN KEY (cv_content_id) REFERENCES CV_content(id)
);
