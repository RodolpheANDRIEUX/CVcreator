<?php
session_start();

use controller\ProfessionalExperienceController;
use controller\UserController;
use controller\CvController;
use controller\CvContentController;
use controller\EducationController;
use controller\SkillController;
use controller\LanguageController;
use controller\LicenseLinkTableController;
use controller\InterestController;

require_once __DIR__ . '/controller/UserController.php';
require_once __DIR__ . '/controller/CvController.php';
require_once __DIR__ . '/controller/CvContentController.php';
require_once __DIR__ . '/controller/ProfessionalExperienceController.php';
require_once __DIR__ . '/controller/EducationController.php';
require_once __DIR__ . '/controller/SkillController.php';
require_once __DIR__ . '/controller/LanguageController.php';
require_once __DIR__ . '/controller/LicenseLinkTableController.php';
require_once __DIR__ . '/controller/InterestController.php';
require_once __DIR__ . '/Logger.php';

$logger = new Logger();
$userController = new UserController();
$cvController = new CvController();
$cvContentController = new CvContentController();
$ProfessionalExperienceController = new ProfessionalExperienceController();
$educationController = new EducationController();
$skillController = new SkillController();
$languageController = new LanguageController();
$licenseController = new LicenseLinkTableController();
$interestController = new InterestController();

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

    case 'submit_step2':
        if (isset($_SESSION['user'])) {
            if (submitStep2()) {
                redirect('creation&step=3');
                exit();
            }
            redirect('creation&step=2');
        } else {
            $_SESSION['error'] = "How did you get here? anyway, you need to login first!";
            redirect('login');
        }
        break;

    case 'submit_step3':
        if (isset($_SESSION['user'])) {
            if (submitStep3()) {
                redirect('creation&step=4');
                exit();
            }
            redirect('creation&step=3');
        } else {
            $_SESSION['error'] = "How did you get here? anyway, you need to login first!";
            redirect('login');
        }
        break;

    case 'open':
        if (isset($_SESSION['user'])) {
            $_SESSION['cv_id'] = $_GET['id'];
            redirect('creation&step=' . getStep($_SESSION['cv_id']));
            exit();
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
                redirect('home');
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                redirect('login');
                exit();
            }
        }
        break;

    case 'logout':
        session_destroy();
        redirect('home');
        exit();

    case 'share':
        $_SESSION['cv_id'] = $_GET['id'];
        $logger->log("accessing CV " . $_SESSION['cv_id']);
        try {
            $_SESSION['cvContent_id'] = $cvContentController->getCvContentByCvId($_SESSION['cv_id'])[0]['id'];
        } catch (Exception $e) {
            $logger->log("Error: " . $e->getMessage());
        }
        redirect('share');
        break;

    default:
        $logger->log( ($_SESSION['username'] ?? 'Guest') . " called action $action with no effect /!\/!\/!\\");
        break;
}

function redirect($page) {
    header("Location: index.php?page=$page");
    exit();
}

function getStep($cv_id): int
{
    global $cvContentController, $logger, $cvController;

    try {
        $content = $cvContentController->getCvContentByCvId($cv_id);
    } catch (Exception $e) {
        $logger->log("Error: " . $e->getMessage());
    }
    if (!isset($content)) {return 2;}
    $_SESSION['cvContent_id'] = $content[0]['id'];

    try {
        $css = $cvController->GetCvById($cv_id)[0]['css_file'];
    } catch (Exception $e) {
        $logger->log("Error: " . $e->getMessage());
    }
    if (!isset($css)) {return 3;}
    $_SESSION['css_file'] = $css;

    try {
        $color = $cvController->GetCvById($cv_id)[0]['color_id'];
    } catch (Exception $e) {
        $logger->log("Error: " . $e->getMessage());
    }
    if (!isset($color)) {return 4;}
    $_SESSION['color_id'] = $color;

    return 1;
}

