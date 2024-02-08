<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/project-type-facade.php');

$projectTypeFacade = new ProjectTypeFacade;

if (isset($_GET["project_type_id"])) {
    $projectTypeId = $_GET["project_type_id"];
    $deleteProjectType = $projectTypeFacade->deleteProjectType($projectTypeId);
    if ($deleteProjectType) {
        header("Location: project-type?delete_msg=Project Type has been deleted successfully!");
    }
}