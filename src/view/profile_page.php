<!DOCTYPE html>
<html>
<head>
    <?php

    if (!isset($_SESSION['user'])) {
        header('Location: login_page.php');
    }

    use controller\CvController;

    include 'view/head.php';

    require_once __DIR__ . '/../controller/CvController.php';

    $cvController = new CvController();

    $user = $_SESSION['user'];
    ?>

<link rel="stylesheet" type="text/css" href="view/css/profile.css">
</head>

<body>
<?php include 'view/header.php'; ?>
<div id="backgroundImg"></div>
<div id="backgroundImg2">
    <div class="content">
        <div class="container">
            <div class="profile-container">
                <h1>Username :<span> <?= $user['username'] ?></span></h1>
                <p>Email : <span><?= $user['email']; ?></span></p>
                <button type="submit" class="disconnect-btn"><a href="action.php?action=logout">Se déconnecter</a></button>
            </div>
            <div class="cvs-container">
                <h1>Vos CVs</h1>
                <section class="cvs-grid">
                    <?php
                    try {
                        $cvs = $cvController->getCvByUserId($user['id']);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    if (empty($cvs)) {
                        echo '<p>Vous n\'avez pas encore de CV !</p>';
                    } else {
                        foreach ($cvs as $cv) {
                            echo '<a href="action.php?action=open&id=' . $cv['id'] . '">';
                            echo '<div class="cv-card">';
                            echo '<h2>' . $cv['title'] . '</h2>';
                            echo '</div>';
                            echo '</a>';
                        }
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>
</div>
</body>
</html>