<?php
session_start();

use controller\UserController;
use controller\CvController;
use controller\CvContentController;

require_once __DIR__ . '/controller/UserController.php';
require_once __DIR__ . '/controller/CvController.php';
require_once __DIR__ . '/controller/CvContentController.php';
require_once __DIR__ . '/logger.php';

$logger = new Logger();
$userController = new UserController();
$cvController = new CvController();
$cvContentController = new CvContentController();

$action = $_GET['action'] ?? 'default';
$logger->log( ($_SESSION['username'] ?? 'Guest') . " called action $action");

switch ($action) {

    case 'new_cv':
        if (isset($_SESSION['user'])) {
            addCv();
            redirect('creation&step=1');
            exit();
        }
        $_SESSION['error'] = "Connectez-vous pour créer un CV!";
        redirect('login');
        break;

    case 'submit_step1':
        if (isset($_SESSION['user'])) {
            if (submitStep1()) {
                redirect('creation&step=2');
                exit();
            }
            redirect('creation&step=1');
        } else {
            $_SESSION['error'] = "How did you get here? anyway, you need to login first!";
            redirect('login');
        }
        break;

    case 'login':
        try {
            $userController->loginUser($_POST['username'], $_POST['password']);
            redirect('home');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            redirect('login');
            exit();
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userController->addUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password2']);
                $userController->loginUser($_POST['username'], $_POST['password']);
                header("Location: index.php?page=home");
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
        $logger->log( ($_SESSION['username'] ?? 'Guest') . " called action $action with no effect /!\ ");
        break;
}

function redirect($page) {
    header("Location: index.php?page=$page");
    exit();
}

function addCv() {
    global $cvController, $logger;
    try {
        $cvController->addCv('Cv created ' . date('d/m/y'), $_SESSION['user']['id']);
    } catch (Exception $e) {
        $logger->log("Error: " . $e->getMessage());
        $_SESSION['error'] = "Erreur lors de la création du CV : " . $e->getMessage();
        redirect('error');
        exit();
    }
    $logger->log("New CV created");
    try {
        $_SESSION['cv_id'] = $cvController->getCvByUserId($_SESSION['user']['id'])[0]['id'];
    } catch (Exception $e) {
        $logger->log("Error: " . $e->getMessage());
        $_SESSION['error'] = "Erreur lors de la récupération du CV : " . $e->getMessage();
        redirect('error');
        exit();
    }
    $logger->log("Cv id: " . $_SESSION['cv_id']);
}

function submitStep1(): bool {
    global $cvContentController, $logger;
    try {
        $logger->log($_POST['birthDate']);
        $cvContentController->addCvContent(
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['email'],
            $_SESSION['cv_id'],
            //$_POST['birthDate'],
            $_POST['profilePic'],
            $_POST['address'],
            $_POST['phone']
        );
    } catch (Exception $e) {
        $logger->log("Error: " . $e->getMessage());
        $_SESSION['error'] = "Erreur lors de la création du CV : " . $e->getMessage();
        redirect('error');
        exit();
    }

    if (isset($_FILES['profilePic'])){
        if (save_file($_FILES['profilePic'])) {
            $logger->log("Profile picture saved");
        } else {
            $_SESSION['error'] = "Failed to save profile picture.";
            return false;
        }
    }

    if (isset($_POST['experienceTitle'])) {
        $experienceTitles = $_POST['experienceTitle'];
        $experienceDescriptions = $_POST['experienceDescription'];

        for ($i = 0; $i < count($experienceTitles); $i++) {
            $title = $experienceTitles[$i];
            $description = $experienceDescriptions[$i];


            // TODO: save experiences
        }
    }

    // TODO: faire les autres champs comme skills, education, etc.

    $logger->log("Step 1 submitted successfully.");
    return true;
}

function save_file($file): bool
{
    global $logger;

    if ($file['size'] > 500000) {
        $_SESSION['error'] = "File is too large.";
        return false;
    }

    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        return false;
    }

    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    $uploadFile = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        $logger->log("File has been uploaded successfully.");
    } else {
        $_SESSION['error'] = "Failed to upload file.";
        return false;
    }

    return true;
}