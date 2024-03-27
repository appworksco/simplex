<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["events_pics_id"])) {
    $eventsPicsId = $_GET["events_pics_id"];
    
    $picsDetails = $webFacade->getEventsPicsDetails($eventsPicsId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($picsDetails) {
        
        $deleteEventsPics = $webFacade->deleteEventsPics($eventsPicsId);
        
        $fileToDelete = $picsDetails['image'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
        
        if ($deleteEventsPics) {
            header("Location: events-pics?delete_msg=it has been deleted successfully!");
            exit();
        }
    }
}