function addCv() {
    global $cvController, $logger;
    try {
        $_SESSION['cv_id'] = $cvController->addCv('Cv created ' . date('d/m/y'), $_SESSION['user']['id']);
        $_SESSION['cvContent_id'] = null;
        $_SESSION['css_file'] = null;
        $_SESSION['color_id'] = null;
    } catch (Exception $e) {
        $logger->log("Error: " . $e->getMessage());
        $_SESSION['error'] = "Erreur lors de la création du CV : " . $e->getMessage();
        redirect('error');
        exit();
    }
    $logger->log("New CV created");
}

function submitStep1(): bool {
    global $cvContentController, $logger, $ProfessionalExperienceController, $educationController, $skillController, $languageController, $interestController, $licenseController;

    $profilePicPath = '';
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['size'] > 0){
        $profilePicPath = save_file($_FILES['profilePic']);
        if (!$profilePicPath) {
            return false;
        }
        $logger->log("Profile picture saved");
    }

    try {
        if ($cvContentController->getCvContentByCvId($_SESSION['cv_id'])) {
            $logger->log("cv content already exists, updating...");
            $_SESSION['cvContent_id'] = $cvContentController->getCvContentByCvId($_SESSION['cv_id'])[0]['id'];
            updateContent($profilePicPath);
        } else {
            $logger->log("cv content doesn't exist, creating...");
            addContent($profilePicPath);
        }
    } catch (Exception $e) {
        $logger->log("Error while creating or updating cv content : " . $e->getMessage());
        $_SESSION['error'] =  $e->getMessage();
        return false;
    }

    $logger->log($_SESSION['cvContent_id']);

    if (isset($_POST['experienceTitle'])) {
        $experienceTitles = $_POST['experienceTitle'];
        $experienceDescriptions = $_POST['experienceDescription'];

        for ($i = 0; $i < count($experienceTitles); $i++) {
            $title = $experienceTitles[$i];
            if ($title == '') {
                continue;
            }
            $description = $experienceDescriptions[$i];
            try {
                $logger->log("Adding professional experience: $title");
                $logger->log("description: $description");
                $logger->log("content id: " . $_SESSION['cvContent_id']);
                $ProfessionalExperienceController->addProfessionalExperience($title, $description, $_SESSION['cvContent_id']);
            } catch (Exception $e) {
                $logger->log("Error: " . $e->getMessage());
                $_SESSION['error'] =  $e->getMessage();
                return false;
            }
        }
    }

    if (isset($_POST['educationTitle'])) {
        $educationTitles = $_POST['educationTitle'];
        $educationDescriptions = $_POST['educationDescription'];

        for ($i = 0; $i < count($educationTitles); $i++) {
            $title = $educationTitles[$i];
            if ($title == '') {
                continue;
            }
            $description = $educationDescriptions[$i];

            try {
                $educationController->addEducation($title, $description, $_SESSION['cvContent_id']);
            } catch (Exception $e) {
                $logger->log("Error: " . $e->getMessage());
                $_SESSION['error'] =  $e->getMessage();
                return false;
            }
        }
    }

    if (isset($_POST['skillTitle'])) {
        $skills = $_POST['skillTitle'];
        $skillDescription = $_POST['skillDescription'];

        for ($i = 0; $i < count($skills); $i++) {
            $title = $skills[$i];
            if ($title == '') {
                continue;
            }
            $description = $skillDescription[$i];

            try {
                $skillController->addSkill($title, $description, $_SESSION['cvContent_id']);
            } catch (Exception $e) {
                $logger->log("Error: " . $e->getMessage());
                $_SESSION['error'] =  $e->getMessage();
                return false;
            }
        }
    }

    if (isset($_POST['language'])) {
        $languageNames = $_POST['language'];
        $languageLevels = $_POST['languageLevel'];

        for ($i = 0; $i < count($languageNames); $i++) {
            $name = $languageNames[$i];
            if ($name == '') {
                continue;
            }
            $level = $languageLevels[$i];

            try {
                $languageController->addLanguage($name, $level, $_SESSION['cvContent_id']);
            } catch (Exception $e) {
                $logger->log("Error: " . $e->getMessage());
                $_SESSION['error'] =  $e->getMessage();
                return false;
            }
        }
    }

    if (isset($_POST['interestTitle'])) {
        $interestTitles = $_POST['interestTitle'];
        $interestDescriptions = $_POST['interestDescription'];

        for ($i = 0; $i < count($interestTitles); $i++) {
            $title = $interestTitles[$i];
            if ($title == '') {
                continue;
            }
            $description = $interestDescriptions[$i];

            try {
                $interestController->addInterest($title, $description, $_SESSION['cvContent_id']);
            } catch (Exception $e) {
                $logger->log("Error: " . $e->getMessage());
                $_SESSION['error'] =  $e->getMessage();
                return false;
            }
        }
    }

    if (isset($_POST['license'])) {
        $licenseIds = $_POST['license'];

        for ($i = 0; $i < count($licenseIds); $i++) {
            $licenseId = $licenseIds[$i];
            if ($licenseId == '') {
                continue;
            }

            try {
                $licenseController->addLicenseLink($_SESSION['cvContent_id'], $licenseId);
            } catch (Exception $e) {
                $logger->log("Error: " . $e->getMessage());
                $_SESSION['error'] =  $e->getMessage();
                return false;
            }
        }
    }

    $logger->log("Step 1 submitted successfully.");
    return true;
}

