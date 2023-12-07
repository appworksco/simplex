<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');

$departmentsFacade = new DepartmentsFacade;
$positionsFacade = new PositionsFacade;

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
    $positionId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_position"])) {
    $positionName = $_POST["position_name"];
    $positionCode = $_POST["position_code"];

    if (empty($positionName)) {
        array_push($invalid, 'Position Name should not be empty.');
    } if (empty($positionCode)) {
        array_push($invalid, 'Position Code should not be empty.');
    } else {
        $verifyPositionCode = $positionsFacade->verifyPositionCode($positionCode);
        if ($verifyPositionCode > 0) {
            array_push($invalid, 'Position has already been added.');
        } else {
            $addPosition = $positionsFacade->addPosition($positionName, $positionCode);
            if ($addPosition) {
                array_push($success, 'Position has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_position"])) {
    $positionId = $_POST["position_id"];
    $positionName = $_POST["position_name"];
    $positionCode = $_POST["position_code"];

    if (empty($positionName)) {
        array_push($invalid, 'Position Name should not be empty.');
    } if (empty($positionCode)) {
        array_push($invalid, 'Position Code should not be empty.');
    } else {
        $updatePosition = $positionsFacade->updatePosition($positionName, $positionCode, $positionId);
        if ($updatePosition) {
            array_push($success, 'Position has been updated successfully');
        }
    }
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPositionModal">Add Position</button>
                                <?php } ?>
                            </div>
                            <div class="py-2">
                                <?php include('../errors.php') ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Position Name</h6>
                                            </th>
                                            <?php if ($userRole == 1) { ?>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Position Code</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $fetchPositions = $positionsFacade->FetchPositions();
                                    while ($row = $fetchPositions->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["position_name"]?></p>                         
                                            </td>
                                            <?php if ($userRole == 1) { ?>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["position_code"]?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="positions?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                                <a href="delete-position?position_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this position?');">Delete</a>
                                            </td>
                                            <?php } ?>
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

<?php include realpath(__DIR__ . '/../includes/modals/add-position-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-position-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php	
    // Open modal if add asset form is submitted
    if (isset($_GET["is_updated"])) {
        $positionId = $_GET["is_updated"];
        if ($positionId) {
            echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updatePositionModal").modal("show");
                });
            </script>';
        } else {

        }
    }
?>