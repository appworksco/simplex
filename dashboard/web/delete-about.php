<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["about_id"])) {
    $aboutId = $_GET["about_id"];
    
    $aboutDetails = $webFacade->getAboutDetails($aboutId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($aboutDetails) {
        
        $deleteAbout = $webFacade->deleteAbout($aboutId);
        
        header("Location: about?delete_msg=it has been deleted successfully!");
    }
}