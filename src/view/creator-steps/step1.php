<head>
    <?php include 'view/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="view/css/step1.css">
</head>

<div class="progress-bar-container">
    <h2>Étape 1 : Renseignez vos informations</h2>
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

<div class="form-container">
    <form action="action.php?action=submit_step1" method="POST" enctype="multipart/form-data">
        <input type="text" name="firstName" placeholder="*Prénom" required>
        <input type="text" name="lastName" placeholder="*Nom" required>
        <input type="date" name="birthDate" placeholder="Date de naissance">
        <label for="profilePic" class="ProfilePic-label">
            <img id="profilePicPreview" src="view/assets/upload-img.svg">
            <span id="profilePicName">Photo de profil</span>
        </label>
        <input type="file" id="profilePic" name="profilePic" placeholder="Photo de profil">
        <input type="text" name="address" placeholder="Adresse">
        <input type="email" name="email" placeholder="*Adresse email" required>
        <input type="tel" name="phone" placeholder="Numéro de téléphone">

        <div id="experienceContainer"></div>
        <button type="button" id="addExperience">Ajouter une expérience</button>

        <button type="submit" class="btn-next">Suivant</button>
    </form>
</div>

<script>
    // Je sais pas faire ca en PHP mais j'imagine que ca doit etre possible...
    document.getElementById('profilePic').addEventListener('change', function(e) {
        document.getElementById('profilePicName').textContent = e.target.files[0].name;

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePicPreview').src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    document.getElementById('addExperience').addEventListener('click', function() {
        const experienceContainer = document.getElementById('experienceContainer');

        const titleInput = document.createElement('input');
        titleInput.type = 'text';
        titleInput.name = 'experienceTitle[]';
        titleInput.placeholder = 'Titre de l\'expérience';

        const descriptionInput = document.createElement('textarea');
        descriptionInput.type = 'text';
        descriptionInput.name = 'experienceDescription[]';
        descriptionInput.placeholder = 'Description';

        experienceContainer.appendChild(titleInput);
        experienceContainer.appendChild(descriptionInput);
    });
</script>
