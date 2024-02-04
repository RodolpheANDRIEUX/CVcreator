<?php

use controller\UserController;

session_start();
require_once __DIR__ . '/controller/UserController.php';
require_once __DIR__ . '/logger.php';

$userController = new UserController();
$logger = new Logger();

$page = $_GET['page'] ?? ' ';
$logger->log( ($_SESSION['username'] ?? 'Guest') . " accessed page $page");

try {
    switch ($page) {
        case 'home':
            include 'view/home_page.php';
            break;
        case 'login':
            include 'view/login_page.php';
            break;
        case 'creation':
            if (!isset($_SESSION['username'])) {
                header("Location: index.php?page=login");
                exit();
            }
            include 'view/creation_page.php';
            break;
        case 'error':
            include 'view/error_page.php';
            break;
        default:
            include 'view/404_page.php';
            break;
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: index.php?page=$page");
}