<?php

class AssetsFacade extends DBConnection
{

    public function fetchAssets()
    {
        $sql = $this->connect()->prepare("SELECT * FROM assets ORDER BY 'added_date' AND 'department'");
        $sql->execute();
        return $sql;
    }

    public function fetchAssetsSeriesNumber()
    {
        $sql = $this->connect()->prepare("SELECT series_number FROM assets_series");
        $sql->execute();
        return $sql;
    }

    public function updateSeries($updatedSeries)
    {
        $sql = $this->connect()->prepare("UPDATE assets_series SET series_number = '$updatedSeries'");
        $sql->execute();
        return $sql;
    }

    public function addAsset($employee, $empDepartment, $assetName, $description, $quantity, $condition, $remarks, $barcode, $addedBy, $addedOn)
    {
        $sql = $this->connect()->prepare("INSERT INTO assets(employee, department, asset_name, description, quantity, con, remarks, barcode, added_by, added_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$employee, $empDepartment, $assetName, $description, $quantity, $condition, $remarks, $barcode, $addedBy, $addedOn]);
        return $sql;
    }

    public function deleteAsset($assetNum)
    {
        $sql = $this->connect()->prepare("DELETE FROM assets WHERE id = $assetNum");
        $sql->execute();
        return $sql;
    }
}
