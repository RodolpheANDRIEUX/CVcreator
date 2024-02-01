<?php

use models\UserModel;

require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function listUsers() {
        $users = $this->userModel->getUsers();
        include '../view/profile_page.php';
    }

    /**
     * @throws Exception for each validation error
     */
    public function addUser($username, $email, $password, $password2) {

        if (empty($username) || empty($email) || empty($password) || empty($password2)) {
            throw new Exception("All fields are required.");
        }

        if ($password !== $password2) {
            throw new Exception("Passwords do not match.");
        }

        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long.");
        }

        // TODO: Add more validation rules as needed

        $this->userModel->addUser($username, $email, $password);
        header("Location: index.php?action=listUsers");
    }

    // TODO Méthodes pour la mise à jour et la suppression de user

    /**
     * @throws Exception if the user does not exist or if the password is incorrect
     */
    public function loginUser($username, $password)
    {

        $user = $this->userModel->getUserByUsername($username);

        if (!$user) {
            throw new Exception("User does not exist.");
        }

        if (!password_verify($password, $user['password'])) {
            throw new Exception("Incorrect password.");
        }

        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['username'] = $user['username'];
    }
}
