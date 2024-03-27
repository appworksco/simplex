<?php

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/users-facade.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

$contactItems = $webFacade->fetchContact()->fetchAll(PDO::FETCH_ASSOC);

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
    $contactId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_contact"])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['message'];

    $webFacade = new WebFacade;
    $webFacade->addContact($email, $name, $message);

    header("Location: contact.php");
}

if(isset($_POST['update_contact'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['message'];
    $id = $_POST['itemId']; 

    $updateContact = $webFacade->updateContact($email, $name, $message, $id);
}

?>

<!-- Content Wrapper Start -->
<div class="content-wrapper" style="background-color: #F0F0F0; padding: 20px;">
    <div class="card w-100" style="background-color: #FFFFFF; border-radius: 10px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-bold my-2" style="color: #333333;">Messages From Centro Page</h5>
                <a href="..\index.php" class="btn btn-sm btn-secondary">Back</a>
            </div>
            <div class="py-2">
                <?php include('../../errors.php') ?>
            </div>
            <div class="about-items">
                <?php $count = 0; ?>
                <?php foreach ($contactItems as $item): ?>
                    <?php if ($count % 3 == 0): ?>
                        <div class="row mb-3">
                    <?php endif; ?>
                    <div class="col-md-4">
                        <div class="about-item border border-2 p-3" style="background-color: #F5F5F5;">
                            <div class="mb-3">
                                <h6 class="fw-bold" style="color: #333333;">Email:</h6>
                                <p style="color: #666666;"><?php echo $item['email']; ?></p>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold" style="color: #333333;">Name:</h6>
                                <p style="color: #666666;"><?php echo $item['name']; ?></p>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold" style="color: #333333;">Message:</h6>
                                <p style="color: #666666;"><?php echo $item['message']; ?></p>
                            </div>
                            <div class="action-buttons">
                                <a href="contact?is_updated=<?= $item["id"] ?>" class="btn btn-sm btn-info me-2">Update</a>
                                <a href="delete-contact?contact_id=<?= $item["id"] ?>" class="btn btn-sm btn-danger me-2" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
                            </div>
                        </div>
                    </div>
                    <?php $count++; ?>
                    <?php if ($count % 3 == 0 || $count == count($contactItems)): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper End -->

<?php include realpath(__DIR__ . '/../../includes/modals/web/add-contact.php') ?>
<?php include realpath(__DIR__ . '/../../includes/modals/web/update-contact.php') ?>
<?php include realpath(__DIR__ . '/../../includes/layout/web-footer.php') ?>

<?php
if (isset($_GET["is_updated"])) {
    $contactId = $_GET["is_updated"];
    if ($contactId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateContact").modal("show");
                });
            </script>';
    } else {
    }
}

?>
