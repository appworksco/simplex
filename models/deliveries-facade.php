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

    public function fetchDeliveryById($deliveryId) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_deliveries WHERE id = '$deliveryId'");
        $sql->execute();
        return $sql;
    }

    public function verifyDeliveryByName($projectName) {
        $sql = $this->connect()->prepare("SELECT * FROM bd_deliveries WHERE project_name = ? AND is_paid = 0");
        $sql->execute([$projectName]);
        $count = $sql->rowCount();
        return $count;
    }

    public function addDelivery($projectName, $BMNumber, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount) {
        $sql = $this->connect()->prepare("INSERT INTO bd_deliveries(project_name, bm_no, project_type_id, lgu_id, po_no, dr_no, dr_date, total_quantity, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$projectName, $BMNumber, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount]);
        return $sql;
    }

    public function updateDelivery($projectName, $BMNumber, $projectTypeId, $LGUId, $DRNumber, $DRDate, $deliveryId) {
        $sql = $this->connect()->prepare("UPDATE bd_deliveries SET project_name = '$projectName', bm_no = '$BMNumber', project_type_id = '$projectTypeId', lgu_id = '$LGUId', dr_no = '$DRNumber', dr_date = '$DRDate' WHERE id = '$deliveryId'");
        $sql->execute();
        return $sql;
    }

    // public function updateDelivery($projectName, $BMNumber, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $deliveryId) {
    //     $sql = $this->connect()->prepare("UPDATE bd_deliveries SET project_name = '$projectName', bm_no = '$BMNumber', project_type_id = '$projectTypeId', lgu_id = '$LGUId', po_no = '$PONumber', dr_no = '$DRNumber', dr_date = '$DRDate', total_quantity = '$totalQuantity', total_amount = '$totalAmount' WHERE id = '$deliveryId'");
    //     $sql->execute();
    //     return $sql;
    // }

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

    public function deleteDelivery($deliveryId) {
        $sql = $this->connect()->prepare("DELETE FROM bd_deliveries WHERE id = $deliveryId");
        $sql->execute();
        return $sql;
    }

    public function deleteDeliveryByPONumber($PONumber) {
        $sql = $this->connect()->prepare("DELETE FROM bd_deliveries WHERE po_no = $PONumber");
        $sql->execute();
        return $sql;
    }

}

?>