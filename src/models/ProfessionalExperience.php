<?php

namespace models;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class ProfessionalExperience
{
    public function createProfessionalExperience($title, $description, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO Professional_experience (title, description, cv_content_id) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $cvContentId]);
    }

    public function getProfessionalExperienceById($experienceId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Professional_experience WHERE id = ?");
        $stmt->execute([$experienceId]);
        return $stmt->fetchAll();
    }

    public function updateProfessionalExperience($experienceId, $title, $description, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE Professional_experience SET title = ?, description = ?, cv_content_id = ? WHERE id = ?");
        $stmt->execute([$title, $description, $cvContentId, $experienceId]);
    }

    public function deleteProfessionalExperience($experienceId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM Professional_experience WHERE id = ?");
        $stmt->execute([$experienceId]);
    }
}