<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/issues-facade.php');

$issuesFacade = new IssuesFacade;

if (isset($_GET["issue_id"])) {
    $issueId = $_GET["issue_id"];
    $deleteIssue = $issuesFacade->deleteIssue($issueId);
    if ($deleteIssue) {
        header("Location: issues?delete_msg=Issue has been deleted successfully!");
    }
}