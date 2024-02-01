<?php
session_start();

require_once __DIR__ . '/controller/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'default';

$userController = new UserController();

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userController->loginUser($_POST['username'], $_POST['password']);
                header("Location: index.php?page=home");
                exit();
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: index.php?page=login");
                exit();
            }
        }
        break;
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userController->addUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password2']);
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: index.php?page=login");
                exit();
            }
        }
        break;
    case 'logout':
        session_destroy();
        header("Location: index.php");
        exit();
    default:
        // quelle est censé etre l'action par défaut
        break;
}