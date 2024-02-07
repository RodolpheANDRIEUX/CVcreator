<?php

use controller\CvContentController;
use controller\CvController;

if (!isset($_SESSION['cv_id'])) {
    die("CV ID is not set in the session.");
}

require_once __DIR__ . '/../controller/CvController.php';
require_once __DIR__ . '/../controller/CvContentController.php';
require_once __DIR__ . '/../Logger.php';

$cvController = new CvController();
$cvContentController = new CvContentController();
$logger = new Logger();

try {
    $cv = $cvController->getCvById($_SESSION['cv_id'])[0];
    $logger->log("User opened CV: " . json_encode($cv));
} catch (Exception $e) {
    die("Error while getting CV: " . $e->getMessage());
}

if (isset($_SESSION['cvContent_id'])) {
    try {
        $cvContent = $cvContentController->getCvContentByCvId($_SESSION['cv_id'])[0];
        $logger->log("User opened CV content: " . json_encode($cvContent));
    } catch (Exception $e) {
        $logger->log("Error while getting CV content: " . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" id="preview-css-link" href="view/templates/">
</head>
<body>
<?php if (isset($_SESSION['cvContent_id'])): ?>

    <h1><?php echo htmlspecialchars($cv['title'] ?? ''); ?></h1>

    <h2><?php echo htmlspecialchars(($cvContent['first_name'] ?? '') . ' ' . ($cvContent['last_name'] ?? '')); ?></h2>
    <p>Email: <?php echo htmlspecialchars($cvContent['email'] ?? ''); ?></p>
    <p>Phone: <?php echo htmlspecialchars($cvContent['phone'] ?? ''); ?></p>
    <p>Address: <?php echo htmlspecialchars($cvContent['address'] ?? ''); ?></p>

<?php endif; ?>
</body>
</html>