<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/municipalities-facade.php');

$municipalitiesFacade = new MunicipalitiesFacade;

if (isset($_GET["municipality_id"])) {
    $municipalityId = $_GET["municipality_id"];
    $deleteMunicipality = $municipalitiesFacade->deleteMunicipality($municipalityId);
    if ($deleteMunicipality) {
        header("Location: municipality?delete_msg=Municipality has been deleted successfully!");
    }
}