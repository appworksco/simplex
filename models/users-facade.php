<?php

class UsersFacade extends DBConnection {

    public function fetchUsers() {
        $sql = $this->connect()->prepare("SELECT * FROM users");
        $sql->execute();
        return $sql;
    }

    public function fetchUserByCompanyId($companyId) {
        $sql = $this->connect()->prepare("SELECT * FROM users WHERE company_id = ?");
        $sql->execute([$companyId]);
        return $sql;
    }

    public function verifyUsernameAndPassword($username, $password) {
        $sql = $this->connect()->prepare("SELECT username, password FROM users WHERE username = ? AND password = ?");
        $sql->execute([$username, $password]);
        $count = $sql->rowCount();
        return $count;
    }

    public function verifyCompanyId($companyId) {
        $sql = $this->connect()->prepare("SELECT company_id FROM users WHERE company_id = ?");
        $sql->execute([$companyId]);
        $count = $sql->rowCount();
        return $count;
    }

    public function login($username, $password) {
        $sql = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $sql->execute([$username, $password]);
        return $sql;
    }

}

?> 