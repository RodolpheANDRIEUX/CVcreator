<?php

use controller\CvContentController;
use controller\CvController;
use controller\EducationController;
use controller\InterestController;
use controller\LanguageController;
use controller\ProfessionalExperienceController;
use controller\SkillController;
use controller\LicenseLinkTableController;

if (!isset($_SESSION['cvContent_id'])) {
    die("CV ID is not set in the session.");
}

require_once __DIR__ . '/../controller/CvController.php';
require_once __DIR__ . '/../Logger.php';
$logger = new Logger();

$cvController = new CvController();
$controllers = [
    'cvContent' => CvContentController::class,
    'educations' => EducationController::class,
    'interests' => InterestController::class,
    'languages' => LanguageController::class,
    'professionalExperiences' => ProfessionalExperienceController::class,
    'skills' => SkillController::class,
    'licenseLinkTable' => LicenseLinkTableController::class,
];

if (isset($_SESSION['cv_id'])) {
    try {
        $cv = $cvController->getCvById($_SESSION['cv_id'])[0];
    } catch (Exception $e) {
        $logger->log("Error while getting cv: " . $e->getMessage());
        die("Error while getting cv: " . $e->getMessage());
    }
}

$data = [];
$sections = [];

if (isset($_SESSION['cvContent_id'])) {
    foreach ($controllers as $key => $controllerClass) {
        require_once __DIR__ . "/../{$controllerClass}.php";
        $controller = new $controllerClass();

        try {
            $data[$key] = $controller->GetByContentId($_SESSION['cvContent_id']);
        } catch (Exception $e) {
            $logger->log("Error while getting {$key}: " . $e->getMessage());
        }
    }
}

extract($data);
$cvContent = $cvContent[0];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        <?php
         echo file_get_contents(__DIR__ . '/css/style.css');
         if (isset($_SESSION['css_file'])):
             echo file_get_contents(__DIR__ . '/templates/' . $_SESSION['css_file']);
         endif;
        ?>
    </style>
</head>

<div id="cv-body">
    <h2><?php echo htmlspecialchars(($cvContent['first_name'] ?? '') . ' ' . ($cvContent['last_name'] ?? '')); ?></h2>
    <h1><?php echo htmlspecialchars($cv['title'] ?? ''); ?></h1>

    <?php if ($cvContent['profile_pic'] != null): ?>
        <img src="<?php echo '../uploads/' . $cvContent['profile_pic']; ?>" alt="Profile picture">
    <?php endif; ?>

    <p>Email: <?php echo htmlspecialchars($cvContent['email'] ?? ''); ?></p>
    <p>Address: <?php echo htmlspecialchars($cvContent['address'] ?? ''); ?></p>
    <p>Phone: <?php echo htmlspecialchars($cvContent['phone'] ?? ''); ?></p>

    <?php
    $sections = [];

    if (isset($professionalExperiences)) {
        $sections['Experiences'] = $professionalExperiences;
    }

    if (isset($skills)) {
        $sections['Competences'] = $skills;
    }

    if (isset($languages)) {
        $sections['Langues'] = $languages;
    }

    if (isset($educations)) {
        $sections['Formations'] = $educations;
    }

    if (isset($interests)) {
        $sections['Interets'] = $interests;
    }

    if (isset($licenseLinkTable)) {
        $sections['Permis'] = $licenseLinkTable;
    }

    foreach ($sections as $sectionName => $sectionData):
        if ($sectionData != null): ?>
            <h2><?php echo $sectionName; ?></h2>
            <ul>
                <?php foreach ($sectionData as $item): ?>
                    <li>
                        <h3 class="<?php echo strtolower(str_replace(' ', '', $sectionName)); ?> Title"><?php echo htmlspecialchars($item['title'] ?? ''); ?></h3>
                        <p class="<?php echo strtolower(str_replace(' ', '', $sectionName)); ?> Description"><?php echo htmlspecialchars($item['description'] ?? ''); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif;
    endforeach; ?>
</div>
</html>