<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/cts-facade.php');

$ctsFacade = new CTSFacade;

if (isset($_GET["cts_id"])) {
    $ctsId = $_GET["cts_id"];
    $deleteTicket = $ctsFacade->deleteTicket($ctsId);
    if ($deleteTicket) {
        header("Location: cts?delete_msg=Ticket has been deleted successfully!");
    }
}