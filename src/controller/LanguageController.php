<?php

namespace controller;

use Exception;
use model\Language;

require_once __DIR__ . '/../model/Language.php';

class LanguageController {
    private $languageModel;

    public function __construct() {
        $this->languageModel = new Language();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addLanguage($name, $level, $cvContentId) {
        if (empty($name) || empty($level) || empty($cvContentId)) {
            throw new Exception("Name and level are required.");
        }

        $this->languageModel->createLanguage($name, $level, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function getLanguageById($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        return $this->languageModel->getLanguageById($id);
    }

    /**
     * @throws Exception if id or name or level or cv content id is empty
     */
    public function updateLanguage($id, $name, $level, $cvContentId) {
        if (empty($id) || empty($name) || empty($level) || empty($cvContentId)) {
            throw new Exception("ID, name, level and CV content ID are required.");
        }

        $this->languageModel->updateLanguage($id, $name, $level, $cvContentId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function deleteLanguage($id) {
        if (empty($id)) {
            throw new Exception("ID is required.");
        }

        $this->languageModel->deleteLanguage($id);
    }

    public function GetByContentId($cvContent_id)
    {
        return $this->languageModel->getLanguageByContentId($cvContent_id);
    }
}