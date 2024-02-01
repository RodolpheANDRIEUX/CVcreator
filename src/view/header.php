<!DOCTYPE html>
<html>
<head>
    <title>CVcreator</title>
    <link rel="icon" type="image/x-icon" href="view/assets/CV.png">
    <link rel="stylesheet" type="text/css" href="view/css/style.css">
    <link rel="stylesheet" type="text/css" href="view/css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
</head>

<div class="header">
    <div class="logo">
        <a href="?page=home"><img src="view/assets/logo.svg"></a>
    </div>
    <div class="nav-bar">
        <ul>
            <li><a href="?page=templates">Modèles</a></li>
            <li><a href="?page=premium">Premium</a></li>
            <li><a href="https://github.com/RodolpheANDRIEUX">Suivez-nous</a></li>
            <li><a href="?page=register">A propos</a></li>
        </ul>
    </div>
    <div>
        <?php if(isset($_SESSION['username'])): ?>
            <?php echo $_SESSION['username']; ?>
            <button type="submit" class="connexion-btn"><a href="action.php?action=logout">Déconnexion</a></button>
        <?php else: ?>
            <button type="submit" class="connexion-btn"><a href="?page=login">Connexion</a></button>
        <?php endif; ?>
    </div>
</div>