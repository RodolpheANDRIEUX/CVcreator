<!DOCTYPE html>
<html>
<head>
    <?php include 'view/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="view/css/404.css"> <!-- Not my proudest hack -->
</head>

<body>
<?php include 'view/header.php'; ?>

<div class="container">
    <span class="error">😬 Error :</span>
    <span class="error_message"><?php echo $_SESSION['error']; ?></span>
    <button type="submit" class="back-btn"><a href="?page=home">← home</a></button>
</div>

</body>
</html>