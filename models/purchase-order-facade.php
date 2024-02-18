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

    public function fetchBiddingById($biddingId) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_information WHERE id = '$biddingId'");
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

    public function updateBidding($biddingDate, $projectName, $projectTypeId, $LGUId, $projectStatus, $paymentStructure, $projectBudgetAmount, $awardDate, $deliveryTargetMonth, $remarks, $biddingId) {
        $sql = $this->connect()->prepare("UPDATE bd_project_information SET bid_date = '$biddingDate', project_name = '$projectName', project_type_id = '$projectTypeId', lgu_id = '$LGUId', project_status = '$projectStatus', payment_structure = '$paymentStructure', project_budget_amount = '$projectBudgetAmount', award_date = '$awardDate', delivery_target_month = '$deliveryTargetMonth', remarks = '$remarks' WHERE id = '$biddingId'");
        $sql->execute();
        return $sql;
    }

    public function verifyLGU($LGUCode, $LGUName) {
        $sql = $this->connect()->prepare("SELECT lgu_code, lgu_name FROM bd_lgu WHERE lgu_code = ? AND lgu_name = ?");
        $sql->execute([$LGUCode, $LGUName]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deleteBidding($biddingId) {
        $sql = $this->connect()->prepare("DELETE FROM bd_project_information WHERE id = $biddingId");
        $sql->execute();
        return $sql;
    }

}

?> 