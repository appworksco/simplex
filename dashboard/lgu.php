<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');
include realpath(__DIR__ . '/../models/municipalities-facade.php');
include realpath(__DIR__ . '/../models/lgu-facade.php');

$usersFacade = new UsersFacade;
$positionsFacade = new PositionsFacade;
$departmentsFacade = new DepartmentsFacade;
$servicesFacade = new ServicesFacade;
$municipalitiesFacade = new MunicipalitiesFacade;
$LGUFacade = new LGUFacade;

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
    $LGUId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_lgu"])) {
    $LGUCode = $_POST["lgu_code"];
    $LGUName = $_POST["lgu_name"];
    $municipalityId = $_POST["municipality_id"];

    if (empty($LGUCode)) {
        array_push($invalid, 'LGU Code should not be empty.');
    }
    if (empty($LGUName)) {
        array_push($invalid, 'LGU Name should not be empty.');
    } else {
        $verifyLGUCodeName = $LGUFacade->verifyLGU($LGUCode, $LGUName);
        if ($verifyLGUCodeName > 0) {
            array_push($invalid, 'LGU has already been added.');
        } else {
            $addLGU = $LGUFacade->addLGU($LGUCode, $LGUName, $municipalityId);
            if ($addLGU) {
                array_push($success, 'LGU has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_lgu"])) {
    $LGUId = $_POST["lgu_id"];
    $LGUCode = $_POST["lgu_code"];
    $LGUName = $_POST["lgu_name"];
    $municipalityId = $_POST["municipality_id"];

    if (empty($LGUCode)) {
        array_push($invalid, 'LGU Code should not be empty.');
    }
    if (empty($LGUName)) {
        array_push($invalid, 'LGU Name should not be empty.');
    } else {
        $updateLGU = $LGUFacade->updateLGU($LGUCode, $LGUName, $municipalityId, $LGUId);
        if ($updateLGU) {
            array_push($success, 'LGU has been updated successfully');
        }
    }
}

?>

<!-- Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Overview</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLGUModal">Add LGU</button>
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
                                <h6 class="fw-semibold mb-0">LGU Code</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">LGU Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Municipality</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchLGU = $LGUFacade->fetchLGU();
                        while ($row = $fetchLGU->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <a href="lgu?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                    <a href="delete-lgu?lgu_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this municipality?');">Delete</a>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["lgu_code"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["lgu_name"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <?php
                                    $municipalityId = $row["municipality_id"];
                                    $fetchMunicipalityById = $municipalitiesFacade->fetchMunicipalityById($municipalityId);
                                    while ($municipality =  $fetchMunicipalityById->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <p class="mb-0 fw-normal"><?= $municipality["municipality_name"] ?></p>
                                    <?php }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper End -->

<?php include realpath(__DIR__ . '/../includes/modals/add-lgu-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-lgu-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $LGUId = $_GET["is_updated"];
    if ($LGUId) {
        echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#updateLGUModal").modal("show");
            });
        </script>';
    } else {
    }
}
?>