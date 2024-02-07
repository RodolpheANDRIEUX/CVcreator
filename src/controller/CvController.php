<?php

namespace controller;

use Exception;
use model\Cv;

require_once __DIR__ . '/../model/Cv.php';

class CvController {
    private $cvModel;

    public function __construct() {
        $this->cvModel = new Cv();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addCv($title, $userId, $thumbnail = null, $template_path = null) {
        if (empty($title) || empty($userId)) {
            throw new Exception("title and user ID are required.");
        }

        return $this->cvModel->createCv($title, $thumbnail, $template_path, $userId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function getCvByUserId($userId) {
        if (empty($userId)) {
            throw new Exception("User ID is required.");
        }

        return $this->cvModel->getCvByUserId($userId);
    }

    /**
     * @throws Exception
     */
    public function getCvById($cvId) {
        if (empty($cvId)) {
            throw new Exception("CV ID is required.");
        }

        return $this->cvModel->getCvById($cvId);
    }

    /**
     * @throws Exception if id or title is empty
     */
    public function updateCv($title, $userId, $thumbnail = null, $template_path = null) {
        if (empty($cvId) || empty($title)) {
            throw new Exception("A title is required.");
        }

        $this->cvModel->updateCv($cvId, $title, $thumbnail, $template_path);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function deleteCv($cvId) {
        if (empty($cvId)) {
            throw new Exception("CV ID is required.");
        }

        $this->cvModel->deleteCv($cvId);
    }
}