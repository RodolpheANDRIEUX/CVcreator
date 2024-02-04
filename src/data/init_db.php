<?php

require_once __DIR__ . '/../Logger.php';
$logger = new Logger();

require_once 'db_config.php';

try {
    $logger->log('Creating database and tables...');
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);

    $sql = file_get_contents(__DIR__ . '/init_db.sql');
    $pdo->exec($sql);

    $logger->log('Database and tables created successfully.');

    include __DIR__ . '/seed.php';
} catch (PDOException $e) {
    $logger->log('Error creating database and tables: ' . $e->getMessage());
    die($e->getMessage());
}