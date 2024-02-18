<?php

class DeliveriesFacade extends DBConnection {

    public function fetchDeliveries() {
        $sql = $this->connect()->prepare("SELECT * FROM bd_deliveries WHERE is_paid = 0");
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

    public function addDelivery($projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount) {
        $sql = $this->connect()->prepare("INSERT INTO bd_deliveries(project_name, project_type_id, lgu_id, po_no, dr_no, dr_date, total_quantity, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount]);
        return $sql;
    }

    public function updateBidding($biddingDate, $projectName, $projectTypeId, $LGUId, $projectStatus, $paymentStructure, $projectBudgetAmount, $awardDate, $deliveryTargetMonth, $remarks, $biddingId) {
        $sql = $this->connect()->prepare("UPDATE bd_project_information SET bid_date = '$biddingDate', project_name = '$projectName', project_type_id = '$projectTypeId', lgu_id = '$LGUId', project_status = '$projectStatus', payment_structure = '$paymentStructure', project_budget_amount = '$projectBudgetAmount', award_date = '$awardDate', delivery_target_month = '$deliveryTargetMonth', remarks = '$remarks' WHERE id = '$biddingId'");
        $sql->execute();
        return $sql;
    }

    public function isPaid($PONumber){
        $sql = $this->connect()->prepare("UPDATE bd_deliveries SET is_paid = 1 WHERE po_no = '$PONumber'");
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