<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');
include realpath(__DIR__ . '/../models/municipalities-facade.php');
include realpath(__DIR__ . '/../models/project-type-facade.php');

$usersFacade = new UsersFacade;
$positionsFacade = new PositionsFacade;
$departmentsFacade = new DepartmentsFacade;
$servicesFacade = new ServicesFacade;
$municipalitiesFacade = new MunicipalitiesFacade;
$projectTypeFacade = new ProjectTypeFacade;

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
    $projectTypeId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_project_type"])) {
    $projectTypeCode = $_POST["project_type_code"];
    $projectDescription = $_POST["project_description"];
    $projectDetails = $_POST["project_details"];

    if (empty($projectTypeCode)) {
        array_push($invalid, 'Project Type Code should not be empty.');
    }
    if (empty($projectDescription)) {
        array_push($invalid, 'Project Description should not be empty.');
    }
    if (empty($projectDetails)) {
        array_push($invalid, 'Project Details should not be empty.');
    } else {
        $verifyProjectTypeCode = $projectTypeFacade->verifyProjectTypeCode($projectTypeCode);
        if ($verifyProjectTypeCode > 0) {
            array_push($invalid, 'Project Type has already been added.');
        } else {
            $addProjectType = $projectTypeFacade->addProjectType($projectTypeCode, $projectDescription, $projectDetails);
            if ($addProjectType) {
                array_push($success, 'Project Type has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_project_type"])) {
    $projectTypeId = $_POST["project_type_id"];
    $projectTypeCode = $_POST["project_type_code"];
    $projectDescription = $_POST["project_description"];
    $projectDetails = $_POST["project_details"];

    if (empty($projectTypeCode)) {
        array_push($invalid, 'Project Type Code should not be empty.');
    }
    if (empty($projectDescription)) {
        array_push($invalid, 'Project Description should not be empty.');
    }
    if (empty($projectDetails)) {
        array_push($invalid, 'Project Details should not be empty.');
    } else {
        $updateProjectType = $projectTypeFacade->updateProjectType($projectTypeCode, $projectDescription, $projectDetails, $projectTypeId);
        if ($updateProjectType) {
            array_push($success, 'Project Type has been updated successfully');
        }
    }
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Manage Project Type</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectTypeModal">Add Project Type</button>
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
                                <h6 class="fw-semibold mb-0">Project Type Code</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Description</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Details</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchProjectType = $projectTypeFacade->fetchProjectType();
                        while ($row = $fetchProjectType->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <a href="project-type?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                    <a href="delete-project-type?project_type_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project type?');">Delete</a>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["project_type_code"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["project_description"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["project_details"] ?></p>
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

<?php include realpath(__DIR__ . '/../includes/modals/add-project-type-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-project-type-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $projectTypeId = $_GET["is_updated"];
    if ($projectTypeId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateProjectTypeModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>