<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/departments-facade.php');

$departmentsFacade = new DepartmentsFacade;

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

<style>
    body {
        opacity: 1;
        background-image: radial-gradient(#cdd9e7 1.05px, #e5e5f7 1.05px);
        background-size: 21px 21px;
    }

    .container {
        height: 100vh;
    }
</style>

<!-- Disable mobile view start -->
<div class="d-lg-block d-none">
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
    <div class="bg-light p-1 px-4">
        <div class="mx-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="small m-0">Developed By: ICT Department</p>
                </div>
                <div class="d-flex">
                    <?php
                    $fetchDepartmentByCode = $departmentsFacade->fetchDepartmentByCode($department);
                    while ($row = $fetchDepartmentByCode->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <p class="small m-0 me-3"><img src="../dist/icons/building.jpg" class="me-1" alt="Users Icon" style="width: 18px"> <?= $row["department_name"] ?></p>
                    <?php } ?>
                    <p class="small m-0 me-3"><img src="../dist/icons/users.jpg" class="me-1" alt="Users Icon" style="width: 18px"> <?= $firstName . ' ' . $lastName ?></p>
                    <p class="small m-0"><img src="../dist/icons/clock.jpg" class="me-1" alt="Clock Icon" style="width: 18px;"><span id="clockDisplay"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Disable mobile view end -->

<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>
<!-- Footer End -->