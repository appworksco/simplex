<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["home_partners_id"])) {
    $homePartnersId = $_GET["home_partners_id"];
    
    // Kunin ang detalye ng home carousel item
    $partnersDetails = $webFacade->getHomePartnersDetails($homePartnersId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($partnersDetails) {
        
        $deleteHomePartners = $webFacade->deleteHomePartners($homePartnersId);
        
        // Buraing ang file sa storage
        $fileToDelete = $partnersDetails['image'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
        
        if ($deleteHomePartners) {
            header("Location: home-partners?delete_msg=it has been deleted successfully!");
            exit();
        }
    }
}