function submitStep2(): bool
{
    global $cvController, $logger;

    if (isset($_POST['css_option'])) {
        $css_file = $_POST['css_option'];
        try {
            $cv = $cvController->GetCvById($_SESSION['cv_id'])[0];
            $cvController->updateCv($cv['title'], $_SESSION['cv_id'] , '', $css_file);
            $_SESSION['css_file'] = $css_file;
        } catch (Exception $e) {
            $logger->log("Error: " . $e->getMessage());
            $_SESSION['error'] =  $e->getMessage();
            return false;
        }
    }

    $logger->log("Step 2 submitted successfully.");
    return true;
}

function submitStep3(): bool
{
    global $cvController, $logger;

    if (isset($_POST['color'])) {
        $color = $_POST['color'];
        try {
            $cv = $cvController->GetCvById($_SESSION['cv_id'])[0];
            $cvController->updateCv($cv['title'], $_SESSION['cv_id'], '', $_SESSION['css_file'], $color);
            $_SESSION['color_id'] = $color;
            $logger->log("Color set to : $color");
        } catch (Exception $e) {
            $logger->log("Error: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
        $logger->log("Step 3 submitted successfully.");
        return true;
    }

    $_SESSION['error'] = "No color selected.";
    return false;
}

/**
 * @throws Exception
 */
function addContent($profilePicPath = null) {
    global $cvContentController, $logger;
    $_SESSION['cvContent_id'] = $cvContentController->addCvContent(
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email'],
        $_SESSION['cv_id'],
        $_POST['birthDate'],
        $profilePicPath,
        $_POST['address'],
        $_POST['phone']
    );
    $logger->log("CV content created. Id = " . $_SESSION['cvContent_id']);
}

/**
 * @throws Exception
 */
function updateContent($profilePicPath = null) {
    global $cvContentController, $logger;

    $cvContentController->updateCvContent(
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email'],
        $_SESSION['cv_id'],
        $_POST['birthDate'],
        $profilePicPath,
        $_POST['address'],
        $_POST['phone']
    );
    $logger->log("CV content updated.");
}

function save_file($file): string {
    global $logger;

    if ($file['size'] > 9000000) {
        $_SESSION['error'] = "File is too large.";
        return '';
    }

    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        return '';
    }

    $uploadFile = basename($file['name']);

    $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/CVcreator/uploads/';

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $targetFile = $targetDirectory . $uploadFile;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $logger->log("File has been uploaded successfully.");
    } else {
        $_SESSION['error'] = "Failed to upload file.";
        return '';
    }

    return $uploadFile;
}