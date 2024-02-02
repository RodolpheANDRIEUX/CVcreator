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

<div class="form-container">
    <form action="action.php?action=submit_step1" method="POST">
        <input type="text" name="username" placeholder="*Nom" required>
        <input type="email" name="email" placeholder="*Adresse email" required>
        <input type="tel" name="phone number" placeholder="*Numéro de telephone" required>
        <input type="text" name="experience" placeholder="*Experience" required>
        <input type="text" name="formation" placeholder="*Formation" required>
        <input type="text" name="competences" placeholder="*Compétences" required>
        <input type="text" name="langues" placeholder="Langues" >
        <input type="text" name="loisirs" placeholder="Loisirs" >
        <input type="text" name="reseaux" placeholder="Réseaux" >
        <input type="text" name="site" placeholder="Site" >

        <button type="submit" class="btn-next">Suivant</button>
    </form>
</div>

