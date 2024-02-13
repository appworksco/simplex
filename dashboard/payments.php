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
if (isset($_GET["is_updated"])) {
    $biddingId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_payment"])) {
    $projectName = $_POST["project_name"];
    $projectTypeId = $_POST["project_type_id"];
    $LGUId = $_POST["lgu_id"];
    $PONumber = $_POST["po_number"];
    $DRNumber = $_POST["dr_number"];
    $DRDate = $_POST["dr_date"];
    $deliveredTotalQuantity = $_POST["delivered_total_quantity"];
    $deliveredTotalAmount = $_POST["delivered_total_amount"];
    $billNumber = $_POST["bill_number"];
    $billDate = $_POST["bill_date"];
    $billQuantity = $_POST["bill_quantity"];
    $billAmount = $_POST["bill_amount"];
    $paymentMode = $_POST["payment_mode"];
    $paymentDate = $_POST["payment_date"];
    $paymentAmount = $_POST["payment_amount"];
    $paymentReceiptNumber = $_POST["payment_receipt_number"];
    $partialBillNumber = $_POST["partial_bill_number"];
    $partialPaymentMode = $_POST["partial_payment_mode"];
    $partialPaymentDate = $_POST["partial_payment_date"];
    $partialPaymentAmount = $_POST["partial_payment_amount"];
    $partialPaymentReceiptNumber = $_POST["partial_payment_receipt_number"];

    $addPayment = $paymentFacade->addPayment($projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate,  $deliveredTotalQuantity, $deliveredTotalAmount, $billNumber, $billDate, $billQuantity, $billAmount, $paymentMode, $paymentDate, $paymentAmount, $paymentReceiptNumber, $partialBillNumber, $partialPaymentMode, $partialPaymentDate, $partialPaymentAmount, $partialPaymentReceiptNumber);
    if ($addPayment) {
        array_push($success, 'Payment has been added successfully');
    }
}

if (isset($_POST["update_bidding"])) {
    $biddingId = $_POST["bidding_id"];
    $biddingDate = $_POST["bidding_date"];
    $projectName = $_POST["project_name"];
    $projectTypeId = $_POST["project_type_id"];
    $LGUId = $_POST["lgu_id"];
    $projectStatus = $_POST["project_status"];
    $paymentStructure = $_POST["payment_structure"];
    $projectBudgetAmount = $_POST["project_budget_amount"];
    $awardDate = $_POST["award_date"];
    $deliveryTargetMonth = $_POST["delivery_target_month"];
    $remarks = $_POST["remarks"];

    $updateBidding = $biddingInformationFacade->updateBidding($biddingDate, $projectName, $projectTypeId, $LGUId, $projectStatus, $paymentStructure, $projectBudgetAmount, $awardDate, $deliveryTargetMonth, $remarks, $biddingId);
    if ($updateBidding) {
        array_push($success, 'Bidding has been updated successfully');
    }
}

?>

<style>
    body {
        opacity: 1;
        background-image: radial-gradient(#cdd9e7 1.05px, #e5e5f7 1.05px);
        background-size: 21px 21px;
    }

    .container {
        height: 100vh;
    }
</style>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index" class="text-nowrap logo-img">
                    <h3>One <span class="text-danger">Centro</span></h3>
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <?php include realpath(__DIR__ . '/../includes/layout/dashboard-sidebar.php') ?>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name=<?= $firstName . '+' . $lastName ?>&background=random" class="rounded-circle" width="35" height="35">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <a href="../logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--  Header End -->
        <div class="container-fluid">
            <!--  Row 1 -->
            <div class="row">
                <div class="col-lg-12 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-semibold my-2">Overview</h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentModal">Add Payment</button>
                            </div>
                            <div class="py-2">
                                <?php include('../errors.php') ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table data-table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Project Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Project Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">LGU Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">PO Number</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">DR Number</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">DR Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Delivered Total Quantity</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Delivered Total Amount</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Bill Number</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Bill Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Bill Quantity</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Bill Amount</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Payment Mode</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Payment Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Payment Amount</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Payment Receipt Number</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Partial Bill Number</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Partial Payment Mode</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Partial Payment Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Partial Payment Amount</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Partial Payment Receipt Number</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $fetchDeliveries = $paymentFacade->fetchPayments();
                                        while ($row = $fetchDeliveries->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <?php
                                                    $projectTypeId = $row["project_type_id"];
                                                    $fetchProjectTypeById = $projectTypeFacade->fetchProjectTypeById($projectTypeId);
                                                    while ($projectType = $fetchProjectTypeById->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <p class="mb-0 fw-normal"><?= $projectType["project_description"] ?></p>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["project_name"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <?php
                                                    $LGUId = $row["lgu_id"];
                                                    $fetchLGUById = $LGUFacade->fetchLGUById($LGUId);
                                                    while ($LGU =  $fetchLGUById->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <p class="mb-0 fw-normal"><?= $LGU["lgu_name"] ?></p>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["po_no"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["dr_no"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["dr_date"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["delivered_total_quantity"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["delivered_total_amount"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["bill_no"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["bill_date"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["bill_quantity"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["bill_amount"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["payment_mode"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["payment_date"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["payment_amount"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["payment_receipt_number"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["partial_bill_no"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["partial_payment_mode"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["partial_payment_date"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["partial_payment_amount"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["partial_payment_receipt_number"] ?></p>
                                                </td>
                                                <!-- <td class="border-bottom-0">
                                                    <a href="bidding-information?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                                </td> -->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Developed by: ICT Department</p>
            </div>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/../includes/modals/add-payment-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-bidding-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $biddingId = $_GET["is_updated"];
    if ($biddingId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateBiddingModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>

<script>
    function myFunction() {
        // Get the checkbox
        var checkBox = document.getElementById("isConverted");
        // Get the output text
        var remarks = document.getElementById("remarks");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true) {
            remarks.style.display = "block";
        } else {
            remarks.style.display = "none";
        }
    }
</script>