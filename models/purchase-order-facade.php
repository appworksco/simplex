<?php

class PurchaseOrderFacade extends DBConnection {

    public function fetchPO() {
        $sql = $this->connect()->prepare("SELECT * FROM bd_po WHERE is_delivered = 0");
        $sql->execute();
        return $sql;
    }

    public function fetchPOByPONumber($PONumber) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_po WHERE id = '$PONumber'");
        $sql->execute();
        return $sql;
    }

    public function isDelivered($PONumber) {
        $sql = $this->connect()->prepare("UPDATE bd_po SET is_delivered = 1 WHERE id = '$PONumber'");
        $sql->execute();
        return $sql;
    }

    public function fetchLatestBMNO() {
        $sql = $this->connect()->prepare("SELECT bm_no FROM bd_project_information");
        $sql->execute();
        return $sql;
    }

    public function fetchLatestBMNOrow() {
        $sql = $this->connect()->prepare("SELECT bm_no FROM bd_project_information");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }

    public function fetchPOById($POId) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_pO WHERE id = '$POId'");
        $sql->execute();
        return $sql;
    }

    public function verifyProjectTypeCode($projectTypeCode) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_type WHERE project_type_code = ?");
        $sql->execute([$projectTypeCode]);
        $count = $sql->rowCount();
        return $count;
    }

    public function addPO($projectName, $projectTypeId, $LGUId, $PODate, $totalSKUAssortment, $totalQuantity, $totalAmount, $remarks) {
        $sql = $this->connect()->prepare("INSERT INTO bd_po(project_name, project_type_id, lgu_id, po_date, total_sku_assortment, total_sku_quantity, total_amount, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$projectName, $projectTypeId, $LGUId, $PODate, $totalSKUAssortment, $totalQuantity, $totalAmount, $remarks]);
        return $sql;
    }

    public function updatePO($projectName, $projectTypeId, $LGUId, $PODate, $totalSKUAssortment, $totalQuantity, $totalAmount, $remarks, $POId) {
        $sql = $this->connect()->prepare("UPDATE bd_po SET project_name = '$projectName', project_type_id = '$projectTypeId', lgu_id = '$LGUId', po_date = '$PODate', total_sku_assortment = '$totalSKUAssortment', total_sku_quantity = '$totalQuantity', total_amount = '$totalAmount', remarks = '$remarks' WHERE id = '$POId'");
        $sql->execute();
        return $sql;
    }

    public function verifyLGU($LGUCode, $LGUName) {
        $sql = $this->connect()->prepare("SELECT lgu_code, lgu_name FROM bd_lgu WHERE lgu_code = ? AND lgu_name = ?");
        $sql->execute([$LGUCode, $LGUName]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deletePO($POId) {
        $sql = $this->connect()->prepare("DELETE FROM bd_po WHERE id = $POId");
        $sql->execute();
        return $sql;
    }

    public function deletePOByPONumber($PONumber) {
        $sql = $this->connect()->prepare("DELETE FROM bd_po WHERE id = $PONumber");
        $sql->execute();
        return $sql;
    }

}

?> 