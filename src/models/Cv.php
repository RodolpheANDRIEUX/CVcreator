<?php

namespace models;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class Cv
{
    public function createCv($userId, $content) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO cv (user_id, content) VALUES (?, ?)");
        $stmt->execute([$userId, $content]);
    }

    public function getCvByUserId($userId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM cv WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    public function updateCv($cvId, $content) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE cv SET content = ? WHERE id = ?");
        $stmt->execute([$content, $cvId]);
    }

    public function deleteCv($cvId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM cv WHERE id = ?");
        $stmt->execute([$cvId]);
    }
}