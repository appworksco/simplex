<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["events_upcoming_id"])) {
    $eventsUpcomingId = $_GET["events_upcoming_id"];
    
    $upcomingDetails = $webFacade->getEventsUpcomingDetails($eventsUpcomingId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($upcomingDetails) {
        
        $deleteEventsUpcoming = $webFacade->deleteEventsUpcoming($eventsUpcomingId);
        
        // Buraing ang file sa storage
        $fileToDelete = $upcomingDetails['image'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
        
        if ($deleteHomeWhatsnew) {
            header("Location: events-upcoming?delete_msg=it has been deleted successfully!");
            exit();
        }
    }
}