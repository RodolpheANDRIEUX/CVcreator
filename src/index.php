<?php
session_start();
require_once 'controller/UserController.php';
$userController = new UserController();

$page = isset($_GET['page']) ? $_GET['page'] : ' ';

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
        default:
            include 'view/404_page.php';
            break;
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: index.php?page=$page");
}