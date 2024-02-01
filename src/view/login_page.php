<!DOCTYPE html>
<html>
<head>
    <title>CVcreator</title>
    <link rel="icon" type="image/x-icon" href="view/assets/CV.png">
    <link rel="stylesheet" type="text/css" href="view/css/style.css">
    <link rel="stylesheet" type="text/css" href="view/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'view/header.php'; ?>

<div class="container">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="forms-container">
        <div class="login-container">
            <span>Connexion</span>
            <form action="action.php?action=login" method="POST">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required minlength="8">
                <button type="submit">Se connecter</button>
            </form>
        </div>

        <div class="separator"></div>

        <div class="login-container">
            <span>Inscription</span>
            <form action="action.php?action=register" method="POST">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="email" name="email" placeholder="Adresse email" required>
                <input type="password" name="password" placeholder="Mot de passe" required minlength="8">
                <input type="password" name="password2" placeholder="Confirmer le mot de passe" required minlength="8">
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </div>

</div>