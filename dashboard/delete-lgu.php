<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/lgu-facade.php');

$LGUFacade = new LGUFacade;

if (isset($_GET["lgu_id"])) {
    $LGUId = $_GET["lgu_id"];
    $deleteLGU = $LGUFacade->deleteLGU($LGUId);
    if ($deleteLGU) {
        header("Location: lgu?delete_msg=LGU has been deleted successfully!");
    }
}