<?php

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/users-facade.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

$careerItems = $webFacade->fetchCareer()->fetchAll(PDO::FETCH_ASSOC);

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
    $careerId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_career"])) {
    $jobPosition = $_POST["job_position"];
    $jobDescription = $_POST["job_description"];
    $jobRequirement = $_POST["job_requirement"];

    $webFacade = new WebFacade;
    $webFacade->addCareer($jobPosition, $jobDescription, $jobRequirement);

    header("Location: careers.php");
    exit();
}

if(isset($_POST['update_career'])) {
    $jobPosition = $_POST["job_position"];
    $jobDescription = $_POST["job_description"];
    $jobRequirement = $_POST["job_requirement"];
    $id = $_POST['itemId']; 

    $updateCareer = $webFacade->updateCareer($jobPosition, $jobDescription, $jobRequirement, $id);
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div>
                <a href="..\index.php" class="btn btn-sm btn-secondary">Back</a>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Manage Jobs</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCareer">Add</button>
            </div>
            <div class="py-2">
                <?php include('../../errors.php') ?>
            </div>
            <div class="table-responsive" style="background-color: #EAE194; padding: 20px; border: 1px solid #333;">
                <table class="table table-striped data-table text-nowrap mb-0 align-middle" id="careerTable" style="background-color: #AEC9DF;">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0" style="width: 20%;">
                                <h6 class="fw-semibold mb-0">Job Position</h6>
                            </th>
                            <th class="border-bottom-0" style="width: 40%;">
                                <h6 class="fw-semibold mb-0">Job Description</h6>
                            </th>
                            <th class="border-bottom-0" style="width: 30%;">
                                <h6 class="fw-semibold mb-0">Job Requirement</h6>
                            </th>
                            <th class="border-bottom-0" style="width: 10%;">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($careerItems as $item): ?>
                        <tr>
                            <td class="border-bottom-0" style="word-wrap: break-word;">
                                <p class="mb-0 fw-normal"><?php echo $item['job_position']; ?></p>
                            </td>
                            <td class="border-bottom-0" style="word-wrap: break-word;">
                                <p class="mb-0 fw-normal"><?php echo $item['job_description']; ?></p>
                            </td>
                            <td class="border-bottom-0" style="word-wrap: break-word;">
                                <p class="mb-0 fw-normal"><?php echo $item['job_requirement']; ?></p>
                            </td>
                            <td class="border-bottom-0">
                                <a href="careers?is_updated=<?= $item["id"] ?>" class="btn btn-sm btn-info">Update</a>
                                <a href="delete-career?career_id=<?= $item["id"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--  Content Wrapper End -->

<?php include realpath(__DIR__ . '/../../includes/modals/web/add-career.php') ?>
<?php include realpath(__DIR__ . '/../../includes/modals/web/update-career.php') ?>
<?php include realpath(__DIR__ . '/../../includes/layout/web-footer.php') ?>

<?php
if (isset($_GET["is_updated"])) {
    $careerId = $_GET["is_updated"];
    if ($careerId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateCareer").modal("show");
                });
            </script>';
    } else {
    }
}

?>
