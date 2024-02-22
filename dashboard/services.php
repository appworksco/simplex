<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');

$positionsFacade = new PositionsFacade;
$servicesFacade = new ServicesFacade;

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
    $serviceId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_service"])) {
    $serviceName = $_POST["service_name"];
    $serviceCode = $_POST["service_code"];

    if (empty($serviceName)) {
        array_push($invalid, 'Service Name should not be empty.');
    }
    if (empty($serviceCode)) {
        array_push($invalid, 'Service Code should not be empty.');
    } else {
        $verifyServiceCode = $servicesFacade->verifyServiceCode($serviceCode);
        if ($verifyServiceCode > 0) {
            array_push($invalid, 'Service has already been added.');
        } else {
            $addService = $servicesFacade->addService($serviceName, $serviceCode);
            if ($addService) {
                array_push($success, 'Service has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_service"])) {
    $serviceId = $_POST["service_id"];
    $serviceName = $_POST["service_name"];
    $serviceCode = $_POST["service_code"];

    if (empty($serviceName)) {
        array_push($invalid, 'Service Name should not be empty.');
    }
    if (empty($serviceCode)) {
        array_push($invalid, 'Service Code should not be empty.');
    } else {
        $updateService = $servicesFacade->updateService($serviceName, $serviceCode, $serviceId);
        if ($updateService) {
            array_push($success, 'Service has been updated successfully');
        }
    }
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Manage Services</h5>
                <!-- Administrator View Start -->
                <?php if ($userRole == 1) { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Service</button>
                <?php } ?>
            </div>
            <div class="py-2">
                <?php include('../errors.php') ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <?php if ($userRole == 1) { ?>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Services Code</h6>
                                </th>
                            <?php } ?>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Services Name</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchServices = $servicesFacade->FetchServices();
                        while ($row = $fetchServices->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <?php if ($userRole == 1) { ?>
                                    <td class="border-bottom-0">
                                        <a href="services?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                        <a href="delete-service?service_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $row["service_code"] ?></p>
                                    </td>
                                <?php } ?>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["service_name"] ?></p>
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

<?php include realpath(__DIR__ . '/../includes/modals/add-service-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-service-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $serviceId = $_GET["is_updated"];
    if ($serviceId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateServiceModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>