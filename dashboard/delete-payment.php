<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/payment-facade.php');
include realpath(__DIR__ . '/../models/purchase-order-facade.php');
include realpath(__DIR__ . '/../models/deliveries-facade.php');

$paymentFacade = new PaymentFacade;
$deliveriesFacade = new DeliveriesFacade;
$POFacade = new PurchaseOrderFacade;

if (isset($_GET["payment_id"])) {
    $paymentId = $_GET["payment_id"];
    $PONumber = $_GET["po_no"];
    $deletePayment = $paymentFacade->deletePayment($paymentId);
    if ($deletePayment) {
        header("Location: payments?delete_msg=Payment has been deleted successfully!");
        $POFacade->deletePOByPONumber($PONumber);
        $deliveriesFacade->deleteDeliveryByPONumber($PONumber);
    }
}