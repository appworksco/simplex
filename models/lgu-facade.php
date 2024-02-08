<?php

class LGUFacade extends DBConnection
{

    public function fetchLGU()
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_lgu ORDER BY lgu_name");
        $sql->execute();
        return $sql;
    }

    public function fetchLGUById($LGUId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_lgu WHERE id = ?");
        $sql->execute([$LGUId]);
        return $sql;
    }

    public function addLGU($LGUCode, $LGUName, $municipalityId)
    {
        $sql = $this->connect()->prepare("INSERT INTO bd_lgu(lgu_code, lgu_name, municipality_id) VALUES (?, ?, ?)");
        $sql->execute([$LGUCode, $LGUName, $municipalityId]);
        return $sql;
    }

    public function updateLGU($LGUCode, $LGUName, $municipalityId, $LGUId)
    {
        $sql = $this->connect()->prepare("UPDATE bd_lgu SET lgu_code = '$LGUCode', lgu_name = '$LGUName', municipality_id = '$municipalityId' WHERE id = '$LGUId'");
        $sql->execute();
        return $sql;
    }

    public function verifyLGU($LGUCode, $LGUName)
    {
        $sql = $this->connect()->prepare("SELECT lgu_code, lgu_name FROM bd_lgu WHERE lgu_code = ? AND lgu_name = ?");
        $sql->execute([$LGUCode, $LGUName]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deleteLGU($LGUId)
    {
        $sql = $this->connect()->prepare("DELETE FROM bd_lgu WHERE id = $LGUId");
        $sql->execute();
        return $sql;
    }
}
