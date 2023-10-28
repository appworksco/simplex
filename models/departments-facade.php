<?php

class DepartmentsFacade extends DBConnection {

    public function fetchDepartments() {
        $sql = $this->connect()->prepare("SELECT * FROM departments");
        $sql->execute();
        return $sql;
    }


}

?> 