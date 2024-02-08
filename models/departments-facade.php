<?php

class DepartmentsFacade extends DBConnection
{

    public function fetchDepartments()
    {
        $sql = $this->connect()->prepare("SELECT * FROM departments ORDER BY department_name");
        $sql->execute();
        return $sql;
    }

    public function fetchDepartmentByCode($departmentCode)
    {
        $sql = $this->connect()->prepare("SELECT department_name FROM departments WHERE department_code = ?");
        $sql->execute([$departmentCode]);
        return $sql;
    }

    public function fetchDepartmentById($departmentId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM departments WHERE id = ?");
        $sql->execute([$departmentId]);
        return $sql;
    }

    public function addDepartment($departmentName, $departmentCode)
    {
        $sql = $this->connect()->prepare("INSERT INTO departments(department_name, department_code) VALUES (?, ?)");
        $sql->execute([$departmentName, $departmentCode]);
        return $sql;
    }

    public function updateDepartment($departmentName, $departmentCode, $departmentId)
    {
        $sql = $this->connect()->prepare("UPDATE departments SET department_name = '$departmentName', department_code = '$departmentCode' WHERE id = '$departmentId'");
        $sql->execute();
        return $sql;
    }

    public function verifyDepartmentCode($departmentCode)
    {
        $sql = $this->connect()->prepare("SELECT department_code FROM departments WHERE department_code = ?");
        $sql->execute([$departmentCode]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deleteDepartment($departmentId)
    {
        $sql = $this->connect()->prepare("DELETE FROM departments WHERE id = $departmentId");
        $sql->execute();
        return $sql;
    }
}
