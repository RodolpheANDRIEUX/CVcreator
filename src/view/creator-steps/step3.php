<head>
    <?php include 'view/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="view/css/step3.css">
</head>

<div class="progress-bar-container">
    <h2>Étape 3 : Choisissez vos couleurs</h2>
    <div class="progress-bar">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="error">
        <?= $_SESSION['error'] ?>
    </div>
    <?php unset($_SESSION['error']) ?>
<?php endif ?>
