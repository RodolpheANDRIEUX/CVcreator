<head>
    <?php include 'view/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="view/creator-steps/step4.css">
</head>

<div class="progress-bar-container">
    <h2>Étape 4 : Partagez votre nouveau CV</h2>
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

<div class="card">
    <a href="utils/pdf.php" class="dl-btn">Telecharger en PDF</a>

    <div class="share-container">
        <label for="share-link"><h3>Lien de partage</h3></label>
        <textarea id="share-link" readonly>http://localhost:8080/cv/1</textarea>
        <a class="copy" id="copy1"><img src="view/assets/copy.svg" alt="copy"></a>
    </div>

    <div class="share-container">
        <label for="integration"><h3>Intégration HTML</h3></label>
        <textarea id="integration" readonly><iframe src="http://localhost:8080/cv/1" width="100%" height="100%"></iframe></textarea>
        <a class="copy" id="copy2"><img src="view/assets/copy.svg" alt="copy"></a>
    </div>

</div>

<script>
    function copyToClipboard(id) {
        const copyText = document.getElementById(id);
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* convention mobile... */
        document.execCommand("copy");
    }

    document.getElementById("copy1").addEventListener("click", function() {
        copyToClipboard("share-link");
    });

    document.getElementById("copy2").addEventListener("click", function() {
        copyToClipboard("integration");
    });
</script>