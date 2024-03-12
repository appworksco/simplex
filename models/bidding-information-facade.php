<?php

class BiddingInformationFacade extends DBConnection {

    public function fetchBiddingInformationReport() {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_information");
        $sql->execute();
        return $sql;
    }

    public function fetchBiddingInformation() {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_information WHERE project_status = 'Won' AND project_budget_amount != total_paid");
        $sql->execute();
        return $sql;
    }

    public function fetchBiddingByBMNumber($BMNumber) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_information WHERE bm_no = '$BMNumber'");
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

    public function fetchBiddingByProjectName($projectName) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_information WHERE project_name = '$projectName'");
        $sql->execute();
        return $sql;
    }

    public function fetchBiddingByBMNO($BMNumber) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_information WHERE bm_no = '$BMNumber'");
        $sql->execute();
        return $sql;
    }

    public function verifyProjectTypeCode($projectTypeCode) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_type WHERE project_type_code = ?");
        $sql->execute([$projectTypeCode]);
        $count = $sql->rowCount();
        return $count;
    }

    public function addBidding($bmno, $projectName, $biddingDate, $projectTypeId, $LGUId, $projectBudgetAmount, $totalSKUQuantity, $totalQuantity) {
        $sql = $this->connect()->prepare("INSERT INTO bd_project_information(bm_no, project_name, bid_date, project_type_id, lgu_id, project_budget_amount, total_sku_quantity, total_quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$bmno, $projectName, $biddingDate, $projectTypeId, $LGUId, $projectBudgetAmount, $totalSKUQuantity, $totalQuantity]);
        return $sql;
    }

    public function updateBidding($bmno, $biddingDate, $projectName, $projectTypeId, $LGUId, $projectStatus, $paymentStructure, $projectBudgetAmount, $totalSKUQuantity, $awardDate, $deliveryTargetMonth, $remarks, $biddingId) {
        $sql = $this->connect()->prepare("UPDATE bd_project_information SET bm_no = '$bmno', bid_date = '$biddingDate', project_name = '$projectName', project_type_id = '$projectTypeId', lgu_id = '$LGUId', project_status = '$projectStatus', payment_structure = '$paymentStructure', project_budget_amount = '$projectBudgetAmount', total_sku_quantity = '$totalSKUQuantity', award_date = '$awardDate', delivery_target_month = '$deliveryTargetMonth', remarks = '$remarks' WHERE id = '$biddingId'");
        $sql->execute();
        return $sql;
    }

    public function updateTotalPaid($remainingBalance, $BMNumber) {
        $sql = $this->connect()->prepare("UPDATE bd_project_information SET total_paid = total_paid + '$remainingBalance' WHERE bm_no = '$BMNumber'");
        $sql->execute();
        return $sql;
    }

    public function updateTotalPaidPartial($totalPaid, $BMNumber) {
        $sql = $this->connect()->prepare("UPDATE bd_project_information SET total_paid = '$totalPaid' WHERE bm_no = '$BMNumber'");
        $sql->execute();
        return $sql;
    }

    public function updateProjectExpenseAmount($totalAmount, $BMNumber) {
        $sql = $this->connect()->prepare("UPDATE bd_project_information SET project_expenses_amount = '$totalAmount' WHERE bm_no = '$BMNumber'");
        $sql->execute();
        return $sql;
    }

    public function updateTotalDelivered($totalQuantity, $BMNumber) {
        $sql = $this->connect()->prepare("UPDATE bd_project_information SET total_delivered = total_delivered + '$totalQuantity' WHERE bm_no = '$BMNumber'");
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