<?php

namespace controller;

use Exception;
use model\Education;

require_once __DIR__ . '/../model/Education.php';

class EducationController {
    private $educationModel;

    public function __construct() {
        $this->educationModel = new Education();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addEducation($title, $description, $cvContentId) {
        if (empty($title) || empty($cvContentId)) {
            throw new Exception("Title and CV content ID are required.");
        }

        $this->educationModel->createEducation($title, $description, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function getEducationById($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        return $this->educationModel->getEducationById($id);
    }

    /**
     * @throws Exception if id or title or description or cv content id is empty
     */
    public function updateEducation($id, $title, $description, $cvContentId) {
        if (empty($id) || empty($title) || empty($description) || empty($cvContentId)) {
            throw new Exception("ID, title, description and CV content ID are required.");
        }

        $this->educationModel->updateEducation($id, $title, $description, $cvContentId);
    }

    /**
     */
    public function deleteEducation($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        $this->educationModel->deleteEducation($id);
    }
}