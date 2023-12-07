<?php

class PositionsFacade extends DBConnection {

    public function fetchPositions() {
        $sql = $this->connect()->prepare("SELECT * FROM positions");
        $sql->execute();
        return $sql;
    }

    public function fetchPositionByCode($positionCode) {
        $sql = $this->connect()->prepare("SELECT position_name FROM positions WHERE position_code = ?");
        $sql->execute([$positionCode]);
        return $sql;
    }

    public function fetchPositionById($positionId) {
        $sql = $this->connect()->prepare("SELECT * FROM positions WHERE id = ?");
        $sql->execute([$positionId]);
        return $sql;
    }

    public function addPosition($positionName, $positionCode) {
        $sql = $this->connect()->prepare("INSERT INTO positions(position_name, position_code) VALUES (?, ?)");
        $sql->execute([$positionName, $positionCode]);
        return $sql;
    }

    public function updatePosition($positionName, $positionCode, $positionId) {
        $sql = $this->connect()->prepare("UPDATE positions SET position_name = '$positionName', position_code = '$positionCode' WHERE id = '$positionId'");
        $sql->execute();
        return $sql;
    }

    public function verifyPositionCode($positionCode) {
        $sql = $this->connect()->prepare("SELECT position_code FROM positions WHERE position_code = ?");
        $sql->execute([$positionCode]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deletePosition($positionId)  {
        $sql = $this->connect()->prepare("DELETE FROM positions WHERE id = $positionId");
        $sql->execute();
        return $sql;
    }

}

?> 