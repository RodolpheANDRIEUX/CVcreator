<?php

namespace model;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class LicenseLinkTable
{
    public function createLicenseLink($cvContentId, $licenseId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO License_link (cv_content_id, license_id) VALUES (?, ?)");
        $stmt->execute([$cvContentId, $licenseId]);
    }

    public function getLicenseLinkById($linkId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM License_link WHERE id = ?");
        $stmt->execute([$linkId]);
        return $stmt->fetchAll();
    }

    public function updateLicenseLink($linkId, $cvContentId, $licenseId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE License_link SET cv_content_id = ?, license_id = ? WHERE id = ?");
        $stmt->execute([$cvContentId, $licenseId, $linkId]);
    }

    public function deleteLicenseLink($linkId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM License_link WHERE id = ?");
        $stmt->execute([$linkId]);
    }

    public function getLicenseLinkByContentId($cvContent_id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM License_link WHERE cv_content_id = ?");
        $stmt->execute([$cvContent_id]);
        return $stmt->fetchAll();
    }
}