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

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_department"])) {
    echo 'asdasda';
}

?>

<style>
    body {
        opacity: 1;
        background-image: radial-gradient(#cdd9e7 1.05px, #e5e5f7 1.05px);
        background-size: 21px 21px;
    }
    .container {height: 100vh;}
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
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-semibold my-2">Overview</h5>
                                <!-- Administrator View Start -->
                                <?php if ($userRole == 1) { ?>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepartment">Add Department</button>
                                <?php } ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Department Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Department Code</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $fetchDepartments = $departmentsFacade->FetchDepartments();
                                    while ($row = $fetchDepartments->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["department_name"]?></p>                         
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["department_code"]?></p>
                                            </td>
                                        </tr> 
                                    <?php } ?>                 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Developed by: ICT Department</p>
            </div>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/../includes/modals/add-department-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>