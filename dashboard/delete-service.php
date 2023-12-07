<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/services-facade.php');

$servicesFacade = new ServicesFacade;

if (isset($_GET["service_id"])) {
    $serviceId = $_GET["service_id"];
    $deleteService = $servicesFacade->deleteService($serviceId);
    if ($deleteService) {
        header("Location: services?delete_msg=Service has been deleted successfully!");
    }
}