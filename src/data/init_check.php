<?php

require_once __DIR__ . '/../Logger.php';
$logger = new Logger();

require_once 'db_config.php';

$logger->log('Checking if the database exists...');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $stmt = $pdo->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
    if (!$stmt->fetch()) {
        $logger->log('It does not! Let\'s create it.');
        require_once 'init_db.php';
    } else {
        $logger->log('Well it does!');
    }
} catch (PDOException $e) {
    $logger->log('Error checking if the database exists: ' . $e->getMessage());
    die($e->getMessage());
}