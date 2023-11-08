<?php

class AssetsFacade extends DBConnection {

    public function fetchAssets() {
        $sql = $this->connect()->prepare("SELECT * FROM assets ORDER BY 'added_date' AND 'department'");
        $sql->execute();
        return $sql;
    }

    public function addAsset($employee, $empDepartment, $assetName, $description, $quantity, $condition, $remarks, $addedBy, $addedOn) {
        $sql = $this->connect()->prepare("INSERT INTO assets(employee, department, asset_name, description, quantity, con, remarks, added_by, added_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$employee, $empDepartment, $assetName, $description, $quantity, $condition, $remarks, $addedBy, $addedOn]);
        return $sql;
    }

    public function deleteAsset($assetNum)  {
        $sql = $this->connect()->prepare("DELETE FROM assets WHERE id = $assetNum");
        $sql->execute();
        return $sql;
      }

}

?>