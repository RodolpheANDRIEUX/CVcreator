<?php

namespace controller;

use Exception;
use models\Skill;

require_once __DIR__ . '/../models/Skill.php';

class SkillController {
    private $skillModel;

    public function __construct() {
        $this->skillModel = new Skill();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addSkill($title, $description, $cvContentId) {
        if (empty($title) || empty($description) || empty($cvContentId)) {
            throw new Exception("Title, description and CV content ID are required.");
        }

        $this->skillModel->createSkill($title, $description, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function getSkillById($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        return $this->skillModel->getSkillById($id);
    }

    /**
     * @throws Exception if id or title or description or cv content id is empty
     */
    public function updateSkill($id, $title, $description, $cvContentId) {
        if (empty($id) || empty($title) || empty($description) || empty($cvContentId)) {
            throw new Exception("ID, title, description and CV content ID are required.");
        }

        $this->skillModel->updateSkill($id, $title, $description, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function deleteSkill($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        $this->skillModel->deleteSkill($id);
    }
}