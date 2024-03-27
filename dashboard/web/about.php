<?php

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/users-facade.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

$aboutItems = $webFacade->fetchAbout()->fetchAll(PDO::FETCH_ASSOC);

$userId = 0;
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
}
if (isset($_SESSION["user_role"])) {
    $userRole = $_SESSION["user_role"];
}
if (isset($_SESSION["first_name"])) {
    $firstName = $_SESSION["first_name"];
}
if (isset($_SESSION["last_name"])) {
    $lastName = $_SESSION["last_name"];
}
if (isset($_SESSION["department"])) {
    $department = $_SESSION["department"];
}
if (isset($_GET["is_updated"])) {
    $aboutId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_about"])) {
    $mission = $_POST["mission"];
    $vision = $_POST["vision"];
    $descript = $_POST["descript"];
    $text = $_POST["text"];

    $webFacade = new WebFacade;
    $webFacade->addAbout($mission, $vision, $descript, $text);

    header("Location: about.php");
    exit();
}

if(isset($_POST['update_about'])) {
    $mission = $_POST['mission'];
    $vision = $_POST['vision'];
    $descript = $_POST['descript'];
    $text = $_POST['text'];
    $id = $_POST['itemId']; 

    // Siguruhing tama ang pagpasa ng mga parameter sa function
    $updateAbout = $webFacade->updateAbout($mission, $vision, $descript, $text, $id);
}

?>

<!-- Content Wrapper Start -->
<div class="content-wrapper" style="background-color: #D5D1DD;">
    <div class="container">
        <div class="card w-100 mt-3" style="background-color: #EEE38A;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-bold my-2">Manage About</h5>
                    <a href="..\index.php" class="btn btn-sm btn-secondary">Back</a>
                </div>
                <div class="py-2">
                    <?php include('../../errors.php') ?>
                </div>
                <div class="about-items">
                    <?php foreach ($aboutItems as $item): ?>
                        <div class="about-item border border-2 p-3 mb-3" style="background-color: #A8C5DD;">
                            <div class="mb-3">
                                <h6 class="fw-bold">Mission</h6>
                                <p><?php echo $item['mission']; ?></p>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold">Vision</h6>
                                <p><?php echo $item['vision']; ?></p>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold">Descript Text</h6>
                                <p><?php echo $item['descript']; ?></p>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold">Long Text</h6>
                                <p><?php echo $item['text']; ?></p>
                            </div>
                            <div class="action-buttons">
                                <a href="about?is_updated=<?= $item["id"] ?>" class="btn btn-sm btn-info me-2">Update</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper End -->

<?php include realpath(__DIR__ . '/../../includes/modals/web/add-about.php') ?>
<?php include realpath(__DIR__ . '/../../includes/modals/web/update-about.php') ?>
<?php include realpath(__DIR__ . '/../../includes/layout/web-footer.php') ?>

<?php
if (isset($_GET["is_updated"])) {
    $aboutId = $_GET["is_updated"];
    if ($aboutId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateAbout").modal("show");
                });
            </script>';
    } else {
    }
}

?>
