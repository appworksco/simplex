<?php

// Start a new session or resume the existing session
session_start();

// Start output buffering to capture and manipulate output
ob_start();

// Set timezone
date_default_timezone_set("Asia/Manila");

// Initialize arrays for storing error messages, warning messages, success messages, and general information
$invalid = array();
$warning = array();
$success = array();
$info = array();

// Require the autoload file from the 'vendor' directory
require_once realpath(__DIR__ . '/vendor/autoload.php');

// Require the database connection file from the 'db' directory
require realpath(__DIR__ . '/db/conn.php');
