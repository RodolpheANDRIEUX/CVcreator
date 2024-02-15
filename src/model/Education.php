<?php

namespace model;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class Education
{
    public function createEducation($title, $description, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO Education (title, description, cv_content_id) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $cvContentId]);
    }

    public function getEducationById($educationId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Education WHERE id = ?");
        $stmt->execute([$educationId]);
        return $stmt->fetchAll();
    }

    public function updateEducation($educationId, $title, $description, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE Education SET title = ?, description = ?, cv_content_id = ? WHERE id = ?");
        $stmt->execute([$title, $description, $cvContentId, $educationId]);
    }

    public function deleteEducation($educationId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM Education WHERE id = ?");
        $stmt->execute([$educationId]);
    }

    public function getEducationByContentId($cv_id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Education WHERE cv_content_id = ?");
        $stmt->execute([$cv_id]);
        return $stmt->fetchAll();
    }
}