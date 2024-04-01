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

if (isset($_POST["add_delivery_mpsd"])) {
    $projectName = $_POST["project_name_mpsd"];
    $BMNumber = $_POST["bm_no_mpsd"];
    $projectTypeId = $_POST["project_type_id_mpsd"];
    $LGUId = $_POST["lgu_id_mpsd"];

    $onePONumber = $_POST["1st_po_number"];
    $onePOQuantity = $_POST["1st_total_quantity"];
    $onePOAmount = $_POST["1st_total_amount"];
    $twoPONumber = $_POST["2nd_po_number"];
    $twoPOQuantity = $_POST["2nd_total_quantity"];
    $twoPOAmount = $_POST["2nd_total_amount"];
    $threePONumber = $_POST["3rd_po_number"];
    $threePOQuantity = $_POST["3rd_total_quantity"];
    $threePOAmount = $_POST["3rd_total_amount"];
    $fourPONumber = $_POST["4th_po_number"];
    $fourPOQuantity = $_POST["4th_total_quantity"];
    $fourPOAmount = $_POST["4th_total_amount"];
    $fivePONumber = $_POST["5th_po_number"];
    $fivePOQuantity = $_POST["5th_total_quantity"];
    $fivePOAmount = $_POST["5th_total_amount"];

    if (
        $onePONumber == $twoPONumber ||
        $onePONumber == $threePONumber ||
        $onePONumber == $fourPONumber ||
        $onePONumber == $fivePONumber ||
        $twoPONumber == $onePOAmount ||
        $twoPONumber == $threePONumber ||
        $twoPONumber == $fourPONumber ||
        $twoPONumber == $fivePONumber ||
        $threePONumber == $onePONumber ||
        $threePONumber == $twoPONumber ||
        $threePONumber == $fourPONumber ||
        $threePONumber == $fivePONumber ||
        $fourPONumber == $onePONumber ||
        $fourPONumber == $twoPONumber ||
        $fourPONumber == $threePONumber ||
        $fourPONumber == $fivePONumber ||
        $fivePONumber == $onePONumber ||
        $fivePONumber == $twoPONumber ||
        $fivePONumber == $threePONumber ||
        $fivePONumber == $fourPONumber
    ) {
        array_push($invalid, 'PO Number should not be repeated!');
    } else {
        $PONumber = 0; // Set default value for this kind of transaction

        $DRNumber = $_POST["dr_number_mpsd"];
        $DRDate = $_POST["dr_date_mpsd"];

        $totalQuantity = $onePOQuantity + $twoPOQuantity + $threePOQuantity + $fourPOQuantity + $fivePOQuantity;
        $totalAmount = $onePOAmount + $twoPOAmount + $threePOAmount + $fourPOAmount + $fivePOAmount;
        $billQuantity = $totalQuantity;
        $billAmount = $totalAmount;
        $remainingBalance = $billAmount;

        $verifyDeliveryByName = $deliveriesFacade->verifyDeliveryByName($projectName);
        $addDelivery = $deliveriesFacade->addDeliveryMpsd($projectName, $BMNumber, $projectTypeId, $LGUId, $onePONumber, $onePOQuantity, $onePOAmount, $twoPONumber, $twoPOQuantity, $twoPOAmount, $threePONumber, $threePOQuantity, $threePOAmount, $fourPONumber, $fourPOQuantity, $fourPOAmount, $fivePONumber, $fivePOQuantity, $fivePOAmount, $DRNumber, $DRDate);
        if ($addDelivery) {
            array_push($success, 'Delivery has been added successfully');
            // Add payment when delivery is added
            $paymentFacade->addPayment($projectName, $BMNumber, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $billQuantity, $billAmount, $remainingBalance);
            // Add total delivered in bidding information
            $updateTotalDelivered = $biddingInformationFacade->updateTotalDelivered($totalQuantity, $BMNumber);
        }
    }
}
