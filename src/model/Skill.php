<?php

namespace model;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class Skill
{
    public function createSkill($title, $description, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO Skill (title, description, cv_content_id) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $cvContentId]);
    }

    public function getSkillById($skillId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Skill WHERE id = ?");
        $stmt->execute([$skillId]);
        return $stmt->fetchAll();
    }

    public function updateSkill($skillId, $title, $description, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE Skill SET title = ?, description = ?, cv_content_id = ? WHERE id = ?");
        $stmt->execute([$title, $description, $cvContentId, $skillId]);
    }

    public function deleteSkill($skillId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM Skill WHERE id = ?");
        $stmt->execute([$skillId]);
    }
}