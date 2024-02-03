<?php

namespace models;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class CvContent
{
    public function createCvContent($firstName, $lastName, $birthDate, $profilePic, $email, $phone, $cvId, $colorId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO CV_content (first_name, last_name, birth_date, profile_pic, email, phone, cv_id, color_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $birthDate, $profilePic, $email, $phone, $cvId, $colorId]);
    }

    public function getCvContentById($cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM CV_content WHERE id = ?");
        $stmt->execute([$cvContentId]);
        return $stmt->fetchAll();
    }

    public function updateCvContent($cvContentId, $firstName, $lastName, $birthDate, $profilePic, $email, $phone, $cvId, $colorId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE CV_content SET first_name = ?, last_name = ?, birth_date = ?, profile_pic = ?, email = ?, phone = ?, cv_id = ?, color_id = ? WHERE id = ?");
        $stmt->execute([$firstName, $lastName, $birthDate, $profilePic, $email, $phone, $cvId, $colorId, $cvContentId]);
    }

    public function deleteCvContent($cvContentId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM CV_content WHERE id = ?");
        $stmt->execute([$cvContentId]);
    }
}