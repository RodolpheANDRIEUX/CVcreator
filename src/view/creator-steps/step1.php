<head>
    <?php

    use controller\LicenseController;

    include 'view/head.php';

    require_once __DIR__ . '/../../controller/LicenseController.php';
    $licenseController = new LicenseController();
    $licenses = $licenseController->getAllLicenses();
    ?>
    <link rel="stylesheet" type="text/css" href="view/creator-steps/step1.css">
</head>

<div class="progress-bar-container">
    <h2>Étape 1 : Renseignez vos informations</h2>
    <div class="progress-bar">
        <a href="?page=creation&step=1"></a>
        <a href="?page=creation&step=2"></a>
        <a href="?page=creation&step=3"></a>
        <a href="?page=creation&step=4"></a>
    </div>
</div>

<?php if (isset($_SESSION['error'])): ?>
    <div class="error">
        <?= $_SESSION['error'] ?>
    </div>
    <?php unset($_SESSION['error']) ?>
<?php endif ?>

<section id="step1">
    <form action="action.php?action=submit_step1" method="POST" enctype="multipart/form-data">

        <div class="coords">
            <input type="text" name="firstName" placeholder="*Prénom" required>
            <input type="text" name="lastName" placeholder="*Nom" required>
            <label for="profilePic" class="ProfilePic-label">
                <img id="profilePicPreview" src="view/assets/upload-img.svg" alt="Profile picture preview">
                <span id="profilePicName">Photo de profil</span>
            </label>
            <input type="file" id="profilePic" name="profilePic" placeholder="Photo de profil">
            <input type="date" name="birthDate" placeholder="Date de naissance">
            <input type="text" name="address" placeholder="Adresse">
            <input type="email" name="email" placeholder="*Adresse email" required>
            <input type="tel" name="phone" placeholder="Numéro de téléphone">

        </div>

        <h3>Expériences</h3>
        <section>
            <div id="experienceContainer"></div>
            <button type="button" class="add-btn" id="addExperience">Ajouter une expérience <img src="view/assets/add-btn.svg"></button>
        </section>

        <h3>Compétences</h3>
        <section>
            <div id="skillContainer"></div>
            <button type="button" class="add-btn" id="addSkill">Ajouter une compétence <img src="view/assets/add-btn.svg"></button>
        </section>

        <h3>Formations</h3>
        <section>
            <div id="educationContainer"></div>
            <button type="button" class="add-btn" id="addEducation">Ajouter une formation <img src="view/assets/add-btn.svg"></button>
        </section>

        <h3>Centres d'intérêts</h3>
        <section>
            <div id="interestContainer"></div>
            <button type="button" class="add-btn" id="addInterest">Ajouter un interet <img src="view/assets/add-btn.svg"></button>
        </section>

        <h3>Langues</h3>
        <section>
            <div id="languageContainer"></div>
            <button type="button" class="add-btn" id="addLanguage">Ajouter une langue <img src="view/assets/add-btn.svg"></button>
        </section>

        <template>
            <select id="permis" name="license[]">
                <option value="">Sélectionnez un permis</option>
                <?php foreach ($licenses as $license): ?>
                    <option value="<?= $license['id'] ?>"><?= $license['type'] . ' - ' . $license['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </template>

        <h3>Permis :</h3>
        <section>
            <div id="licenseContainer">
                <button type="button" class="add-btn" id="addLicense">Ajouter un permis <img src="view/assets/add-btn.svg"></button>
            </div>
        </section>

        <button type="submit" class="btn-next">Suivant</button>
    </form>
</section>

<script>
    <?php include 'view/creator-steps/step1.js'; ?>
</script>
