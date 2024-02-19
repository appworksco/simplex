<?php

include realpath(__DIR__ . '/includes/layout/header.php');
include realpath(__DIR__ . '/models/users-facade.php');
include realpath(__DIR__ . '/models/rfid-facade.php');

$usersFacade = new UsersFacade;
$rfidFacade = new RFIDFacade;

$invalid = [];
$success = [];

// Ensure $_SESSION['last_attempt_time'] is initialized as an array
if (!isset($_SESSION['last_attempt_time']) || !is_array($_SESSION['last_attempt_time'])) {
    $_SESSION['last_attempt_time'] = [];
}

// Function to check if the minimum time interval has passed since the last attempt for a specific company ID
function isTimeIntervalPassed($companyId)
{
    $currentTime = time();
    if (isset($_SESSION['last_attempt_time'][$companyId])) {
        $lastAttemptTime = $_SESSION['last_attempt_time'][$companyId];
        return ($currentTime - $lastAttemptTime) > 900; // 900 seconds = 15 minutes
    } else {
        return true; // No last attempt recorded for this company, allow attempt
    }
}

if (isset($_GET["invalid"])) {
    $msg = $_GET["invalid"];
    array_push($invalid, $msg);
}
if (isset($_GET["success"])) {
    $msg = $_GET["success"];
    array_push($success, $msg);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["company_id"])) {
        $companyId = $_POST["company_id"];

        $verifyCompanyId = $usersFacade->verifyCompanyId($companyId);
        if ($verifyCompanyId == 0) {
            array_push($invalid, 'Not registered. Please try again!');
            $audio_file = "./dist/sfx/not-reg.wav";
            echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
        } else {
            // Check if minimum time interval has passed since the last attempt for this company
            if (!isTimeIntervalPassed($companyId)) {
                array_push($invalid, 'Please wait before attempting again');
                $audio_file = "./dist/sfx/pls-wait.wav";
                echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
            } else {
                $_SESSION['last_attempt_time'][$companyId] = time(); // Record the time of this attempt for this company

                // Proceed with the form submission handling
                date_default_timezone_set('Asia/Manila');
                $currentTime = date("H:i:s");
                $currentDate = date("m-d-Y");

                $verifyEmployeeTimeIn = $rfidFacade->verifyEmployeeTimeIn($companyId, $currentDate);
                if ($verifyEmployeeTimeIn > 0) {
                    $fetchUserByCompanyId = $usersFacade->fetchUserByCompanyId($companyId);
                    while ($users = $fetchUserByCompanyId->fetch(PDO::FETCH_ASSOC)) {
                        // if ($employeeInfo) {
                        $isOperation = $users["is_operation"];
                        $timeIn = $users["time_in"];
                        $timeOut = $users["time_out"];
                        $breakIn = $users["break_in"];
                        $breakOut = $users["break_out"];

                        if ($isOperation == 0) {
                            // Non-operational employee
                            // Logout
                            if ($currentTime > $timeOut) {
                                // Past work hours, insert clock-out record
                                $insertClockOutRecord = $rfidFacade->insertClockOutRecord($companyId, $currentDate, $currentTime);
                                if ($insertClockOutRecord) {
                                    array_push($success, 'You have successfully logged out!');
                                    $audio_file = "./dist/sfx/log-out.wav";
                                    echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                                }
                            } else {
                                array_push($invalid, 'You are not in the right time yet!');
                                $audio_file = "./dist/sfx/not-yet.wav";
                                echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                            }
                        } elseif ($isOperation == 1) {
                            // Operational employee
                            if ($currentTime >= $breakOut && $currentTime <= $breakIn) {
                                // Within break hours, insert break-out record
                                $insertBreakOutRecord = $rfidFacade->insertBreakOutRecord($companyId, $currentDate, $currentTime);
                                if ($insertBreakOutRecord) {
                                    array_push($success, 'You have successfully breaked out!');
                                    $audio_file = "./dist/sfx/break-out.wav";
                                    echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                                }
                            } elseif ($currentTime >= $breakIn && $currentTime <= $timeOut) {
                                // Within break hours, insert break-in record
                                $insertBreakInRecord = $rfidFacade->insertBreakInRecord($companyId, $currentDate, $currentTime);
                                if ($insertBreakInRecord) {
                                    array_push($success, 'You have successfully breaked in!');
                                    $audio_file = "./dist/sfx/break-in.wav";
                                    echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                                }
                            } elseif ($currentTime >= $timeOut) {
                                // Past work hours, insert clock-out record
                                $insertClockOutRecord = $rfidFacade->insertClockOutRecord($companyId, $currentDate, $currentTime);
                                if ($insertClockOutRecord) {
                                    array_push($success, 'You have successfully logged out!');
                                    $audio_file = "./dist/sfx/log-out.wav";
                                    echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                                }
                            } else {
                                array_push($invalid, 'You are not in the right time yet!');
                                $audio_file = "./dist/sfx/not-yet.wav";
                                echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                            }
                        }
                    }
                } else {
                    $verifyCompanyId = $usersFacade->verifyCompanyId($companyId);
                    if ($verifyCompanyId > 0) {

                        // Retrieve employee information including shift schedule
                        $fetchUserByCompanyId = $usersFacade->fetchUserByCompanyId($companyId);
                        while ($users = $fetchUserByCompanyId->fetch(PDO::FETCH_ASSOC)) {
                            // if ($employeeInfo) {
                            $isOperation = $users["is_operation"];
                            $employee = $users["first_name"] . ' ' . $users["middle_name"] . ' ' . $users["last_name"];
                            $timeIn = $users["time_in"];
                            $timeOut = $users["time_out"];
                            $breakIn = $users["break_in"];
                            $breakOut = $users["break_out"];

                            if ($isOperation == 0) {
                                // Non-operational employee
                                if ($currentTime < $timeIn || $currentTime > $timeIn && $currentTime < $timeOut) {
                                    // Within work hours, insert clock-in record
                                    $insertClockInRecord = $rfidFacade->insertClockInRecord($companyId, $employee, $currentDate, $currentTime);
                                    if ($insertClockInRecord) {
                                        array_push($success, 'You have successfully logged in!');
                                        $audio_file = "./dist/sfx/log-in.wav";
                                        echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                                    }
                                } else {
                                    array_push($invalid, 'You are not scheduled to work at this time!');
                                    $audio_file = "./dist/sfx/not-sched.wav";
                                    echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                                }
                            } elseif ($isOperation == 1) {
                                // Operational employee
                                if ($currentTime < $timeIn || $currentTime > $timeIn && $currentTime < $timeOut) {
                                    // Within regular work hours, insert clock-in record
                                    $insertClockInRecord = $rfidFacade->insertClockInRecord($companyId, $employee, $currentDate, $currentTime);
                                    if ($insertClockInRecord) {
                                        array_push($success, 'You have successfully logged in!');
                                        $audio_file = "./dist/sfx/log-in.wav";
                                        echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                                    }
                                } else {
                                    array_push($invalid, 'You are not scheduled to work at this time!');
                                    $audio_file = "./dist/sfx/not-sched.wav";
                                    echo "<audio autoplay='true' style='display:none;'><source src='$audio_file'></audio>";
                                }
                            }
                        }
                    }
                }
            }
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

    .container {
        height: 100vh;
    }
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
                    <form action="rfid" method="post">
                        <label for="companyId" class="form-label">Company ID</label>
                        <input type="text" class="form-control" id="companyId" name="company_id" autofocus>
                        <input type="hidden" name="date" id="date">
                        <input type="hidden" name="time" id="time">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/includes/layout/footer.php') ?>
<?php include realpath(__DIR__ . '/includes/modals/time-in-modal.php') ?>
<?php include realpath(__DIR__ . '/includes/modals/time-out-modal.php') ?>