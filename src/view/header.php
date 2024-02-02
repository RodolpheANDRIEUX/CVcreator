<!DOCTYPE html>
<html>
<head>
    <?php include 'view/head.php'; ?></head>
</head>

<div class="header">
    <div class="logo">
        <a href="?page=home"><img src="view/assets/logo.svg"></a>
    </div>
    <div class="nav-bar">
        <ul>
            <li><a href="?page=templates">Modèles</a></li>
            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="?page=profile">Mes CV</a></li>
            <?php endif; ?>
            <li><a href="?page=premium">Premium</a></li>
            <li><a href="https://github.com/RodolpheANDRIEUX">Suivez-nous</a></li>
            <li><a href="https://github.com/RodolpheANDRIEUX/CVcreator/commit/main">A propos</a></li>
        </ul>
    </div>
    <div>
        <?php if(isset($_SESSION['username'])): ?>
            <button type="submit" class="profile-btn"><a href="action.php?action=logout"><?php echo $_SESSION['username']; ?></a></button>
        <?php else: ?>
            <button type="submit" class="connexion-btn"><a href="?page=login">Connexion</a></button>
        <?php endif; ?>
    </div>
</div>
</html>