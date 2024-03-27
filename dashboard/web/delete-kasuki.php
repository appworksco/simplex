<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["kasuki_id"])) {
    $kasukiId = $_GET["kasuki_id"];
        
    $kasukiDetails = $webFacade->getKasukiDetails($kasukiId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($kasukiDetails) {
        // Buraing ang parehong mga larawan sa storage
        $fileToDelete1 = $kasukiDetails['image1'];
        $fileToDelete2 = $kasukiDetails['image2'];
        if (file_exists($fileToDelete1)) {
            unlink($fileToDelete1);
        }
        if (file_exists($fileToDelete2)) {
            unlink($fileToDelete2);
        }
        
        $deleteKasuki = $webFacade->deleteKasuki($kasukiId);
        
        if ($deleteKasuki) {
            header("Location: kasuki?delete_msg=it has been deleted successfully!");
            exit();
        }
    }
}