<?php

class UsersFacade extends DBConnection
{

    public function fetchUsers()
    {
        $sql = $this->connect()->prepare("SELECT * FROM users");
        $sql->execute();
        return $sql;
    }

    public function fetchUserByCompanyId($companyId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM users WHERE company_id = ?");
        $sql->execute([$companyId]);
        return $sql;
    }

    public function verifyUsernameAndPassword($username, $password)
    {
        $sql = $this->connect()->prepare("SELECT username, password FROM users WHERE username = ? AND password = ?");
        $sql->execute([$username, $password]);
        $count = $sql->rowCount();
        return $count;
    }

    public function verifyCompanyId($companyId)
    {
        $sql = $this->connect()->prepare("SELECT company_id FROM users WHERE company_id = ?");
        $sql->execute([$companyId]);
        $count = $sql->rowCount();
        return $count;
    }

    public function verifyEmployee($firstName, $middleName, $lastName)
    {
        $sql = $this->connect()->prepare("SELECT first_name, middle_name, last_name FROM users WHERE first_name = ? AND middle_name = ? AND last_name = ?");
        $sql->execute([$firstName, $middleName, $lastName]);
        $count = $sql->rowCount();
        return $count;
    }

    public function login($username, $password)
    {
        $sql = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $sql->execute([$username, $password]);
        return $sql;
    }

    public function addEmployee($companyId, $username, $password, $firstName, $middleName, $lastName, $birthDate, $bloodType, $address, $contactPerson, $contactPersonNumber, $department, $position, $services, $sss, $pagIbig, $phic, $tin, $status)
    {
        $sql = $this->connect()->prepare("INSERT INTO users(company_id, username, password, first_name, middle_name, last_name, birthdate, blood_type, address, contact_person, contact_person_number, department, position, services, sss, pag_ibig, phic, tin, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$companyId, $username, $password, $firstName, $middleName, $lastName, $birthDate, $bloodType, $address, $contactPerson, $contactPersonNumber, $department, $position, $services, $sss, $pagIbig, $phic, $tin, $status]);
        return $sql;
    }

    public function updateEmployee($employeeId, $companyId, $firstName, $middleName, $lastName, $birthDate, $bloodType, $address, $contactPerson, $contactPersonNumber, $department, $position, $services, $sss, $pagIbig, $phic, $tin, $status)
    {
        $sql = $this->connect()->prepare("UPDATE users SET company_id = '$companyId', first_name = '$firstName', middle_name = '$middleName', last_name = '$lastName', birthdate = '$birthDate', blood_type = '$bloodType', address = '$address', contact_person = '$contactPerson', contact_person_number = '$contactPersonNumber', department = '$department', position = '$position', services = '$services', sss = '$sss', pag_ibig = '$pagIbig', phic = '$phic', tin = '$tin', status = '$status' WHERE id = '$employeeId'");
        $sql->execute();
        return $sql;
    }

    public function fetchEmployeeById($employeeId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM users WHERE id = ?");
        $sql->execute([$employeeId]);
        return $sql;
    }

    public function deleteEmployee($employeeId)
    {
        $sql = $this->connect()->prepare("DELETE FROM users WHERE id = $employeeId");
        $sql->execute();
        return $sql;
    }

    public function fetchUserById($userId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM users WHERE id = ?");
        $sql->execute([$userId]);
        return $sql;
    }

    public function fetchUserNameById($userId)
    {
        $sql = $this->connect()->prepare("SELECT first_name, last_name FROM users WHERE id = ?");
        $sql->execute([$userId]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchUserIdById($userId)
    {
        $sql = $this->connect()->prepare("SELECT id FROM users WHERE id = ?");
        $sql->execute([$userId]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['id'];
        } else {
            return null; // Return null kung walang result
        }
    }
}
