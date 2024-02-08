<?php

class RFIDFacade extends DBConnection {

    public function fetchRfid() {
        $sql = $this->connect()->prepare("SELECT * FROM rfid");
        $sql->execute();
        return $sql;
    }

    public function fetchRfidByCompanyId($companyId) {
        $sql = $this->connect()->prepare("SELECT * FROM rfid WHERE company_id = ?");
        $sql->execute([$companyId]);
        return $sql;
    }

    public function verifyEmployeeTimeIn($companyId, $date) {
        $sql = $this->connect()->prepare("SELECT company_id, date FROM rfid WHERE company_id = ? AND date = ?");
        $sql->execute([$companyId, $date]);
        $count = $sql->rowCount();
        return $count;
    }

    public function verifyEmployeeTimeOut($companyId, $date) {
        $sql = $this->connect()->prepare("SELECT company_id, date FROM rfid WHERE company_id = ? AND date = ? AND time_out = NULL");
        $sql->execute([$companyId, $date]);
        $count = $sql->rowCount();
        return $count;
    }

    public function employeeTimeIn($companyId, $employee, $date, $timeIn) {
        $sql = $this->connect()->prepare("INSERT INTO rfid(company_id, employee, date, time_in) VALUES (?, ?, ?, ?)");
        $sql->execute([$companyId, $employee, $date, $timeIn]);
        return $sql;
    }

    public function employeeTimeOut($companyId, $date, $timeOut) {
        $sql = $this->connect()->prepare("UPDATE rfid SET time_out = '$timeOut' WHERE company_id = '$companyId' AND date = '$date'");
        $sql->execute();
        return $sql;
    }

}

?> 