<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["career_id"])) {
    $careerId = $_GET["career_id"];
    
    $careerDetails = $webFacade->getCareerDetails($careerId);
    
    // Siguraduhing mayroong detalye bago i-delete
    if ($careerDetails) {
        
        $deleteCareer = $webFacade->deleteCareer($careerId);
        
        header("Location: careers?delete_msg=it has been deleted successfully!");
    }
}