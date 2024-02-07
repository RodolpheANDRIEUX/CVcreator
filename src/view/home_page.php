<!DOCTYPE html>
<html>
<head>
    <?php include 'view/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="view/css/home.css">
</head>

<body>
<div id="loading-layer"></div>
<div id="backgroundImg"></div>
<?php include 'view/header.php'; ?>
<img src="view/assets/dummy-cv.svg" class="dummy-cv" alt="Exemples de cv">
<div class="women-cv-container">
    <img src="view/assets/women-cv.png" class="women-cv" alt="Exemple de cv">
    <img src="view/assets/women-cv.png" class="women-cv-mask" alt="Exemple de cv">
</div>

<div class="title-container">
    <h2>Valorisez votre profil professionnel</h2>
    <p>Choisissez parmi une gamme de modèles prédéfinis<br/> pour créer le CV parfait !</p>
    <button type="submit" class="start-btn"><a href="action.php?action=new_cv">Commencer</a><img src="view/assets/little-arrow.svg"></button>
</div>
<?php if(!isset($_SESSION['username'])): ?>
    <img src="view/assets/connectez-vous.svg" class="arrow" alt="connectez-vous !">
<?php endif; ?>

<section class="container1">
    <p>Renseignez vos informations</p>
    <div class="line"></div>
    <p>Choisissez un modèle de CV</p>
    <div class="line"></div>
    <p>Télechargez votre nouveaux CV</p>
</section>

<section class="container2">
    <h2>Modèle conceptuel des données ( MCD )</h2>
    <div class="mcd">
        <img src="view/assets/MCD.svg" alt="MCD">
    </div>
</section>
</body>
</html>

<script>
    window.onload = function() {
        const loadingLayer = document.getElementById('loading-layer');
        loadingLayer.classList.add('fade-out');
        loadingLayer.addEventListener('animationend', function() {
            loadingLayer.style.display = 'none';
        });
    }
</script>