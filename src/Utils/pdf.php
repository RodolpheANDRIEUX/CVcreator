<?php
session_start();

use controller\CvController;
use mikehaertl\wkhtmlto\Pdf;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../controller/CvController.php';
require_once __DIR__ . '/../Logger.php';

$cvController = new CvController();
$logger = new Logger();

$html = $cvController->generateCvHtml($_SESSION['cv_id']);

try {
    $pdf = new Pdf([
        'commandOptions' => [
            'useExec' => true,
            'escapeArgs' => false,
            'procEnv' => [
                'PATH' => 'C:\Program Files\wkhtmltopdf\bin',
            ],
        ],
        'binary' => 'C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe',
    ]);
} catch (Exception $e) {
    $logger->log("Error while creating pdf: " . $e->getMessage());
    die("Error while creating pdf: " . $e->getMessage());
}

$pdf->setOptions([
    'page-size' => 'A4',
    'orientation' => 'Portrait',
    'no-outline',
    'margin-top' => 0,
    'margin-right' => 0,
    'margin-bottom' => 0,
    'margin-left' => 0,
    'dpi' => 800,
    'zoom' => 1.67,
]);

try {
    $pdf->addPage($html);
    $logger->log("Page added");
} catch (Exception $e) {
    $logger->log("Error while adding page: " . $e->getMessage());
    die("Error while adding page: " . $e->getMessage());
}

try {
    $file = __DIR__ . '/cv.pdf';
    if (!$pdf->send( 'cv.pdf')) {
        $error = $pdf->getError();
        $logger->log("Error sending PDF: " . $error);
    }
} catch (Exception $e) {
    $logger->log("Error: " . $e->getMessage());
}