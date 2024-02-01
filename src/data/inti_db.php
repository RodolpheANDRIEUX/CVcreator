<?php

$host = 'localhost';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);

    $sql = file_get_contents('src/data/init_db.sql');
    $pdo->exec($sql);

    echo "Database and tables created successfully.";
} catch (PDOException $e) {
    die($e->getMessage());
}