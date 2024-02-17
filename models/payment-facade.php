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

    public function fetchPaymentById($paymentId) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_payments WHERE id = '$paymentId'");
        $sql->execute();
        return $sql;
    }

    public function verifyProjectTypeCode($projectTypeCode) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_type WHERE project_type_code = ?");
        $sql->execute([$projectTypeCode]);
        $count = $sql->rowCount();
        return $count;
    }

    public function addPayment($projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $billQuantity, $billAmount) {
        $sql = $this->connect()->prepare("INSERT INTO bd_payments(project_name, project_type_id, lgu_id, po_no, dr_no, dr_date, delivered_total_quantity, delivered_total_amount, bill_quantity, bill_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $billQuantity, $billAmount]);
        return $sql;
    }

    public function updatePayment($billNumber, $billDate, $paymentMode, $paymentDate, $paymentAmount, $paymentReceiptNumber, $partialBillNumber, $partialPaymentMode, $partialPaymentDate, $partialPaymentAmount, $partialPaymentReceiptNumber, $paymentId) {
        $sql = $this->connect()->prepare("UPDATE bd_payments SET bill_no = '$billNumber', bill_date = '$billDate', payment_mode = '$paymentMode', payment_date = '$paymentDate', payment_amount = '$paymentAmount', payment_receipt_number = '$paymentReceiptNumber', partial_bill_no = '$partialBillNumber', partial_payment_mode = '$partialPaymentMode', partial_payment_date = '$partialPaymentDate', partial_payment_amount = '$partialPaymentAmount', partial_payment_receipt_number = '$partialPaymentReceiptNumber' WHERE id = '$paymentId'");
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