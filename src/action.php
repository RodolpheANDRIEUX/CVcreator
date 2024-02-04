<?php
session_start();

use controller\UserController;
require_once __DIR__ . '/controller/UserController.php';
require_once __DIR__ . '/logger.php';

$logger = new Logger();
$userController = new UserController();



$action = isset($_GET['action']) ? $_GET['action'] : 'default';
switch ($action) {
    case 'new_cv':
        if (isset($_SESSION['user'])) {

            header("Location: index.php?page=creation&step=1");
        } else {
            $_SESSION['error'] = "Vous devez être connecté pour créer un CV.";
            header("Location: index.php?page=login");
        }
        exit();
        break;
    case 'submit_step1':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userController->addStep1($_POST['username'], $_POST['email'], $_POST['phone_number'], $_POST['experience'], $_POST['formation'], $_POST['competences'], $_POST['langues'], $_POST['loisirs'], $_POST['reseaux'], $_POST['site']);
                header("Location: index.php?page=creation&step=2");
                exit();
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: index.php?page=creation&step=1");
                exit();
            }
        }
        break;
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
        header("Location: index.php?page=home");
        exit();
    default:
        // quelle est censé etre l'action par défaut
        break;
}