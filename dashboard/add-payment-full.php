<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');
include realpath(__DIR__ . '/../models/municipalities-facade.php');
include realpath(__DIR__ . '/../models/lgu-facade.php');
include realpath(__DIR__ . '/../models/project-type-facade.php');
include realpath(__DIR__ . '/../models/bidding-information-facade.php');
include realpath(__DIR__ . '/../models/purchase-order-facade.php');
include realpath(__DIR__ . '/../models/deliveries-facade.php');
include realpath(__DIR__ . '/../models/payment-facade.php');

$usersFacade = new UsersFacade;
$positionsFacade = new PositionsFacade;
$departmentsFacade = new DepartmentsFacade;
$servicesFacade = new ServicesFacade;
$municipalitiesFacade = new MunicipalitiesFacade;
$LGUFacade = new LGUFacade;
$projectTypeFacade = new ProjectTypeFacade;
$biddingInformationFacade = new BiddingInformationFacade;
$POFacade = new PurchaseOrderFacade;
$deliveriesFacade = new DeliveriesFacade;
$paymentFacade = new PaymentFacade;

$userId = 0;
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
}
if (isset($_SESSION["user_role"])) {
    $userRole = $_SESSION["user_role"];
}
if (isset($_SESSION["first_name"])) {
    $firstName = $_SESSION["first_name"];
}
if (isset($_SESSION["last_name"])) {
    $lastName = $_SESSION["last_name"];
}
if (isset($_SESSION["department"])) {
    $department = $_SESSION["department"];
}
if (isset($_SESSION["can_create"])) {
    $canCreate = $_SESSION["can_create"];
}
if (isset($_SESSION["can_update"])) {
    $canUpdate = $_SESSION["can_update"];
}
if (isset($_SESSION["can_delete"])) {
    $canDelete = $_SESSION["can_delete"];
}
if (isset($_GET["is_updated"])) {
    $paymentId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["full_payment"])) {
    $BMNumber = $_POST["bm_no"];
    $paymentId = $_POST["payment_id"];
    $PONumber =  $_POST["po_number"];
    $paymentMode = 'Full Payment';
    $billNumber = $_POST["bill_number"];
    $billDate = $_POST["bill_date"];
    $paymentDate = $_POST["payment_date"];
    $paymentAmount = $_POST["payment_amount"];
    $paymentReceiptNumber = $_POST["payment_receipt_number"];
    $isPaid = 1;

    $fullPayment = $paymentFacade->fullPayment($billNumber, $billDate, $paymentMode, $paymentDate, $paymentAmount, $paymentReceiptNumber, $paymentId, $isPaid);
    if ($fullPayment) {
        // Update delivery if payment is fully paid
        $deliveriesFacade->isPaid($BMNumber);
        $paymentFacade->isPaid($BMNumber);
        // Update total paid on bidding information
        $remainingBalance = $paymentAmount;
        $updateTotalPaid = $biddingInformationFacade->updateTotalPaid($remainingBalance, $BMNumber);
        header("Location: payments?delete_msg=Payment has been updated successfully!");
    }
}

?>