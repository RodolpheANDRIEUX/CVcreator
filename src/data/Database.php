<?php

namespace data;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $pdo,
        $host,
        $user,
        $pass,
        $dbname;

    private function __construct()
    {
        require_once __DIR__ . '/db_config.php';

        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->dbname = DB_NAME;

        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql)
    {
        return $this->pdo->query($sql);
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

}