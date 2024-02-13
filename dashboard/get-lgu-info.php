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
        $LGUId = $row["lgu_id"];
        $fetchLGUById = "SELECT * FROM bd_lgu WHERE id = '$LGUId'";
        $fetchLGUById = mysqli_query($conn, $fetchLGUById);
        while ($LGU = mysqli_fetch_assoc($fetchLGUById)) {
            $out .= '<option value="' . $LGU["id"] . '">' . $LGU["lgu_name"] . '</option>';
        }
    }

    echo $out;
}

$conn->close();
