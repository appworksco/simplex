<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["events_allpartners_id"])) {
    $eventsAllpartnersId = $_GET["events_allpartners_id"];
    
    $allpartnersDetails = $webFacade->getEventsAllpartnersDetails($eventsAllpartnersId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($allpartnersDetails) {
        
        $deleteEventsAllpartners = $webFacade->deleteEventsAllpartners($eventsAllpartnersId);
        
        $fileToDelete = $allpartnersDetails['image'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
        
        if ($deleteEventsPics) {
            header("Location: events-allpartners?delete_msg=it has been deleted successfully!");
            exit();
        }
    }
}