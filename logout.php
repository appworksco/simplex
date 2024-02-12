<?php

// Set timezone
date_default_timezone_set("Asia/Manila");

$firstName = $_GET["first_name"];
$lastName = $_GET["last_name"];

// Add logout log
$logFile = fopen("log-file.txt", "a") or die("Unable to open file!");
$txt = date("m/d/Y h:i:sa") . " : " . $firstName . ' ' . $lastName . ' has been logged out!' . "\n";
fwrite($logFile, $txt);
fclose($logFile);

ob_start();
session_start();
session_unset();
session_destroy();

header("Location: index?success=You have successfully logout.");