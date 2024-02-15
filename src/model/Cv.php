<?php

namespace model;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class Cv
{
    public function createCv($title, $thumbnail, $template_path, $userId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO CV (title, thumbnail, template_path, user_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $thumbnail, $template_path, $userId]);
        return $db->lastInsertId();
    }

    public function getCvByUserId($userId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM CV WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getCvById($cvId)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM CV WHERE id = ?");
        $stmt->execute([$cvId]);
        return $stmt->fetchAll();
    }

    public function updateCv($cvId, $title, $thumbnail, $template_path, $colorId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE CV SET title = ?, thumbnail = ?, template_path = ?, color_id = ? WHERE id = ?");
        $stmt->execute([$title, $thumbnail, $template_path, $colorId, $cvId]);
    }

    public function deleteCv($cvId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM CV WHERE id = ?");
        $stmt->execute([$cvId]);
    }
}