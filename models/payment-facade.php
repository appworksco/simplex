<?php

class PaymentFacade extends DBConnection {

    public function fetchPayments() {
        $sql = $this->connect()->prepare("SELECT * FROM bd_payments WHERE is_paid = 0");
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

    public function addPayment($projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $billQuantity, $billAmount, $remainingBalance) {
        $sql = $this->connect()->prepare("INSERT INTO bd_payments(project_name, project_type_id, lgu_id, po_no, dr_no, dr_date, delivered_total_quantity, delivered_total_amount, bill_quantity, bill_amount, remaining_balance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $billQuantity, $billAmount, $remainingBalance]);
        return $sql;
    }

    public function updatePayment($billNumber, $billDate, $paymentDate, $paymentAmount, $paymentReceiptNumber, $partialBillNumber, $partialPaymentMode, $partialPaymentDate, $partialPaymentAmount, $partialPaymentReceiptNumber, $paymentId) {
        $sql = $this->connect()->prepare("UPDATE bd_payments SET bill_no = '$billNumber', bill_date = '$billDate', payment_date = '$paymentDate', payment_amount = '$paymentAmount', payment_receipt_number = '$paymentReceiptNumber', partial_bill_no = '$partialBillNumber', partial_payment_mode = '$partialPaymentMode', partial_payment_date = '$partialPaymentDate', partial_payment_amount = '$partialPaymentAmount', partial_payment_receipt_number = '$partialPaymentReceiptNumber' WHERE id = '$paymentId'");
        $sql->execute();
        return $sql;
    }

    public function updatePaymentDelivery($projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $billQuantity, $billAmount) {
        $sql = $this->connect()->prepare("UPDATE bd_payments SET project_name = '$projectName', project_type_id = '$projectTypeId', lgu_id = '$LGUId', po_no = '$PONumber', dr_no = '$DRNumber', dr_date = '$DRDate', delivered_total_quantity = '$totalQuantity', delivered_total_amount = '$totalAmount', bill_quantity = '$billQuantity', bill_amount = '$billAmount' WHERE po_no = '$PONumber'");
        $sql->execute();
        return $sql;
    }

    public function fullPayment($billNumber, $billDate, $paymentMode, $paymentDate, $paymentAmount, $paymentReceiptNumber, $paymentId, $isPaid) {
        $sql = $this->connect()->prepare("UPDATE bd_payments SET bill_no = '$billNumber', bill_date = '$billDate', payment_mode = '$paymentMode', payment_date = '$paymentDate', payment_amount = '$paymentAmount', payment_receipt_number = '$paymentReceiptNumber', is_paid = '$isPaid' WHERE id = '$paymentId'");
        $sql->execute();
        return $sql;
    }

    public function partialPayment($remainingBalance, $oneBillNumber, $onePaymentMode, $onePaymentDate, $onePaymentAmount, $onePaymentReceiptNumber,$twoBillNumber, $twoPaymentMode, $twoPaymentDate, $twoPaymentAmount, $twoPaymentReceiptNumber, $threeBillNumber, $threePaymentMode, $threePaymentDate, $threePaymentAmount, $threePaymentReceiptNumber, $fourBillNumber, $fourPaymentMode, $fourPaymentDate, $fourPaymentAmount, $fourPaymentReceiptNumber, $fiveBillNumber, $fivePaymentMode, $fivePaymentDate, $fivePaymentAmount, $fivePaymentReceiptNumber, $paymentId) {
        $sql = $this->connect()->prepare("UPDATE bd_payments SET remaining_balance = '$remainingBalance', 1st_bill_no = '$oneBillNumber', 1st_payment_mode = '$onePaymentMode', 1st_payment_date = '$onePaymentDate', 1st_payment_amount = '$onePaymentAmount', 1st_payment_receipt_number = '$onePaymentReceiptNumber', 2nd_bill_no = '$twoBillNumber', 2nd_payment_mode = '$twoPaymentMode', 2nd_payment_date = '$twoPaymentDate', 2nd_payment_amount = '$twoPaymentAmount', 2nd_payment_receipt_number = '$twoPaymentReceiptNumber', 3rd_bill_no = '$threeBillNumber', 3rd_payment_mode = '$threePaymentMode', 3rd_payment_date = '$threePaymentDate', 3rd_payment_amount = '$threePaymentAmount', 3rd_payment_receipt_number = '$threePaymentReceiptNumber', 4th_bill_no = '$fourBillNumber', 4th_payment_mode = '$fourPaymentMode', 4th_payment_date = '$fourPaymentDate', 4th_payment_amount = '$fourPaymentAmount', 4th_payment_receipt_number = '$fourPaymentReceiptNumber', 5th_bill_no = '$fiveBillNumber', 5th_payment_mode = '$fivePaymentMode', 5th_payment_date = '$fivePaymentDate', 5th_payment_amount = '$fivePaymentAmount', 5th_payment_receipt_number = '$fivePaymentReceiptNumber' WHERE id = '$paymentId'");
        $sql->execute();
        return $sql;
    }

    public function verifyLGU($LGUCode, $LGUName) {
        $sql = $this->connect()->prepare("SELECT lgu_code, lgu_name FROM bd_lgu WHERE lgu_code = ? AND lgu_name = ?");
        $sql->execute([$LGUCode, $LGUName]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deletePayment($paymentId) {
        $sql = $this->connect()->prepare("DELETE FROM bd_payments WHERE id = $paymentId");
        $sql->execute();
        return $sql;
    }

    public function isPaid($PONumber){
        $sql = $this->connect()->prepare("UPDATE bd_payments SET is_paid = 1 WHERE po_no = '$PONumber'");
        $sql->execute();
        return $sql;
    }

}

?> 