<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/positions-facade.php');

$positionsFacade = new PositionsFacade;

if (isset($_GET["position_id"])) {
    $positionId = $_GET["position_id"];
    $deletePosition = $positionsFacade->deletePosition($positionId);
    if ($deletePosition) {
        header("Location: positions?delete_msg=Position has been deleted successfully!");
    }
}