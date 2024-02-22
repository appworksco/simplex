<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/departments-facade.php');

$departmentsFacade = new DepartmentsFacade;

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
    $departmentId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_department"])) {
    $departmentName = $_POST["department_name"];
    $departmentCode = $_POST["department_code"];

    if (empty($departmentName)) {
        array_push($invalid, 'Department Name should not be empty.');
    }
    if (empty($departmentCode)) {
        array_push($invalid, 'Department Code should not be empty.');
    } else {
        $verifyDepartmentCode = $departmentsFacade->verifyDepartmentCode($departmentCode);
        if ($verifyDepartmentCode > 0) {
            array_push($invalid, 'Department has already been added.');
        } else {
            $addDepartment = $departmentsFacade->addDepartment($departmentName, $departmentCode);
            if ($addDepartment) {
                array_push($success, 'Department has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_department"])) {
    $departmentId = $_POST["department_id"];
    $departmentName = $_POST["department_name"];
    $departmentCode = $_POST["department_code"];

    if (empty($departmentName)) {
        array_push($invalid, 'Department Name should not be empty.');
    }
    if (empty($departmentCode)) {
        array_push($invalid, 'Department Code should not be empty.');
    } else {
        $verifyDepartmentCode = $departmentsFacade->verifyDepartmentCode($departmentCode);
        if ($verifyDepartmentCode > 0) {
            array_push($invalid, 'Department has already been added.');
        } else {
            $updateDepartment = $departmentsFacade->updateDepartment($departmentName, $departmentCode, $departmentId);
            if ($updateDepartment) {
                array_push($success, 'Department has been updated successfully');
            }
        }
    }
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100 mb-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Manage Departments</h5>
                <!-- Administrator View Start -->
                <?php if ($userRole == 1) { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">Add Department</button>
                <?php } ?>
            </div>
            <div class="py-2">
                <?php include('../errors.php') ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-striped text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <?php if ($userRole == 1) { ?>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Department Code</h6>
                                </th>
                            <?php } ?>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Department Name</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchDepartments = $departmentsFacade->FetchDepartments();
                        while ($row = $fetchDepartments->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <?php if ($userRole == 1) { ?>
                                    <td class="border-bottom-0">
                                        <a href="departments?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                        <a href="delete-department?department_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $row["department_code"] ?></p>
                                    </td>
                                <?php } ?>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["department_name"] ?></p>
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

<!-- Footer Start -->
<?php include realpath(__DIR__ . '/../includes/modals/add-department-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-department-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $departmentId = $_GET["is_updated"];
    if ($departmentId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateDepartmentModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>
<!-- Footer End -->