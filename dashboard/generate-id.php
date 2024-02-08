<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');

$usersFacade = new UsersFacade;
$positionsFacade = new PositionsFacade;
$departmentsFacade = new DepartmentsFacade;
$servicesFacade = new ServicesFacade;

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
if (isset($_GET["employee_id"])) {
    $employeeId = $_GET["employee_id"];
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

?>

<style>
    @font-face {
        font-family: 'barcode';
        src: url('.././dist/fonts/3OF9_NEW.TTF');
    }
    body {
        opacity: 1;
        background-image: radial-gradient(#cdd9e7 1.05px, #e5e5f7 1.05px);
        background-size: 21px 21px;
    }
    .container {height: 100vh;}
    .id-front .employee-name {
        position: absolute;
        margin-top: 95px;
        margin-left: 128px;
        font-size: .8rem;
    }
    .id-front .employee-position {
        position: absolute;
        margin-top: 107px;
        margin-left: 128px;
        font-size: .5rem;
    }
    .id-front .department {
        position: absolute;
        margin-top: 140px;
        margin-left: 25px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: .4rem;
    }
    .id-front .services {
        position: absolute;
        margin-top: 170px;
        margin-left: 25px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: .27rem;
    }
    .id-front .company-id {
        position: absolute;
        margin-top: 193px;
        margin-left: 25px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 1rem;
    }
    .id-front .company-id-barcode {
        position: absolute;
        margin-top: 170px;
        margin-left: 127px;
        font-size: 2.5rem;
        font-family: barcode !important;
    }
    .id-back div {
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center;
    }
    .id-back .contact-person {
        position: absolute;
        margin-top: 135px;
        font-size: .8rem;
    }
    .id-back .contact-person-number {
        position: absolute;
        margin-top: 165px;
        font-size: .6rem;
    }
</style>

<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index" class="text-nowrap logo-img"><h3>One <span class="text-danger">Centro</span></h3></a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <?php include realpath(__DIR__ . '/../includes/layout/dashboard-sidebar.php') ?>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name=<?= $firstName . '+' . $lastName ?>&background=random" class="rounded-circle" width="35" height="35">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">
                                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p class="mb-0 fs-3">My Profile</p>
                                    </a>
                                    <a href="../logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--  Header End -->
        <div class="container-fluid">
            <!--  Row 1 -->
            <div class="row">
                <div class="col-lg-12 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body" style="margin-left: 100px; margin-right: 100px">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-semibold my-2">Generate ID</h5>
                            </div>
                            <div class="py-2">
                                <?php include('../errors.php') ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6 id-front">
                                    <?php
                                    $fetchEmployeeById = $usersFacade->fetchEmployeeById($employeeId);
                                    while ($employee = $fetchEmployeeById->fetch(PDO::FETCH_ASSOC)) { 
                                        $departmentCode = $employee["department"];
                                        $positionCode = $employee['position'];
                                        $serviceCode = $employee['services'];
                                        // Fetch Department By Code
                                        $fetchDepartmentByCode = $departmentsFacade->fetchDepartmentByCode($departmentCode);
                                        while ($department = $fetchDepartmentByCode->fetch(PDO::FETCH_ASSOC)) {
                                        // Fetch Position By Code
                                        $fetchPositionByCode = $positionsFacade->fetchPositionByCode($positionCode);
                                        while ($position = $fetchPositionByCode->fetch(PDO::FETCH_ASSOC)) {
                                        // Fetch Services By Code
                                        $fetchServiceByCode = $servicesFacade->fetchServiceByCode($serviceCode);
                                        while ($service = $fetchServiceByCode->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <h1 class="employee-name text-uppercase"><?= $employee['first_name'] . ' ' . $employee['last_name']?></h1>
                                    <p class="employee-position text-uppercase"><?= $position['position_name'] ?></p>
                                    <p class="department text-uppercase"><?= $department['department_name'] ?></p>
                                    <p class="services text-uppercase"><?= $service['service_name'] ?></p>
                                    <p class="company-id text-uppercase"><?= $employee['company_id'] ?></p>
                                    <p class="company-id-barcode"><?= $employee['company_id'] ?></p>
                                    <img src=".././dist/images/probitionary-id-front.jpg" class="w-100 border border-dark" alt="">
                                    <?php } } } } ?>
                                </div>
                                <div class="col-md-6 id-back">
                                    <?php
                                    $fetchEmployeeById = $usersFacade->fetchEmployeeById($employeeId);
                                    while ($employee = $fetchEmployeeById->fetch(PDO::FETCH_ASSOC)) { 
                                    ?>
                                    <div>
                                        <h1 class="contact-person text-uppercase"><?= $employee['contact_person'] ?></h1>
                                        <p class="contact-person-number text-uppercase"><?= $employee['contact_person_number'] ?></p>
                                    </div>

                                    <img src=".././dist/images/probitionary-id-back.jpg" class="w-100 border border-dark" alt="">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Developed by: ICT Department</p>
            </div> -->
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/../includes/modals/add-employee-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-employee-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php	
    // Open modal if add asset form is submitted
    if (isset($_GET["is_updated"])) {
        $employeeId = $_GET["is_updated"];
        if ($employeeId) {
            echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateEmployeeModal").modal("show");
                });
            </script>';
        } else {

        }
    }
?>