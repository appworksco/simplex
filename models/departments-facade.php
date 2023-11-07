<?php

class DepartmentsFacade extends DBConnection {

    public function fetchDepartments() {
        $sql = $this->connect()->prepare("SELECT * FROM departments");
        $sql->execute();
        return $sql;
    }

    public function fetchDepartmentByCode($departmentCode) {
        $sql = $this->connect()->prepare("SELECT department_name FROM departments WHERE department_code = ?");
        $sql->execute([$departmentCode]);
        return $sql;
    }

    public function addDepartment($departmentName, $departmentCode) {
        $sql = $this->connect()->prepare("INSERT INTO departments(department_name, department_code) VALUES (?, ?)");
        $sql->execute([$departmentName, $departmentCode]);
        return $sql;
    }

    public function verifyDepartmentCode($departmentCode) {
        $sql = $this->connect()->prepare("SELECT department_code FROM departments WHERE department_code = ?");
        $sql->execute([$departmentCode]);
        $count = $sql->rowCount();
        return $count;
    }

}

?> 