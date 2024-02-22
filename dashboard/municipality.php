<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');
include realpath(__DIR__ . '/../models/municipalities-facade.php');

$usersFacade = new UsersFacade;
$positionsFacade = new PositionsFacade;
$departmentsFacade = new DepartmentsFacade;
$servicesFacade = new ServicesFacade;
$municipalitiesFacade = new MunicipalitiesFacade;

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
    $municipalityId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_municipality"])) {
    $municipalityName = $_POST["municipality_name"];
    $address = $_POST["address"];

    if (empty($municipalityName)) {
        array_push($invalid, 'Municipality Name should not be empty.');
    }
    if (empty($address)) {
        array_push($invalid, 'Address should not be empty.');
    } else {
        $verifyMunicipalityName = $municipalitiesFacade->verifyMunicipalityName($municipalityName);
        if ($verifyMunicipalityName > 0) {
            array_push($invalid, 'Municipality has already been added.');
        } else {
            $addMunicipality = $municipalitiesFacade->addMunicipality($municipalityName, $address);
            if ($addMunicipality) {
                array_push($success, 'Municipality has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_municipality"])) {
    $municipalityId = $_POST["municipality_id"];
    $municipalityName = $_POST["municipality_name"];
    $address = $_POST["address"];

    if (empty($municipalityName)) {
        array_push($invalid, 'Municipality Name should not be empty.');
    }
    if (empty($address)) {
        array_push($invalid, 'Address should not be empty.');
    } else {
        $updateMunicipality = $municipalitiesFacade->updateMunicipality($municipalityName, $address, $municipalityId);
        if ($updateMunicipality) {
            array_push($success, 'Municipality has been updated successfully');
        }
    }
}

?>

<!-- Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Manage Municipality</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMunicipalityModal">Add Municipality</button>
            </div>
            <div class="py-2">
                <?php include('../errors.php') ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped data-table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Municipality</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Address</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchMunicipalities = $municipalitiesFacade->fetchMunicipalities();
                        while ($row = $fetchMunicipalities->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <a href="municipality?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                    <a href="delete-municipality?municipality_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this municipality?');">Delete</a>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["municipality_name"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["address"] ?></p>
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

<?php include realpath(__DIR__ . '/../includes/modals/add-municipality-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-municipality-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $municipalityId = $_GET["is_updated"];
    if ($municipalityId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateMunicipalityModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>