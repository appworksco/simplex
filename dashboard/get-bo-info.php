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
$out = '';
if (isset($_POST["projectName"])) {
    $projectName = $_POST["projectName"];

    $sql = "SELECT * FROM bd_project_information WHERE project_name = '$projectName'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $BMNumber = $row["bm_no"];
        $fetchBiddingById = "SELECT * FROM bd_project_information WHERE bm_no = '$BMNumber'";
        $fetchBiddingById = mysqli_query($conn, $fetchBiddingById);
        while ($bidding = mysqli_fetch_assoc($fetchBiddingById)) {
            $out .= '<option value="' . $bidding["bm_no"] . '">' . $bidding["bm_no"] . '</option>';
        }
    }

    echo $out;
}

$conn->close();