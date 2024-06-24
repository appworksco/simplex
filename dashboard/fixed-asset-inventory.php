<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/assets-facade.php');

$usersFacade = new UsersFacade;
$departmentsFacade = new DepartmentsFacade;
$assetsFacade = new AssetsFacade;

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

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_asset"])) {
    $employee = strtoupper($_POST["employee"]);
    $empDepartment = $_POST["department"];
    $assetName = strtoupper($_POST["asset_name"]);
    $description = strtoupper($_POST["description"]);
    $quantity = $_POST["qty"];
    $condition = $_POST["condition"];
    $remarks = $_POST["remarks"];
    $series = $_POST["barcode"] + 1;
    $barcode = date('Y') . '-' . sprintf('%08d', $series);
    $updatedSeries = sprintf('%08d', $series);
    $addedBy = strtoupper($_POST["added_by"]);
    $addedOn = strtoupper($_POST["added_on"]);

    if (empty($employee)) {
        array_push($invalid, 'Employee should not be empty.');
    }
    if (empty($assetName)) {
        array_push($invalid, 'Name of Item / Asset should not be empty.');
    }
    if (empty($description)) {
        array_push($invalid, 'Description should not be empty.');
    }
    if (empty($quantity)) {
        array_push($invalid, 'Quantity should not be empty.');
    } else {
        $addAsset = $assetsFacade->addAsset($employee, $empDepartment, $assetName, $description, $quantity, $condition, $remarks, $barcode, $addedBy, $addedOn);
        if ($addAsset) {
            $updateSeries = $assetsFacade->updateSeries($updatedSeries);
            array_push($success, 'Asset has been added successfully');
        }
    }
}

?>

<style>
    body {
        overflow-x: hidden;
    }
</style>

<!--  Body Wrapper -->
<div class="body-wrapper">
    <div class="container-fluid" style="padding: 0 !important;">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100 m-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-semibold my-2">Overview</h5>
                            <div class="d-flex">
                                <!-- ICT View Start -->
                                <?php if ($department == 'ICT') { ?>
                                    <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#addAssetModal">Add Asset</button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="py-2">
                            <?php include('../errors.php') ?>
                        </div>
                        <div class="table-responsive" style="height: 650px; overflow: hidden">
                            <iframe src="./asset-overview.php" class="w-100" height="100%"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/../includes/modals/add-asset-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_submitted"])) {
    $isSubmitted = $_GET["is_submitted"];
    if ($isSubmitted == 1) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#addAssetModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>