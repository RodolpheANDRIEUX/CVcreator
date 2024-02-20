<?php

namespace controller;

use Exception;
use model\UserModel;

require_once __DIR__ . '/../model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
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

        // TODO: Add more validation rules

        $this->userModel->addUser($username, $email, $password);
    }

    public function getUserById($id) {
        return $this->userModel->getUserById($id);
    }

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

    /**
     * @throws Exception if the user ID is empty or if the passwords do not match or if the password is too short
     */
    public function updateUser($id, $username, $email, $password, $password2) {
        if (empty($username) || empty($email) || empty($password) || empty($password2)) {
            throw new Exception("All fields are required.");
        }

        if ($password !== $password2) {
            throw new Exception("Passwords do not match.");
        }

        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long.");
        }

        $this->userModel->updateUser($id, $username, $email, $password);
    }

    /**
     * @throws Exception if the user ID is empty
     */
    public function deleteUser($id) {
        if (empty($id)) {
            throw new Exception("User ID is required.");
        }

        $this->userModel->deleteUser($id);
    }
}
