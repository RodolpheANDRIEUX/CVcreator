<?php

namespace model;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class License
{
    public function createLicense($type, $name) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO License (type, name) VALUES (?, ?)");
        $stmt->execute([$type, $name]);
    }

    public function getLicenseById($licenseId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM License WHERE id = ?");
        $stmt->execute([$licenseId]);
        return $stmt->fetchAll();
    }

    public function getAllLicenses() {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM License");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateLicense($licenseId, $type, $name) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE License SET type = ?, name = ? WHERE id = ?");
        $stmt->execute([$type, $name, $licenseId]);
    }

    public function deleteLicense($licenseId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM License WHERE id = ?");
        $stmt->execute([$licenseId]);
    }
}