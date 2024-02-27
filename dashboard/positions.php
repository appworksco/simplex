<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');

$departmentsFacade = new DepartmentsFacade;
$positionsFacade = new PositionsFacade;

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
    $positionId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_position"])) {
    $positionName = $_POST["position_name"];
    $positionCode = $_POST["position_code"];

    if (empty($positionName)) {
        array_push($invalid, 'Position Name should not be empty.');
    }
    if (empty($positionCode)) {
        array_push($invalid, 'Position Code should not be empty.');
    } else {
        $verifyPositionCode = $positionsFacade->verifyPositionCode($positionCode);
        if ($verifyPositionCode > 0) {
            array_push($invalid, 'Position has already been added.');
        } else {
            $addPosition = $positionsFacade->addPosition($positionName, $positionCode);
            if ($addPosition) {
                array_push($success, 'Position has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_position"])) {
    $positionId = $_POST["position_id"];
    $positionName = $_POST["position_name"];
    $positionCode = $_POST["position_code"];

    if (empty($positionName)) {
        array_push($invalid, 'Position Name should not be empty.');
    }
    if (empty($positionCode)) {
        array_push($invalid, 'Position Code should not be empty.');
    } else {
        $updatePosition = $positionsFacade->updatePosition($positionName, $positionCode, $positionId);
        if ($updatePosition) {
            array_push($success, 'Position has been updated successfully');
        }
    }
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100 mb-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Manage Positions</h5>
                <!-- Administrator View Start -->
                <?php if ($userRole == 1) { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPositionModal">Add Position</button>
                <?php } ?>
            </div>
            <div class="py-2">
                <?php include('../errors.php') ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped data-table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <?php if ($userRole == 1) { ?>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Position Code</h6>
                                </th>
                            <?php } ?>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Position Name</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchPositions = $positionsFacade->FetchPositions();
                        while ($row = $fetchPositions->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <?php if ($userRole == 1) { ?>
                                    <td class="border-bottom-0">
                                        <a href="positions?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                        <a href="delete-position?position_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this position?');">Delete</a>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $row["position_code"] ?></p>
                                    </td>
                                <?php } ?>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["position_name"] ?></p>
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

<?php include realpath(__DIR__ . '/../includes/modals/add-position-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-position-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $positionId = $_GET["is_updated"];
    if ($positionId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updatePositionModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>