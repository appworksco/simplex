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
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Key Features</h5>
                    </div>
                    <div class="card-body">
                        <h5>User Access Control</h5>
                        <p>Implement user roles and permissions to ensure that the right people have access to the appropriate information and functions.</p>
                        <h5>Centralized Data Storage</h5>
                        <p>Create a secure central repository for storing documents, reports, and data relevant to the department's operations.</p>
                        <h5>Communication Tools</h5>
                        <p>Include messaging for team members to communicate, share updates, and work together effectively.</p>
                        <h5>Task and Project Management</h5>
                        <p>Provide a platform for managing tasks, projects, and deadlines, enabling team members to track progress and prioritize work.</p>
                        <h5>Document Management</h5>
                        <p>Incorporate a document management system for organizing, sharing, and version control of departmental documents.</p>
                        <h5>Mobile Accessibility</h5>
                        <p>Make the system accessible on mobile devices to allow team members to work on the go.</p>
                        <h5>Security Measures</h5>
                        <p>Implement robust security measures, such as data encryption, user authentication, and regular system updates to protect sensitive departmental information.</p>
                        <h5>User Training and Support</h5>
                        <p>Provide training and support resources for department members to ensure they can use the system effectively</p>
                        <h5>Customization</h5>
                        <p>Tailor the system to fit the specific needs and workflows of your department.</p>
                        <h5>Scalability</h5>
                        <p>Ensure that the system can grow and adapt as the department's needs change over time.</p>
                        <h5>Feedback Mechanism</h5>
                        <p>Establish a feedback loop to gather input from department members and make continuous improvements to the system.</p>
                    </div>
                </div>

                <div class="card w-100">
                    <div class="card-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Applications</h5>
                    </div>
                    <div class="card-body">
                        <h5>RFID Attendance System</h5>
                        <p>Minimize absenteeism & enhance punctuality of employees by tracking & maintaining accurate attendance records using employees ID.</p>
                    </div>
                </div>
            </div>
            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Developed by: ICT Department</p>
            </div>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>