<?php

namespace controller;

use model\License;

require_once __DIR__ . '/../model/License.php';

class LicenseController
{
    private $licenseModel;

    public function __construct()
    {
        $this->licenseModel = new License();
    }

    public function getAllLicenses()
    {
        return $this->licenseModel->getAllLicenses();
    }
}