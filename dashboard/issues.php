<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');
include realpath(__DIR__ . '/../models/issues-facade.php');

$positionsFacade = new PositionsFacade;
$servicesFacade = new ServicesFacade;
$issuesFacade = new IssuesFacade;

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
    $issueId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_issue"])) {
    $issue = $_POST["issue"];

    if (empty($issue)) {
        array_push($invalid, 'Issue should not be empty.');
    } else {
        $verifyIssue = $issuesFacade->verifyIssue($issue);
        if ($verifyIssue > 0) {
            array_push($invalid, 'Issue has already been added.');
        } else {
            $addIssue = $issuesFacade->addIssue($issue);
            if ($addIssue) {
                array_push($success, 'Issue has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_issue"])) {
    $issueId = $_POST["issue_id"];
    $issue = $_POST["issue"];

    if (empty($issue)) {
        array_push($invalid, 'Issue should not be empty.');
    } else {
        $updateIssue = $issuesFacade->updateIssue($issue, $issueId);
        if ($updateIssue) {
            array_push($success, 'Issue has been updated successfully');
        }
    }
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Manage Issues</h5>
                <!-- Administrator View Start -->
                <?php if ($userRole == 1) { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addIssueModal">Add Issue</button>
                <?php } ?>
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
                                <h6 class="fw-semibold mb-0">Services Name</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchServices = $issuesFacade->fetchIssues();
                        while ($row = $fetchServices->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <a href="issues?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                    <a href="delete-issue?issue_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this issue?');">Delete</a>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["issue"] ?></p>
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

<?php include realpath(__DIR__ . '/../includes/modals/add-issue-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-issue-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $issueId = $_GET["is_updated"];
    if ($issueId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateIssueModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>