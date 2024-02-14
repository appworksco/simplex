<?php

// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "one_centro";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch items based on the selected category
if (isset($_POST["projectPOList"])) {
    $projectPOListId = $_POST["projectPOList"];
    $fetchPOById = "SELECT * FROM bd_po WHERE id = '$projectPOListId'";
    $fetchPOById = mysqli_query($conn,  $fetchPOById);
    while ($PO = mysqli_fetch_assoc($fetchPOById)) {
        $out .= '<option value="' . $PO["total_sku_quantity"] . '">' . $PO["total_sku_quantity"] . '</option>';
    }

    echo $out;
}

$conn->close();
