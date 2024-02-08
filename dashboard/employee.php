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
if (isset($_SESSION["position"])) {
    $position = $_SESSION["position"];
}
if (isset($_GET["is_updated"])) {
    $employeeId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_employee"])) {
    $firstName = $_POST["first_name"];
    $middleName = $_POST["middle_name"];
    $lastName = $_POST["last_name"];
    $birthDate = $_POST["birth_date"];
    $bloodType = $_POST["blood_type"];
    if (empty($companyId)) {
        $companyId = rand(00000000, 99999999);
    } else {
        $companyId = $_POST["company_id"];
    }
    $address = $_POST["address"];
    $contactPerson = $_POST["contact_person"];
    $contactPersonNumber = $_POST["contact_person_number"];
    $department = $_POST["department"];
    $position = $_POST["position"];
    $services = $_POST["services"];
    $sss = $_POST["sss"];
    $pagIbig = $_POST["pag_ibig"];
    $phic = $_POST["phic"];
    $tin = $_POST["tin"];
    $status = 'Probationary';

    if (empty($firstName)) {
        array_push($invalid, 'First Name should not be empty.');
    } if (empty($lastName)) {
        array_push($invalid, 'Last Name should not be empty.');
    } if (empty($birthDate)) {
        array_push($invalid, 'Birth Date should not be empty.');
    } if (empty($address)) {
        array_push($invalid, 'Address should not be empty.');
    } else {
        $verifyEmployee = $usersFacade->verifyEmployee($firstName, $middleName, $lastName);
        if ($verifyEmployee > 0) {
            array_push($invalid, 'Employee has already been added.');
        } else {
            $addEmployee = $usersFacade->addEmployee($companyId, $firstName, $middleName, $lastName, $birthDate, $bloodType, $address, $contactPerson, $contactPersonNumber, $department, $position, $services, $sss, $pagIbig, $phic, $tin, $status);
            if ($addEmployee) {
                array_push($success, 'Employee has been added successfully');
            }
        }
    }
}

if (isset($_POST["update_employee"])) {
    $employeeId = $_POST["employee_id"];
    $firstName = $_POST["first_name"];
    $middleName = $_POST["middle_name"];
    $lastName = $_POST["last_name"];
    $birthDate = $_POST["birth_date"];
    $bloodType = $_POST["blood_type"];
    $companyId = $_POST["company_id"];
    $address = $_POST["address"];
    $contactPerson = $_POST["contact_person"];
    $contactPersonNumber = $_POST["contact_person_number"];
    $department = $_POST["department"];
    $position = $_POST["position"];
    $services = $_POST["services"];
    $sss = $_POST["sss"];
    $pagIbig = $_POST["pag_ibig"];
    $phic = $_POST["phic"];
    $tin = $_POST["tin"];
    $status = $_POST["status"];

    if (empty($firstName)) {
        array_push($invalid, 'First Name should not be empty.');
    } if (empty($lastName)) {
        array_push($invalid, 'Last Name should not be empty.');
    } if (empty($birthDate)) {
        array_push($invalid, 'Birth Date should not be empty.');
    } if (empty($address)) {
        array_push($invalid, 'Address should not be empty.');
    } else {
        $updateEmployee = $usersFacade->updateEmployee($employeeId, $companyId, $firstName, $middleName, $lastName, $birthDate, $bloodType, $address, $contactPerson, $contactPersonNumber, $department, $position, $services, $sss, $pagIbig, $phic, $tin, $status);
        if ($updateEmployee) {
            array_push($success, 'Employee has been updated successfully');
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
                                <!-- HR Associate - Talent Acquisition and Retention can only see the button -->
                                <?php if ($position == 'HRATAR') { ?>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
                                <?php } ?>
                            </div>
                            <div class="py-2">
                                <?php include('../errors.php') ?>
                            </div>
                            <div class="table-responsive">
                                <table id="employeeTable" class="table data-table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Employee</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Department</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Services</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Company ID</h6>
                                            </th>
                                            <!-- Administrator View Start -->
                                            <?php if ($userRole == 1) { ?>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Username</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Password</h6>
                                            </th>
                                            <?php } ?>
                                            <!-- Administrator View End -->
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Birth Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Blood Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Address</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Contact Person</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Contact Person Number</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">SSS</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Pag Ibig</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">PHIC</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">TIN</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $fetchUsers = $usersFacade->FetchUsers();
                                    while ($row = $fetchUsers->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1"><?= $row["first_name"] . ' ' . $row["middle_name"] . ' ' . $row["last_name"] ?></h6>
                                                <?php
                                                $positionCode = $row["position"];
                                                $fetchPositionByCode = $positionsFacade->fetchPositionByCode($positionCode);
                                                while ($pos = $fetchPositionByCode->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <span class="fw-normal"><?= $pos["position_name"] ?></span>
                                                <?php } ?>                    
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["department"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["services"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["company_id"] ?></p>
                                            </td>
                                            <!-- Administrator View Start -->
                                            <?php if ($userRole == 1) { ?>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["username"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["password"] ?></p>
                                            </td>
                                            <?php } ?>
                                            <!-- Administrator View End -->
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["birthdate"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["blood_type"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["address"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["contact_person"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["contact_person_number"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["sss"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["pag_ibig"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["phic"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["tin"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if ($row["status"] == 'Probationary') { ?>
                                                        <span class="fw-semibold"><?= $row["status"] ?></span>
                                                    <?php } else { ?>
                                                        <span class="text-success fw-semibold"><?= $row["status"] ?></span>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <?php if ($position == 'HRATAR' && $row["status"] == 'Probationary') { ?>
                                                    <a href="generate-id?employee_id=<?= $row["id"] ?>" class="btn btn-warning">Generate ID</a>
                                                <?php } ?>  
                                                <a href="employee?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                                <a href="delete-employee?employee_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
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