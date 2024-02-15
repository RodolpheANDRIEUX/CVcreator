<head>
    <?php use controller\ColorController;

    include 'view/head.php';

    require_once __DIR__ . '/../../controller/ColorController.php';
    $colorController = new ColorController();
    $colors = $colorController->getAllColors();
    ?>

    <link rel="stylesheet" type="text/css" href="view/creator-steps/step3.css">
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

<section id="step3">
    <form action="action.php?action=submit_step3" method="POST">
        <div class="grid-container">

            <?php
            foreach ($colors as $color) {
                $thumbnail = $color['thumbnail'];
                echo
                    '<label class="card" for="option' . $color['id'] . '">
                    <input type="radio" id="option' . $color['id'] . '" name="color" value="'. $color['id'] .'">
                    <div class="card-title" style="background-color: ' . $color['color1'] . '; color: '. $color['color4'] .'">' . $color['name'] . '</div>
                    <div class="card-picture" style="background: url(\'' . $thumbnail . '\') center no-repeat; background-size: cover"></div>
                    <div class="card-colors">
                        <div class="color1" style="background-color: ' . $color['color1'] . '"></div>
                        <div class="color2" style="background-color: ' . $color['color2'] . '"></div>
                        <div class="color3" style="background-color: ' . $color['color3'] . '"></div>
                        <div class="color4" style="background-color: ' . $color['color4'] . '"></div>
                    </div>
                    <img src="view/assets/checked.svg" class="checked" alt="Selectioné">
                </label>';
            } ?>

        </div>

        <button type="submit" class="btn-next">Suivant</button>
    </form>
</section>
