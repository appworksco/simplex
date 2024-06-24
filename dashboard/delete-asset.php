<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/assets-facade.php');

$assetsFacade = new AssetsFacade;

if (isset($_GET["asset_num"])) {
    $assetNum = $_GET["asset_num"];
    $deleteAsset = $assetsFacade->deleteAsset($assetNum);
    if ($deleteAsset) {
        header("Location: fixed-asset-inventory.php");
    }
}