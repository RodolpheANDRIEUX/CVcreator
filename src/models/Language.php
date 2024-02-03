<?php

namespace models;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class Language
{
    public function createLanguage($name, $level, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO Language (name, level, cv_content_id) VALUES (?, ?, ?)");
        $stmt->execute([$name, $level, $cvContentId]);
    }

    public function getLanguageById($languageId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Language WHERE id = ?");
        $stmt->execute([$languageId]);
        return $stmt->fetchAll();
    }

    public function updateLanguage($languageId, $name, $level, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE Language SET name = ?, level = ?, cv_content_id = ? WHERE id = ?");
        $stmt->execute([$name, $level, $cvContentId, $languageId]);
    }

    public function deleteLanguage($languageId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM Language WHERE id = ?");
        $stmt->execute([$languageId]);
    }
}