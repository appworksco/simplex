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

$usersFacade = new UsersFacade;
$positionsFacade = new PositionsFacade;
$departmentsFacade = new DepartmentsFacade;
$servicesFacade = new ServicesFacade;
$municipalitiesFacade = new MunicipalitiesFacade;
$LGUFacade = new LGUFacade;
$projectTypeFacade = new ProjectTypeFacade;
$biddingInformationFacade = new BiddingInformationFacade;

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

if (isset($_POST["add_bidding"])) {
    $biddingDate = $_POST["bidding_date"];
    $projectName = $_POST["project_name"];
    $projectTypeId = $_POST["project_type_id"];
    $LGUId = $_POST["lgu_id"];
    $fetchProjectTypeById = $projectTypeFacade->fetchProjectTypeById($projectTypeId);
    while ($row = $fetchProjectTypeById->fetch(PDO::FETCH_ASSOC)) {
        $projectType = $row["project_description"];
        // Get latest project series
        $getProjectSeries = $projectTypeFacade->getProjectSeries();
        foreach ($getProjectSeries as $series) {
            $series = $series["series"];
        }
        $bmno = 'BM' . date('Y') . $series;
        $addBidding = $biddingInformationFacade->addBidding($bmno, $projectName, $biddingDate, $projectTypeId, $LGUId);
        if ($addBidding) {
            array_push($success, 'Bidding has been added successfully');
            // Update latest project series
            $projectTypeFacade->updateProjectSeries();
        }
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
    $totalSKUQuantity = $_POST["total_sku_quantity"];
    $awardDate = $_POST["award_date"];
    $deliveryTargetMonth = $_POST["delivery_target_month"];
    $remarks = $_POST["remarks"];

    $updateBidding = $biddingInformationFacade->updateBidding($biddingDate, $projectName, $projectTypeId, $LGUId, $projectStatus, $paymentStructure, $projectBudgetAmount, $totalSKUQuantity, $awardDate, $deliveryTargetMonth, $remarks, $biddingId);
    if ($updateBidding) {
        array_push($success, 'Bidding has been updated successfully');
    }
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Bidding Information and Monitoring</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBiddingModal">Add Bidding</button>
            </div>
            <div class="py-2">
                <?php include('../errors.php') ?>
            </div>
            <div class="table-responsive">
                <table class="table data-table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">BMNO</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Bidding Date</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Type</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">LGU Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Budget Amount</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Delivery Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Payment Status</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchBiddingInformation = $biddingInformationFacade->fetchBiddingInformation();
                        while ($row = $fetchBiddingInformation->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <a href="bidding-information?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                    <a href="delete-bidding-information?bidding_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this bidding?');">Delete</a>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["bm_no"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["bid_date"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["project_status"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["project_name"] ?></p>
                                </td>
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
                                    <?php
                                    $LGUId = $row["lgu_id"];
                                    $fetchLGUById = $LGUFacade->fetchLGUById($LGUId);
                                    while ($LGU =  $fetchLGUById->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <p class="mb-0 fw-normal"><?= $LGU["lgu_name"] ?></p>
                                    <?php }
                                    ?>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["project_budget_amount"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">
                                        <?php
                                        $totalSKUQuantity = $row["total_sku_quantity"];
                                        $totalDelivered = $row["total_delivered"];

                                        if ($totalDelivered == 0) {
                                            echo '0%';
                                        } else {
                                            $percentage = (($totalSKUQuantity + $totalDelivered) / $totalSKUQuantity) * 100 - 100;
                                            echo $percentage . '%';
                                        }
                                        ?>
                                    </p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">
                                        <?php
                                        $projectBudgetAmount = $row["project_budget_amount"];
                                        $totalPaid = $row["total_paid"];

                                        if ($totalPaid == 0) {
                                            echo '0%';
                                        } else {
                                            $percentage = (($projectBudgetAmount + $totalPaid) / $projectBudgetAmount) * 100 - 100;
                                            echo $percentage . '%';
                                        }
                                        ?>
                                    </p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--  Content Wrapper End -->

<?php include realpath(__DIR__ . '/../includes/modals/add-bidding-modal.php') ?>
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