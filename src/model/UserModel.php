<?php

namespace model;

use data\Database;

require_once __DIR__ . '/../data/Database.php';

class UserModel
{
    public function getUsers()
    {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM user");
    }

    public function addUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);
    }

    public function getUserByUsername($username) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function updateUser($id, $username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE user SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$username, $email, $hashedPassword, $id]);
    }

    public function deleteUser($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM user WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getUserById($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
