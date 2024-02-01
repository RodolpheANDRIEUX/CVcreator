<?php

namespace models;

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
        // TODO: Hasher le mot de passe avant de l'ajouter à la base de données
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

}
