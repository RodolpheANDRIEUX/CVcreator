<?php

namespace controller;

use Exception;
use model\ProfessionalExperience;

require_once __DIR__ . '/../model/ProfessionalExperience.php';

class ProfessionalExperienceController {
    private $professionalExperienceModel;

    public function __construct() {
        $this->professionalExperienceModel = new ProfessionalExperience();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addProfessionalExperience($title, $description, $cvContentId) {
        if (empty($title) || empty($cvContentId)) {
            throw new Exception("Title and CV content ID are required.");
        }

        $this->professionalExperienceModel->createProfessionalExperience($title, $description, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function getProfessionalExperienceById($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        return $this->professionalExperienceModel->getProfessionalExperienceById($id);
    }

    /**
     * @throws Exception if id or title or description or cv content id is empty
     */
    public function updateProfessionalExperience($id, $title, $description, $cvContentId) {
        if (empty($id) || empty($title) || empty($description) || empty($cvContentId)) {
            throw new Exception("ID, title, description and CV content ID are required.");
        }

        $this->professionalExperienceModel->updateProfessionalExperience($id, $title, $description, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function deleteProfessionalExperience($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        $this->professionalExperienceModel->deleteProfessionalExperience($id);
    }

    public function GetByContentId($cvContent_id)
    {
        return $this->professionalExperienceModel->getProfessionalExperienceByContentId($cvContent_id);
    }
}