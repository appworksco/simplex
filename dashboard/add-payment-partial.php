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

if (isset($_POST["partial_payment"])) {
    $BMNumber = $_POST["bm_no"];
    $paymentId = $_POST["payment_id"];
    $PONumber =  $_POST["po_number"];

    // 1st payment
    $oneBillNumber = $_POST["1st_bill_number"];
    $onePaymentMode = $_POST["1st_payment_mode"];
    $onePaymentDate = $_POST["1st_payment_date"];
    $onePaymentAmount = $_POST["1st_payment_amount"];
    $onePaymentReceiptNumber = $_POST["1st_payment_receipt_number"];

    // 2nd payment
    $twoBillNumber = $_POST["2nd_bill_number"];
    $twoPaymentMode = $_POST["2nd_payment_mode"];
    $twoPaymentDate = $_POST["2nd_payment_date"];
    $twoPaymentAmount = $_POST["2nd_payment_amount"];
    $twoPaymentReceiptNumber = $_POST["2nd_payment_receipt_number"];

    // 2nd payment
    $twoBillNumber = $_POST["2nd_bill_number"];
    $twoPaymentMode = $_POST["2nd_payment_mode"];
    $twoPaymentDate = $_POST["2nd_payment_date"];
    $twoPaymentAmount = $_POST["2nd_payment_amount"];
    $twoPaymentReceiptNumber = $_POST["2nd_payment_receipt_number"];

    // 3rd payment
    $threeBillNumber = $_POST["3rd_bill_number"];
    $threePaymentMode = $_POST["3rd_payment_mode"];
    $threePaymentDate = $_POST["3rd_payment_date"];
    $threePaymentAmount = $_POST["3rd_payment_amount"];
    $threePaymentReceiptNumber = $_POST["3rd_payment_receipt_number"];

    // 4th payment
    $fourBillNumber = $_POST["4th_bill_number"];
    $fourPaymentMode = $_POST["4th_payment_mode"];
    $fourPaymentDate = $_POST["4th_payment_date"];
    $fourPaymentAmount = $_POST["4th_payment_amount"];
    $fourPaymentReceiptNumber = $_POST["4th_payment_receipt_number"];

    // 5th payment
    $fiveBillNumber = $_POST["5th_bill_number"];
    $fivePaymentMode = $_POST["5th_payment_mode"];
    $fivePaymentDate = $_POST["5th_payment_date"];
    $fivePaymentAmount = $_POST["5th_payment_amount"];
    $fivePaymentReceiptNumber = $_POST["5th_payment_receipt_number"];

    $fPayment = $onePaymentAmount;
    $sPayment = $twoPaymentAmount;
    $tPayment = $threePaymentAmount;
    $foPayment = $fourPaymentAmount;
    $fiPayment = $fivePaymentAmount;

    $totalPaid = $fPayment + $sPayment + $tPayment + $foPayment + $fiPayment;

    // Verify payment to PO total amount if exact
    $fetchPOByPONumber = $POFacade->fetchPOByPONumber($PONumber);
    while ($row = $fetchPOByPONumber->fetch(PDO::FETCH_ASSOC)) {
        // Check total amount and total paid if greater than then set delivery and payment to delivered and paid if not insert data
        if ($row["total_amount"] <= $totalPaid) {
            // Update delivery if payment is fully paid
            $deliveriesFacade->isPaid($BMNumber);
            $paymentFacade->isPaid($BMNumber);
        }
        if ($row["total_amount"] >= $totalPaid) {
            $remainingBalance = $row["total_amount"] - $totalPaid;
            $partialPayment = $paymentFacade->partialPayment($remainingBalance, $oneBillNumber, $onePaymentMode, $onePaymentDate, $onePaymentAmount, $onePaymentReceiptNumber, $twoBillNumber, $twoPaymentMode, $twoPaymentDate, $twoPaymentAmount, $twoPaymentReceiptNumber, $threeBillNumber, $threePaymentMode, $threePaymentDate, $threePaymentAmount, $threePaymentReceiptNumber, $fourBillNumber, $fourPaymentMode, $fourPaymentDate, $fourPaymentAmount, $fourPaymentReceiptNumber, $fiveBillNumber, $fivePaymentMode, $fivePaymentDate, $fivePaymentAmount, $fivePaymentReceiptNumber, $paymentId);
            if ($partialPayment) {
                array_push($success, 'Bidding has been updated successfully');
                // Update total paid on bidding information
                $updateTotalPaid = $biddingInformationFacade->updateTotalPaidPartial($totalPaid, $BMNumber);
            }
        }
    }
}

?>