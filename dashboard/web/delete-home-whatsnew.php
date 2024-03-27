<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["home_whatsnew_id"])) {
    $homeWhatsnewId = $_GET["home_whatsnew_id"];
    
    // Kunin ang detalye ng home carousel item
    $whatsnewDetails = $webFacade->getHomeWhatsnewDetails($homeWhatsnewId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($whatsnewDetails) {
        // Buraing ang entry sa database
        $deleteHomeWhatsnew = $webFacade->deleteHomeWhatsnew($homeWhatsnewId);
        
        // Buraing ang file sa storage
        $fileToDelete = $whatsnewDetails['image'];
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
        
        if ($deleteHomeWhatsnew) {
            header("Location: home-whatsnew?delete_msg=it has been deleted successfully!");
            exit();
        }
    }
}