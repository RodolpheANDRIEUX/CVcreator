<?php

namespace controller;

use Exception;
use models\Interest;

require_once __DIR__ . '/../models/Interest.php';

class InterestController {
    private $interestModel;

    public function __construct() {
        $this->interestModel = new Interest();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addInterest($title, $description, $cvContentId) {
        if (empty($title) || empty($description) || empty($cvContentId)) {
            throw new Exception("Title, description and CV content ID are required.");
        }

        $this->interestModel->createInterest($title, $description, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function getInterestById($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        return $this->interestModel->getInterestById($id);
    }

    /**
     * @throws Exception if id or title or description or cv content id is empty
     */
    public function updateInterest($id, $title, $description, $cvContentId) {
        if (empty($id) || empty($title) || empty($description) || empty($cvContentId)) {
            throw new Exception("ID, title, description and CV content ID are required.");
        }

        $this->interestModel->updateInterest($id, $title, $description, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
    This `InterestController` class has methods to add, get, update, and delete interests. Each method validates its parameters and then calls the corresponding method in the `Interest` model.     */
    public function deleteInterest($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        $this->interestModel->deleteInterest($id);
    }
}