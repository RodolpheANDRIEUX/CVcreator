<?php

namespace controller;

use Exception;
use model\CvContent;

require_once __DIR__ . '/../model/CvContent.php';

class CvContentController {
    private $cvContentModel;

    public function __construct() {
        $this->cvContentModel = new CvContent();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addCvContent($firstName, $lastName, $email, $cvId, $birthDate = null, $profilePic = null, $address = null, $phone = null) {
        if (empty($firstName) || empty($lastName) || empty($email)) {
            throw new Exception("First name, last name and email are required.");
        }

        $birthDate = ($birthDate != '') ? $birthDate : null;

        return $this->cvContentModel->createCvContent($firstName, $lastName, $birthDate, $profilePic, $address, $email, $phone, $cvId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function GetByContentId($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        return $this->cvContentModel->getCvContentById($id);
    }

    /**
     * @throws Exception
     */
    public function getCvContentByCvId($cvId) {
        if (empty($cvId)) {
            throw new Exception("CV ID is required.");
        }

        return $this->cvContentModel->getCvContentByCvId($cvId);
    }

    /**
     * @throws Exception if id or first name or last name or email is empty
     */
    public function updateCvContent($firstName, $lastName, $email, $cvId, $birthDate, $profilePic = null, $address = null, $phone = null) {
        if (empty($cvId) || empty($firstName) || empty($lastName) || empty($email)) {
            throw new Exception("ID, first name, last name and email are required.");
        }

        $birthDate = ($birthDate != '') ? $birthDate : null;

        $this->cvContentModel->updateCvContent($cvId, $firstName, $lastName, $birthDate, $profilePic, $address, $email, $phone, $cvId);
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

    /**
     * @throws Exception
     */
    public function deleteCvContentByCvId($cv_id)
    {
        if (empty($cv_id)) {
            throw new Exception("CV ID is required.");
        }

        $this->cvContentModel->deleteCvContentByCvId($cv_id);
    }
}