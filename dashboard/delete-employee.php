<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');

$usersFacade = new UsersFacade;

if (isset($_GET["employee_id"])) {
    $employeeId = $_GET["employee_id"];
    $deleteEmployee = $usersFacade->deleteEmployee($employeeId);
    if ($deleteEmployee) {
        header("Location: employee?delete_msg=Employee has been deleted successfully!");
    }
}