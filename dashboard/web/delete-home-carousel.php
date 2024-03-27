<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["home_carousel_id"])) {
    $homeCarouselId = $_GET["home_carousel_id"];
    
    // Kunin ang detalye ng home carousel item
    $carouselDetails = $webFacade->getHomeCarouselDetails($homeCarouselId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($carouselDetails) {
        // Buraing ang entry sa database
        $deleteHomeCarousel = $webFacade->deleteHomeCarousel($homeCarouselId);
        
        // Buraing ang file sa storage
        $fileToDelete = $carouselDetails['image'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
        
        if ($deleteHomeCarousel) {
            header("Location: home-carousel?delete_msg=it has been deleted successfully!");
            exit();
        }
    }
}