<?php

class PaymentFacade extends DBConnection {

    public function fetchPayments() {
        $sql = $this->connect()->prepare("SELECT * FROM bd_payments");
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

    public function addPayment($projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate,  $deliveredTotalQuantity, $deliveredTotalAmount, $billNumber, $billDate, $billQuantity, $billAmount, $paymentMode, $paymentDate, $paymentAmount, $paymentReceiptNumber, $partialBillNumber, $partialPaymentMode, $partialPaymentDate, $partialPaymentAmount, $partialPaymentReceiptNumber) {
        $sql = $this->connect()->prepare("INSERT INTO bd_payments(project_name, project_type_id, lgu_id, po_no, dr_no, dr_date, delivered_total_quantity, delivered_total_amount, bill_no, bill_date, bill_quantity, bill_amount, payment_mode, payment_date, payment_amount, payment_receipt_number, partial_bill_no, partial_payment_mode, partial_payment_date, partial_payment_amount, partial_payment_receipt_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate,  $deliveredTotalQuantity, $deliveredTotalAmount, $billNumber, $billDate, $billQuantity, $billAmount, $paymentMode, $paymentDate, $paymentAmount, $paymentReceiptNumber, $partialBillNumber, $partialPaymentMode, $partialPaymentDate, $partialPaymentAmount, $partialPaymentReceiptNumber]);
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