<?php

use controller\CvContentController;
use controller\CvController;
use controller\EducationController;
use controller\InterestController;
use controller\LanguageController;
use controller\ProfessionalExperienceController;
use controller\SkillController;
use controller\LicenseLinkTableController;
use controller\ColorController;

if (!isset($_SESSION['cvContent_id'])) {
    die("Validez vos informations pour prévisualiser votre CV.");
}

require_once __DIR__ . '/../controller/CvController.php';
require_once __DIR__ . '/../controller/ColorController.php';
require_once __DIR__ . '/../Logger.php';
$logger = new Logger();
$colorController = new ColorController();
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

if (isset($_SESSION['color_id'])) {
    try {
        $color = $colorController->getColorById($_SESSION['color_id'])[0];
    } catch (Exception $e) {
        $logger->log("Error while getting color: " . $e->getMessage());
        die("Error while getting color: " . $e->getMessage());
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
    <style id="colors">
        <?php
        if (isset($_SESSION['color_id'])):
            echo '
                :root {
                    --color-1: ' . $color['color1'] . ';
                    --color-2: ' . $color['color2'] . ';
                    --color-3: ' . $color['color3'] . ';
                    --color-4: ' . $color['color4'] . ';
                }
                ';
        endif;
        ?>
    </style>
    <style>
        <?php

         echo file_get_contents(__DIR__ . '/css/style.css');
         if (isset($_SESSION['css_file'])):
             echo file_get_contents(__DIR__ . '/templates/' . $_SESSION['css_file']);
         endif;
        ?>
    </style>
</head>

<div id="cv-body" style="height: 100%; width: 100%; word-break: break-word;">
    <section id="informations">
        <?php
        // im doing some serious hacking stuff here
        $imagePath = __DIR__ . '/../../uploads/' . $cvContent['profile_pic'];
        $imageData = file_get_contents($imagePath);
        $base64 = base64_encode($imageData);
        $dataUrl = 'data:image/png;base64,' . $base64;
        echo '<img src="' . $dataUrl . '" alt="Profile picture" style="max-height: 200px; max-width: 175px;">';
        ?>

        <p>Email: <?php echo htmlspecialchars($cvContent['email'] ?? ''); ?></p>
        <p>Address: <?php echo htmlspecialchars($cvContent['address'] ?? ''); ?></p>
        <p>Phone: <?php echo htmlspecialchars($cvContent['phone'] ?? ''); ?></p>

    </section>

    <section id="content">
        <h2 class="name"><?php echo htmlspecialchars(($cvContent['first_name'] ?? '') . ' ' . ($cvContent['last_name'] ?? '')); ?></h2>

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
                <div class="section">
                    <h2><?php echo $sectionName; ?></h2>
                    <div class="section-element">
                        <?php foreach ($sectionData as $item): ?>
                            <div class="section-element-content">
                                <h3 class="<?php echo strtolower(str_replace(' ', '', $sectionName)); ?> Title"><?php echo htmlspecialchars($item['title'] ?? ''); ?></h3>
                                <p class="<?php echo strtolower(str_replace(' ', '', $sectionName)); ?> Description"><?php echo htmlspecialchars($item['description'] ?? ''); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif;
        endforeach; ?>
    </section>

</div>
</html>