<?php 

include realpath(__DIR__ . '/includes/layout/header.php');
include realpath(__DIR__ . '/models/users-facade.php');

$usersFacade = new UsersFacade;

if (isset($_GET["invalid"])) {
    $msg = $_GET["invalid"];
    array_push($invalid, $msg);
}
if (isset($_GET["success"])) {
    $msg = $_GET["success"];
    array_push($success, $msg);
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username)) {
        array_push($invalid, 'Username should not be empty.');
    } if (empty($password)) {
        array_push($invalid, 'Password should not be empty.');
    } else {
        $verifyUsernameAndPassword = $usersFacade->verifyUsernameAndPassword($username, $password);
        $login = $usersFacade->login($username, $password);
        if ($verifyUsernameAndPassword > 0) {
            while ($row = $login->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["user_role"] = $row["user_role"];
                $_SESSION["first_name"] = $row["first_name"];
                $_SESSION["last_name"] = $row["last_name"];
                $_SESSION["department"] = $row["department"];
                $_SESSION["position"] = $row["position"];
                header("Location: dashboard/index");
            }
        } else {
            array_push($invalid, 'Incorrect username or password.');
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
                    <form action="index" method="post">
                        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                        <?php include('errors.php') ?>
                        <div class="form-floating">
                            <input type="test" class="form-control" id="username" name="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="d-flex justify-content-between my-3">
                            <label>
                                <input type="checkbox" onclick="myFunction()"> Show Password
                            </label>
                            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot password</button>
                        </div>
                        <button type="submit" class="w-100 btn btn-lg btn-primary" name="sign_in">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("password");
            if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php include realpath(__DIR__ . '/includes/layout/footer.php') ?>
<?php include realpath(__DIR__ . '/includes/modals/forgot-password-modal.php') ?>