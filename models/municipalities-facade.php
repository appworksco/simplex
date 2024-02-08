<?php

class MunicipalitiesFacade extends DBConnection
{

    public function fetchMunicipalities()
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_municipality ORDER BY municipality_name");
        $sql->execute();
        return $sql;
    }

    public function fetchMunicipalityById($municipalityId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_municipality WHERE id = ?");
        $sql->execute([$municipalityId]);
        return $sql;
    }

    public function addMunicipality($municipalityName, $address)
    {
        $sql = $this->connect()->prepare("INSERT INTO bd_municipality(municipality_name, address) VALUES (?, ?)");
        $sql->execute([$municipalityName, $address]);
        return $sql;
    }

    public function updateMunicipality($municipalityName, $address, $municipalityId)
    {
        $sql = $this->connect()->prepare("UPDATE bd_municipality SET municipality_name = '$municipalityName', address = '$address' WHERE id = '$municipalityId'");
        $sql->execute();
        return $sql;
    }

    public function verifyMunicipalityName($municipalityName)
    {
        $sql = $this->connect()->prepare("SELECT municipality_name FROM bd_municipality WHERE municipality_name = ?");
        $sql->execute([$municipalityName]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deleteMunicipality($municipalityId)
    {
        $sql = $this->connect()->prepare("DELETE FROM bd_municipality WHERE id = $municipalityId");
        $sql->execute();
        return $sql;
    }
}
