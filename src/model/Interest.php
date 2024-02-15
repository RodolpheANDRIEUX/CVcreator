<?php

namespace model;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class Interest
{
    public function createInterest($title, $description, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO Interest (title, description, cv_content_id) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $cvContentId]);
    }

    public function getInterestById($interestId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Interest WHERE id = ?");
        $stmt->execute([$interestId]);
        return $stmt->fetchAll();
    }

    public function updateInterest($interestId, $title, $description, $cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE Interest SET title = ?, description = ?, cv_content_id = ? WHERE id = ?");
        $stmt->execute([$title, $description, $cvContentId, $interestId]);
    }

    public function deleteInterest($interestId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM Interest WHERE id = ?");
        $stmt->execute([$interestId]);
    }

    public function getInterestByContentId($cvContent_id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Interest WHERE cv_content_id = ?");
        $stmt->execute([$cvContent_id]);
        return $stmt->fetchAll();
    }
}