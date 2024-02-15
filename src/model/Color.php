<?php

namespace model;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class Color
{
    public function createColor($name, $thumbnail, $color1, $color2, $color3, $color4) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO Color (name, thumbnail, color1, color2, color3, color4) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $thumbnail, $color1, $color2, $color3, $color4]);
        return $db->lastInsertId();
    }

    public function getColorById($colorId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Color WHERE id = ?");
        $stmt->execute([$colorId]);
        return $stmt->fetchAll();
    }

    public function updateColor($colorId, $name, $thumbnail, $color1, $color2, $color3, $color4)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE Color SET name = ?, thumbnail = ?, color1 = ?, color2 = ?, color3 = ?, color4 = ? WHERE id = ?");
        $stmt->execute([$name, $thumbnail, $color1, $color2, $color3, $color4, $colorId]);
    }

    public function deleteColor($colorId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM Color WHERE id = ?");
        $stmt->execute([$colorId]);
    }

    public function getAllColors()
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM Color");
        $stmt->execute();
        return $stmt->fetchAll();
    }

}