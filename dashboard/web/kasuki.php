<?php

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/users-facade.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

$kasukiItems = $webFacade->fetchKasuki()->fetchAll(PDO::FETCH_ASSOC);

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
    $kasukiId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_kasuki"])) {  
    $textTitle = $_POST["text_title"];
    $textBody = $_POST["text_body"];

    // Pag-upload ng unang larawan
    $file_name1 = uniqid() . '_' . $_FILES['image1']['name'];
    $file_tmp1 = $_FILES['image1']['tmp_name'];
    $file_path1 = "../../../OCW/public/webImages/" . $file_name1;
    move_uploaded_file($file_tmp1, $file_path1);

    // Pag-upload ng ikalawang larawan
    $file_name2 = uniqid() . '_' . $_FILES['image2']['name'];
    $file_tmp2 = $_FILES['image2']['tmp_name'];
    $file_path2 = "../../../OCW/public/webImages/" . $file_name2;
    move_uploaded_file($file_tmp2, $file_path2);

    $webFacade = new WebFacade;
    $webFacade->addKasuki($textTitle, $textBody, $file_path1, $file_path2); 
    header("Location: kasuki.php");
}

if(isset($_POST['update_kasuki'])) {
    $textTitle = $_POST["text_title"];
    $textBody = $_POST["text_body"];
    $id = $_POST['itemId']; 

    // Check if first image is being updated
    if(isset($_FILES['image1']) && !empty($_FILES['image1']['name'])) {
        $file_name1 = uniqid() . '_' . $_FILES['image1']['name'];
        $file_path1 = "../../../OCW/public/webImages/" . $file_name1;
        move_uploaded_file($_FILES['image1']['tmp_name'], $file_path1);
    } else {
        // If not, retain the current image path
        $file_path1 = $_POST['current_image1']; // Ensure this is included as a hidden input field in the form
    }

    // Check if second image is being updated
    if(isset($_FILES['image2']) && !empty($_FILES['image2']['name'])) {
        $file_name2 = uniqid() . '_' . $_FILES['image2']['name'];
        $file_path2 = "../../../OCW/public/webImages/" . $file_name2;
        move_uploaded_file($_FILES['image2']['tmp_name'], $file_path2);
    } else {
        // If not, retain the current image path
        $file_path2 = $_POST['current_image2']; // Ensure this is included as a hidden input field in the form
    }

    // Ensure proper passing of parameters to the function
    $updateKasuki = $webFacade->updateKasuki($textTitle, $textBody, $file_path1, $file_path2, $id);

    if ($updateKasuki) {
        // Perform appropriate action upon successful update
        header("Location: kasuki.php");
        exit;
    } else {
        // Handle any errors that occur during update
        echo "Error updating kasuki.";
    }
}

?>

<div class="content-wrapper" style="background-color: #D5D1DD; padding: 20px;">
    <div class="card w-100" style="background-color: #EEE38A;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-bold my-2" style="font-size: 1.5rem;">Manage Ka-suki</h5>
                <a href="..\index.php" class="btn btn-sm btn-secondary">Back</a>
            </div>
            <div class="py-2">
                <?php include('../../errors.php') ?>
            </div>
            <div class="about-items">
                <?php foreach ($kasukiItems as $item): ?>
                    <div class="about-item border border-2 p-3 mb-3" style="background-color: #A8C5DD;">
                        <div class="mb-3">
                            <h6 class="fw-bold">Text title:</h6>
                            <p><?php echo $item['text_title']; ?></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Text body:</h6>
                            <p><?php echo $item['text_body']; ?></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Image 1:</h6>
                            <img src="<?= $item['image1'] ?>" alt="Image 1" style="max-width: 20%; height: auto; display: block; margin-bottom: 10px;">
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Image 2:</h6>
                            <img src="<?= $item['image2'] ?>" alt="Image 2" style="max-width: 20%; height: auto; display: block;">
                        </div>
                        <div class="action-buttons" style="margin-top: 10px;">
                            <a href="kasuki?is_updated=<?= $item["id"] ?>" class="btn btn-info" style="font-size: 1rem;">Update</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/../../includes/modals/web/add-kasuki.php') ?>
<?php include realpath(__DIR__ . '/../../includes/modals/web/update-kasuki.php') ?>
<?php include realpath(__DIR__ . '/../../includes/layout/web-footer.php') ?>

<?php
if (isset($_GET["is_updated"])) {
    $kasukiId = $_GET["is_updated"];
    if ($kasukiId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateKasuki").modal("show");
                });
            </script>';
    } else {
    }
}

?>
