<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');
include realpath(__DIR__ . '/../models/issues-facade.php');
include realpath(__DIR__ . '/../models/cts-facade.php');

$positionsFacade = new PositionsFacade;
$servicesFacade = new ServicesFacade;
$issuesFacade = new IssuesFacade;
$ctsFacade = new CTSFacade;

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
    $ctsId = $_GET["is_updated"];
}
if (isset($_GET["is_show"])) {
    $ctsId = $_GET["is_show"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_ticket"])) {

    $firstName = $_SESSION["first_name"];
    $lastName = $_SESSION["last_name"];

    // Buo ng iba pang mga detalye para sa ticket
    $ticketNo = rand(00000000, 99999999);
    $created_at = date('Y-m-d H:i:s');
    $requestedBy = $firstName . ' ' . $lastName; // Pagbuo ng pangalan ng user

    $status = 'Pending';

    // Kunin ang mga detalye mula sa form
    $issue = $_POST["issue"];
    $description = $_POST["description"];
    $severity = $_POST["severity"];

    if (empty($description)) {
        array_push($invalid, 'Description should not be empty.');
    } else {
        // Idagdag ang ticket sa database
        $addTicket = $ctsFacade->addTicket($ticketNo, $created_at, $requestedBy, $department, $status, $issue, $description, $severity);
        if ($addTicket) {
            // Add Ticket log
            $logFilePath = "../log-file.txt"; // Gamitin ang ../ upang pumunta sa parent directory
            $logFile = fopen($logFilePath, "a") or die("Unable to open file!");
            $txt = date("m/d/Y h:i:sa") . " : " . $firstName . ' ' . $lastName . ' created a ticket number of "' . $ticketNo . '".' . "\n";
            fwrite($logFile, $txt);
            fclose($logFile);

            array_push($success, 'Ticket has been added successfully');
        }
    }
}

if (isset($_POST["update_ticket"])) {
    $ctsId = $_POST["cts_id"];
    $status = 'Done';
    $assistedBy = $firstName . ' ' . $lastName;
    $assistorsRemark = $_POST["assistors_remark"];
    $timeResolved = date('Y-m-d H:i:s');
    $ticket_no = $_POST["ticket_no"];

    if (empty($assistorsRemark)) {
        array_push($invalid, 'Comment should not be empty.');
    } else {
        $updateTicket = $ctsFacade->updateTicket($ctsId, $status, $assistedBy, $assistorsRemark, $timeResolved);
        if ($updateTicket) {

            // Update ticket log
            $logFilePath = "../log-file.txt"; // Gamitin ang ../ upang pumunta sa parent directory
            $logFile = fopen($logFilePath, "a") or die("Unable to open file!");
            $txt = date("m/d/Y h:i:sa") . " : " . $assistedBy . ' assisted a ticket number of "' . $ticket_no . '".' . "\n";
            fwrite($logFile, $txt);
            fclose($logFile);

            array_push($success, 'Ticket has been updated successfully');
        }
    }
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between">
            <h5 class="card-title fw-semibold my-2">Overview</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTicketModal">Add Ticket</button>
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
                            <h6 class="fw-semibold mb-0">Requested By</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Severity</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Ticket Date</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Time Requested</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fetchTickets = $ctsFacade->fetchTickets();
                    while ($row = $fetchTickets->fetch(PDO::FETCH_ASSOC)) {
                        // Check kung ang department ay ICT
                        if ($department == 'ICT') {
                    ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <a href="cts?is_show=<?= $row["id"] ?>" class="btn btn-sm btn-success">Details</a>
                                    <?php if ($row["status"] != 'Done' && $row["status"] != 'Undone') : ?>
                                        <a href="cts?is_updated=<?= $row["id"] ?>" class="btn btn-sm btn-info">Assist</a>
                                    <?php else : ?>
                                        <button class="btn btn-sm btn-default">Assisted</button>
                                    <?php endif; ?>
                                    <a href="cts" class="btn btn-sm btn-info">Chat</a>
                                    <a href="delete-ticket?cts_id=<?= $row["id"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ticket?');">Delete</a>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["requested_by"] ?> (<?= $row["department"] ?>)</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["severity"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= date('F j, Y', strtotime($row["created_at"])) ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= date('g:i A', strtotime($row["created_at"])) ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["status"] ?></p>
                                </td>
                            </tr>
                            <?php
                        } else {
                            // Check kung ang department ng ticket ay katulad ng department ng user
                            if ($department == $row["department"]) {
                            ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <a href="cts?is_show=<?= $row["id"] ?>" class="btn btn-sm btn-success">Details</a>
                                        <a href="cts" class="btn btn-sm btn-info">Chat</a>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $row["requested_by"] ?> (<?= $row["department"] ?>)</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $row["severity"] ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= date('F j, Y', strtotime($row["created_at"])) ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= date('g:i A', strtotime($row["created_at"])) ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $row["status"] ?></p>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    } // ends while loop
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/../includes/modals/add-ticket-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-ticket-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/view-ticket-details.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
if (isset($_GET["is_updated"])) {
    $ctsId = $_GET["is_updated"];
    if ($ctsId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateTicketModal").modal("show");
                });
            </script>';
    } else {
    }
}

if (isset($_GET["is_show"])) {
    $ctsId = $_GET["is_show"];
    if ($ctsId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#viewTicketDetails").modal("show");
                });
            </script>';
    } else {
    }
}
?>