<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/departments-facade.php');

$departmentsFacade = new DepartmentsFacade;

if (isset($_GET["department_id"])) {
    $departmentId = $_GET["department_id"];
    $deleteDepartment = $departmentsFacade->deleteDepartment($departmentId);
    if ($deleteDepartment) {
        header("Location: departments?delete_msg=Department has been deleted successfully!");
    }
}