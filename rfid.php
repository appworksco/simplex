<?php 

include realpath(__DIR__ . '/includes/layout/header.php');
include realpath(__DIR__ . '/models/users-facade.php');
include realpath(__DIR__ . '/models/rfid-facade.php');

$usersFacade = new UsersFacade;
$rfidFacade = new RFIDFacade;

if (isset($_GET["invalid"])) {
    $msg = $_GET["invalid"];
    array_push($invalid, $msg);
}
if (isset($_GET["success"])) {
    $msg = $_GET["success"];
    array_push($success, $msg);
}

if (isset($_POST["company_id_in"])) {
    $companyId = $_POST["company_id_in"];
    date_default_timezone_set('Asia/Manila');
    $date = date("m-d-Y");
    // check initially whether the employee has already clocked in for the day.
    $verifyEmployeeTimeIn = $rfidFacade->verifyEmployeeTimeIn($companyId, $date);
    if ($verifyEmployeeTimeIn == 1) {
        array_push($invalid, 'You already time in within the day!');
    } else {
        $verifyCompanyId = $usersFacade->verifyCompanyId($companyId);
        if ($verifyCompanyId > 0) {
            $fetchUserByCompanyId = $usersFacade->fetchUserByCompanyId($companyId);
            while ($row = $fetchUserByCompanyId->fetch(PDO::FETCH_ASSOC)) {
                $employee = $row["first_name"] . ' ' . $row["middle_name"] . ' ' . $row["last_name"];
                $timeIn = date("h:i:s");
                $employeeTimeIn = $rfidFacade->employeeTimeIn($companyId, $employee, $date, $timeIn);
                if ($employeeTimeIn) {
                    array_push($success, 'You have successfully logged on!');
                    $audio_file = "./dist/sfx/log-on.wav";
                    echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                }
            }
        } else {
            array_push($invalid, 'Account does not exist!');
        }
    }
}

if (isset($_POST["company_id_out"])) {
    $companyId = $_POST["company_id_out"];
    date_default_timezone_set('Asia/Manila');
    $date = date("m-d-Y");
    $timeOut = date("h:i:s");
    $employeeTimeOut = $rfidFacade->employeeTimeOut($companyId, $date, $timeOut);
    if ($employeeTimeOut) {
        array_push($success, 'You have successfully logged off!');
        $audio_file = "./dist/sfx/log-off.wav";
        echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
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

<div class="container">
    <div class="row d-flex align-items-center" style="height: 100vh">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div>
                <h1 class="display-4">One <span class="text-danger">Centro</span></h1>
                <p class="lead">The purpose of this centralized system is to streamline departmental processes, improve communication, enhance efficiency, and facilitate data management within the company.</p>
                <div class="py-6">
                    <p class="mb-0 fs-4">Developed by: ICT Department</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-body mx-5 my-3">
                    <h1 class="h3 mb-3 fw-normal">RFID Attendance System</h1>
                    <?php include('errors.php') ?>
                    <button class="w-100 btn btn-lg btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#logOnModal">Log On</button>
                    <button class="w-100 btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#logOffModal">Log Off</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/includes/layout/footer.php') ?>
<?php include realpath(__DIR__ . '/includes/modals/time-in-modal.php') ?>
<?php include realpath(__DIR__ . '/includes/modals/time-out-modal.php') ?>

<script>
    $('#logOnModal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });
    $('#logOffModal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });
</script>