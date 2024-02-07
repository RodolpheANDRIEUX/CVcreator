<?php

namespace controller;

use Exception;
use model\LicenseLinkTable;

require_once __DIR__ . '/../model/LicenseLinkTable.php';

class LicenseLinkTableController {
    private $licenseLinkTableModel;

    public function __construct() {
        $this->licenseLinkTableModel = new LicenseLinkTable();
    }

    /**
     * @throws Exception for each validation error
     */
    public function addLicenseLink($cvContentId, $licenseId) {
        if (empty($cvContentId) || empty($licenseId)) {
            throw new Exception("CV content ID and license ID are required.");
        }

        $this->licenseLinkTableModel->createLicenseLink($cvContentId, $licenseId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function getLicenseLinkById($linkId) {
        if (empty($linkId)) {
            throw new Exception("Link ID is required.");
        }

        return $this->licenseLinkTableModel->getLicenseLinkById($linkId);
    }

    /**
     * @throws Exception if id or cv content id or license id is empty
     */
    public function updateLicenseLink($linkId, $cvContentId, $licenseId) {
        if (empty($linkId) || empty($cvContentId) || empty($licenseId)) {
            throw new Exception("Link ID, CV content ID and license ID are required.");
        }

        $this->licenseLinkTableModel->updateLicenseLink($linkId, $cvContentId, $licenseId);
    }

    /**
     * @throws Exception if the id is empty
     */
    public function deleteLicenseLink($linkId) {
        if (empty($linkId)) {
            throw new Exception("Link ID is required.");
        }

        $this->licenseLinkTableModel->deleteLicenseLink($linkId);
    }
}