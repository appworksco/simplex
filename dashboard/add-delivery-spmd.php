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
    $deliveryId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_delivery_spmd"])) {
    $projectName = $_POST["project_name_spmd"];
    $BMNumber = $_POST["bm_no_spmd"];
    $projectTypeId = $_POST["project_type_id_spmd"];
    $LGUId = $_POST["lgu_id_spmd"];
    $PONumber = $_POST["po_number_spmd"];
    $DRNumber = $_POST["dr_number_spmd"];
    $DRDate = $_POST["dr_date_spmd"];
    $totalQuantity = $_POST["total_quantity_spmd"];
    $totalAmount = $_POST["total_amount_spmd"];
    $billQuantity = $totalQuantity;
    $billAmount = $totalAmount;
    $remainingBalance = $totalAmount;

    $verifyDeliveryByName = $deliveriesFacade->verifyDeliveryByName($projectName);
    $addDelivery = $deliveriesFacade->addDelivery($projectName, $BMNumber, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount);
    if ($addDelivery) {
        array_push($success, 'Delivery has been added successfully');
        // Add payment when delivery is added
        $paymentFacade->addPayment($projectName, $BMNumber, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $billQuantity, $billAmount, $remainingBalance);
        $POFacade->isDelivered($PONumber);
        // Add total delivered in bidding information
        $updateTotalDelivered = $biddingInformationFacade->updateTotalDelivered($totalQuantity, $BMNumber);
        header("Location: deliveries?delete_msg=Delivery has been added successfully!");
    }
}