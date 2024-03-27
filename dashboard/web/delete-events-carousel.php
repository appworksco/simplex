<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["events_carousel_id"])) {
    $eventsCarouselId = $_GET["events_carousel_id"];
    
    // Kunin ang detalye ng home carousel item
    $carouselDetails = $webFacade->getEventsCarouselDetails($eventsCarouselId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($carouselDetails) {
        // Buraing ang entry sa database
        $deleteEventsCarousel = $webFacade->deleteEventsCarousel($eventsCarouselId);
        
        $fileToDelete = $carouselDetails['image'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
        
        if ($deleteEventsCarousel) {
            header("Location: events-carousel?delete_msg=it has been deleted successfully!");
            exit();
        }
    }
}