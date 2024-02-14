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
        $projectTypeId = $row["project_type_id"];
        $fetchProjectTypeById = "SELECT * FROM bd_project_type WHERE id = '$projectTypeId'";
        $fetchProjectTypeById = mysqli_query($conn, $fetchProjectTypeById);
        while ($projectType = mysqli_fetch_assoc($fetchProjectTypeById)) {
            $out .= '<option value="' . $projectType["id"] . '">' . $projectType["project_description"] . '</option>';
        }
    }

    echo $out;
}

$conn->close();