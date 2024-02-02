<!DOCTYPE html>
<html>
<head>
    <?php include 'view/head.php'; ?></head>
    <link rel="stylesheet" type="text/css" href="view/css/creation.css">
</head>
<body>
<?php include 'view/header.php'; ?>

<div class="container">
    <div id="header-line"></div>
    <div id="backgroundImg"></div>
    <section class="forms-container">
        <?php
        if (isset($_GET['step'])) {
            $step = filter_var($_GET['step'], FILTER_VALIDATE_INT);
            if ($step !== false) {
                include 'view/creator-steps/step' . $step . '.php';
            } else {
                echo "Erreur : le paramètre 'step' doit être un nombre entier.";
            }
        } else {
            echo "Erreur : le paramètre 'step' est manquant dans l'URL.";
        }
        ?>
    </section>

    <section class="preview-container">
        <div class="cv-container">
            <?php include 'view/cv.php'; ?>
        </div>
    </section>

</div>

</body>
</html>