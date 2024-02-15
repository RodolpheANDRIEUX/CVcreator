<?php

namespace controller;

use model\Color;

require_once __DIR__ . '/../model/Color.php';

class ColorController
{
    private $colorModel;

    public function __construct()
    {
        $this->colorModel = new Color();
    }

    public function getAllColors()
    {
        return $this->colorModel->getAllColors();
    }

    public function createColor($name, $thumbnail, $color1, $color2, $color3, $color4)
    {
        return $this->colorModel->createColor($name, $thumbnail, $color1, $color2, $color3, $color4);
    }

    public function getColorById($colorId)
    {
        return $this->colorModel->getColorById($colorId);
    }

    public function updateColor($colorId, $name, $thumbnail, $color1, $color2, $color3, $color4)
    {
        $this->colorModel->updateColor($colorId, $name, $thumbnail, $color1, $color2, $color3, $color4);
    }

    public function deleteColor($colorId)
    {
        $this->colorModel->deleteColor($colorId);
    }
}