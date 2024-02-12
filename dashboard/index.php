<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');

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
if (isset($_SESSION["position"])) {
    $position = $_SESSION["position"];
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

?>

<!-- Body Wrapper Start -->
<div class="page-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!--  Dashboard Navbar Start-->
    <?php include realpath(__DIR__ . '/../includes/layout/dashboard-navbar.php'); ?>
    <!-- Dashboard Navbar End -->

    <!-- Content Wrapper Start -->
    <div class="content-wrapper">

    </div>
    <!-- Content Wrapper End -->
</div>
<!-- Body Wrapper End -->

<!-- Footer Start -->
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>
<!-- Footer End -->