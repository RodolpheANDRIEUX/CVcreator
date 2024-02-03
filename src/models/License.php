<?php

namespace models;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class License
{
    public function createLicense($type, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO License (type, cv_content_id) VALUES (?, ?)");
        $stmt->execute([$type, $cvContentId]);
    }

    public function getLicenseById($licenseId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM License WHERE id = ?");
        $stmt->execute([$licenseId]);
        return $stmt->fetchAll();
    }

    public function updateLicense($licenseId, $type, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE License SET type = ?, cv_content_id = ? WHERE id = ?");
        $stmt->execute([$type, $cvContentId, $licenseId]);
    }

    public function deleteLicense($licenseId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM License WHERE id = ?");
        $stmt->execute([$licenseId]);
    }
}