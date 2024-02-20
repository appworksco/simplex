<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/purchase-order-facade.php');

$POFacade = new PurchaseOrderFacade;

if (isset($_GET["po_id"])) {
    $POId = $_GET["po_id"];
    $deletePO = $POFacade->deletePO($POId);
    if ($deletePO) {
        header("Location: purchase-order?delete_msg=Purchase order has been deleted successfully!");
    }
}