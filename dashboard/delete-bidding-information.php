<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/bidding-information-facade.php');

$biddingInformationFacade = new BiddingInformationFacade;

if (isset($_GET["bidding_id"])) {
    $biddingId = $_GET["bidding_id"];
    $deleteBidding = $biddingInformationFacade->deleteBidding($biddingId);
    if ($deleteBidding) {
        header("Location: bidding-information?delete_msg=Bidding has been deleted successfully!");
    }
}