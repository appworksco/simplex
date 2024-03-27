<?php 

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

if (isset($_GET["contact_id"])) {
    $contactId = $_GET["contact_id"];
    
    $contactDetails = $webFacade->getContactDetails($contactId);
    
    if ($contactDetails) {
        
        $deleteContact = $webFacade->deleteContact($contactId);
        
        header("Location: contact?delete_msg=it has been deleted successfully!");
    }
}