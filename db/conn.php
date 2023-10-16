<?php

class DBConnection {
    private $host = "";
    private $user = "";
    private $pass = "";
    private $db = "";

    protected function connect() {
        try {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
        } catch(PDOException $e) {
            print_r($e);
        }
    }
}

?>
