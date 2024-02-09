<head>
    <?php
    include 'view/head.php';

    if (isset($_POST['css_option'])) {
        $_SESSION['css_file'] = $_POST['css_option'];
    }
    ?>
    <link rel="stylesheet" type="text/css" href="view/css/step2.css">
</head>

<div class="progress-bar-container">
    <h2>Étape 2 : Sélectionnez un modèle</h2>
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

<form action="action.php?action=submit_step2" method="POST">
    <div class="grid-container">
        <label class="card" for="option1">
            <input type="radio" id="option1" name="css_option" value="" checked>
            <div class="card-content">old school HTML</div>
        </label>
        <label class="card" for="option2">
            <input type="radio" id="option2" name="css_option" value="style1.css">
            <div class="card-content">Minimaliste Épuré</div>
        </label>
        <label class="card" for="option3">
            <input type="radio" id="option3" name="css_option" value="style2.css">
            <div class="card-content">Innovant Moderne</div>
        </label>
        <label class="card" for="option4">
            <input type="radio" id="option4" name="css_option" value="style3.css">
            <div class="card-content">Classique Professionnel</div>
        </label>
        <label class="card" for="option5">
            <input type="radio" id="option5" name="css_option" value="style4.css">
            <div class="card-content">Dynamique Infographique</div>
        </label>
        <label class="card" for="option6">
            <input type="radio" id="option6" name="css_option" value="style5.css">
            <div class="card-content">Élégant Créatif</div>
        </label>
    </div>

    <button type="submit" class="btn-next">Suivant</button>
</form>

<script>

    document.querySelectorAll('input[type=radio][name=css_option]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const linkElement = document.getElementById('preview-css-link');
            console.log(linkElement);
            linkElement.href = 'view/templates/' + this.value;
            console.log(linkElement.href);
        });
    });

</script>