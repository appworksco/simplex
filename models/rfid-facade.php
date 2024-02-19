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
        $sql = $this->connect()->prepare("SELECT company_id, date FROM rfid WHERE company_id = ? AND date = ? AND time_out IS NULL");
        $sql->execute([$companyId, $date]);
        $count = $sql->rowCount();
        return $count;
    }

    public function manageEmployeeAttendance($companyId, $employee, $date, $time) {
        // Check if time-in or time-out
        if (strpos($time, ':') !== false) {
            // Time-in
            return $this->employeeTimeIn($companyId, $employee, $date, $time);
        } else {
            // Time-out
            return $this->employeeTimeOut($companyId, $date, $time);
        }
    }

    public function employeeTimeIn($companyId, $employee, $date, $timeIn) {
        $sql = $this->connect()->prepare("INSERT INTO rfid(company_id, employee, date, time_in) VALUES (?, ?, ?, ?)");
        $sql->execute([$companyId, $employee, $date, $timeIn]);
        return $sql;
    }

    public function employeeTimeOut($companyId, $date, $timeOut) {
        $sql = $this->connect()->prepare("UPDATE rfid SET time_out = ? WHERE company_id = ? AND date = ?");
        $sql->execute([$timeOut, $companyId, $date]);
        return $sql;
    }

    public function employeeShiftOut($companyId, $date, $shiftOut) {
        $sql = $this->connect()->prepare("UPDATE rfid SET shift_out = ? WHERE company_id = ? AND date = ?");
        $sql->execute([$shiftOut, $companyId, $date]);
        return $sql;
    }

    public function employeeShiftIn($companyId, $date, $shiftIn) {
        $sql = $this->connect()->prepare("UPDATE rfid SET shift_in = ? WHERE company_id = ? AND date = ?");
        $sql->execute([$shiftIn, $companyId, $date]);
        return $sql;
    }





    public function getEmployeeInfo($companyId) {
        $sql = $this->connect()->prepare("SELECT * FROM rfid WHERE company_id = ?");
        $sql->execute([$companyId]);
        return $sql->fetch(PDO::FETCH_ASSOC); // Assuming you expect only one record for a given company ID
    }
    // Login
    public function insertClockInRecord($companyId, $employee, $date, $time) {
        $sql = $this->connect()->prepare("INSERT INTO rfid(company_id, employee, date, time_in) VALUES (?, ?, ?, ?)");
        $sql->execute([$companyId, $employee, $date, $time]);
        return $sql;
    }
    // Logout
    public function insertClockOutRecord($companyId, $date, $time) {
        $sql = $this->connect()->prepare("UPDATE rfid SET time_out = ? WHERE company_id = ? AND date = ?");
        $sql->execute([$time, $companyId, $date]);
        return $sql;
    }


    // Breakout
    public function insertBreakOutRecord($companyId, $date, $time) {
        $sql = $this->connect()->prepare("UPDATE rfid SET break_out = ? WHERE company_id = ? AND date = ?");
        $sql->execute([$time, $companyId, $date]);
        return $sql;
    }
    // Breakin
    public function insertBreakInRecord($companyId, $date, $time) {
        $sql = $this->connect()->prepare("UPDATE rfid SET break_in = ? WHERE company_id = ? AND date = ?");
        $sql->execute([$time, $companyId, $date]);
        return $sql;
    }

}

?>
