<?php

namespace controller;

use Exception;
use models\CvContent;

require_once __DIR__ . '/../models/CvContent.php';

class CvContentController {
    private $cvContentModel;

    public function __construct() {
        $this->cvContentModel = new CvContent();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addCvContent($firstName, $lastName, $email, $cvId, $birthDate = null, $profilePic = null, $address = null, $phone = null, $colorId = null) {
        if (empty($firstName) || empty($lastName) || empty($email)) {
            throw new Exception("First name, last name and email are required.");
        }

        $birthDate = ($birthDate != '') ? $birthDate : null;

        $this->cvContentModel->createCvContent($firstName, $lastName, $birthDate, $profilePic, $address, $email, $phone, $cvId, $colorId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function getCvContentById($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        return $this->cvContentModel->getCvContentById($id);
    }

    /**
     * @throws Exception if id or first name or last name or email is empty
     */
    public function updateCvContent($firstName, $lastName, $email, $cvId, $birthDate, $profilePic = null, $address = null, $phone = null, $colorId = null) {
        if (empty($id) || empty($firstName) || empty($lastName) || empty($email)) {
            throw new Exception("ID, first name, last name and email are required.");
        }

        $birthDate = ($birthDate != '') ? $birthDate : null;

        $this->cvContentModel->updateCvContent($id, $firstName, $lastName, $birthDate, $profilePic, $address, $email, $phone, $cvId, $colorId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function deleteCvContent($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        $this->cvContentModel->deleteCvContent($id);
    }
}