<?php 

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/assets-facade.php');

$usersFacade = new UsersFacade;
$departmentsFacade = new DepartmentsFacade;
$assetsFacade = new AssetsFacade;

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
if (isset($_GET["delete_asset"])) {
    $deleteAsset = $_GET["delete_asset"];
    array_push($success, $deleteAsset);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_asset"])) {
    $employee = strtoupper($_POST["employee"]);
    $empDepartment = $_POST["department"];
    $assetName = strtoupper($_POST["asset_name"]);
    $description = strtoupper($_POST["description"]);
    $quantity = $_POST["qty"];
    $condition = $_POST["condition"];
    $remarks = $_POST["remarks"];
    $addedBy = strtoupper($_POST["added_by"]);
    $addedOn = strtoupper($_POST["added_on"]);

    if (empty($employee)) {
        array_push($invalid, 'Employee should not be empty.');
    } if (empty($assetName)) {
        array_push($invalid, 'Name of Item / Asset should not be empty.');
    } if (empty($description)) {
        array_push($invalid, 'Description should not be empty.');
    } if (empty($quantity)) {
        array_push($invalid, 'Quantity should not be empty.');
    } else {
        $addAsset = $assetsFacade->addAsset($employee, $empDepartment, $assetName, $description, $quantity, $condition, $remarks, $addedBy, $addedOn);
        if ($addAsset) {
            array_push($success, 'Asset has been added successfully');
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
                                <div class="d-flex">
                                    <!-- Administrator View Start -->
                                    <?php if ($department == 'ICT') { ?>
                                        <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#addAssetModal">Add Asset</button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="py-2">
                                <?php include('../errors.php') ?>
                            </div>
                            <div class="table-responsive" style="height: 650px; overflow: hidden">
                                <iframe src="./asset-overview.php" class="w-100" height="100%"></iframe>
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

<?php include realpath(__DIR__ . '/../includes/modals/add-asset-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php	
    // Open modal if add asset form is submitted
    if (isset($_GET["is_submitted"])) {
        $isSubmitted = $_GET["is_submitted"];
        if ($isSubmitted == 1) {
            echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#addAssetModal").modal("show");
                });
            </script>';
        } else {

        }
    }
?>