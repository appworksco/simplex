<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/deliveries-facade.php');
include realpath(__DIR__ . '/../models/purchase-order-facade.php');

$deliveriesFacade = new DeliveriesFacade;
$POFacade = new PurchaseOrderFacade;

if (isset($_GET["delivery_id"]) && isset($_GET["po_no"])) {
    $deliveryId = $_GET["delivery_id"];
    $PONumber = $_GET["po_no"];
    $deleteDelivery = $deliveriesFacade->deleteDelivery($deliveryId);
    if ($deleteDelivery) {
        header("Location: deliveries?delete_msg=Delivery has been deleted successfully!");
        $POFacade->deletePOByPONumber($PONumber);
    }
}
