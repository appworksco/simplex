<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/departments-facade.php');

$departmentsFacade = new DepartmentsFacade;

if (isset($_GET["department_id"])) {
    $departmentId = $_GET["department_id"];
    $deletDepartment = $departmentsFacade->deleteDepartment($departmentId);
    if ($deletDepartment) {
        header("Location: departments?delete_msg=Department has been deleted successfully!");
    }
}