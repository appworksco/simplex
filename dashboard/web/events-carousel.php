<?php

include realpath(__DIR__ . '/../../includes/layout/web-header.php');
include realpath(__DIR__ . '/../../models/users-facade.php');
include realpath(__DIR__ . '/../../models/web-facade.php');

$webFacade = new WebFacade;

$carouselItems = $webFacade->fetchEventsCarousel()->fetchAll(PDO::FETCH_ASSOC);

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
    $eventsCarouselId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_events_carousel"])) {
    $name = $_POST["name"];
    $caption = $_POST["caption"];

    // Kunin ang pangalan ng file at itakda ang file path para sa pag-upload
    $file_name = uniqid() . '_' . $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_path = "../../../OCW/public/webImages/" . $file_name;

    if (empty($name)) {
        array_push($invalid, 'Name should not be empty.');
    } else {
        // I-insert ang bagong entry sa database
        $webFacade = new WebFacade;
        $webFacade->addEventsCarousel($name, $file_path, $caption);
        
        // I-move ang uploaded file sa tamang directory
        move_uploaded_file($file_tmp, $file_path);

        // I-redirect pabalik sa home carousel page o sa kung saan man ang gusto mong dalhin
        header("Location: events-carousel.php");
        exit();
    }
}

if(isset($_POST['update_events_carousel'])) {
    $name = $_POST['name'];
    $caption = $_POST['caption'];
    $id = $_POST['itemId']; // Kunin ang ID ng item

    // Kung mayroong bagong larawan na na-upload
    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $file_name = uniqid() . '_' . $_FILES['image']['name'];
        $file_path = "../../../OCW/public/webImages/" . $file_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $file_path);
    } else {
        // Kung walang bagong larawan, manatili ang dating file path
        $file_path = $_POST['current_image']; // Ito ay dapat na isama bilang hidden input field sa form
    }

    // Siguruhing tama ang pagpasa ng mga parameter sa function
    $updateEventsCarousel = $webFacade->updateEventsCarousel($name, $file_path, $caption, $id);
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper" style="background-color: #D5D1DD;">
    <div class="container">
        <div class="card w-100 mt-3" style="background-color: #EEE38A;">
            <div class="card-body p-4">
                <div>
                    <a href="..\index.php" class="btn btn-sm btn-secondary">Back</a>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-bold my-2">Manage Events Carousel</h5>
                    <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#addEventsCarousel">Add</button>
                </div>
                <div class="py-2">
                    <?php include('../../errors.php') ?>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach ($carouselItems as $item): ?>
                        <div class="col">
                            <div class="about-item border border-2 p-3" style="background-color: #A8C5DD;">
                                <div class="mb-3">
                                    <h6 class="fw-bold">Name: <?php echo $item['name']; ?></h6>
                                </div>
                                <div class="mb-3">
                                    <h6 class="fw-bold"></h6>
                                    <img src="<?= $item['image'] ?>" alt="No Image Found" style="max-width: 100%; height: auto;">
                                </div>
                                <?php if (!empty($item['caption'])): ?>
                                <div class="mb-3">
                                    <h6 class="fw-bold"><?php echo $item['caption']; ?></h6>
                                </div>
                                <?php endif; ?>
                                <div class="action-buttons">
                                    <a href="events-carousel?is_updated=<?= $item["id"] ?>" class="btn btn-sm btn-info me-2">Update</a>
                                    <a href="delete-events-carousel?events_carousel_id=<?= $item["id"] ?>" class="btn btn-sm btn-danger me-2" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Content Wrapper End -->

<?php include realpath(__DIR__ . '/../../includes/modals/web/add-events-carousel.php') ?>
<?php include realpath(__DIR__ . '/../../includes/modals/web/update-events-carousel.php') ?>
<?php include realpath(__DIR__ . '/../../includes/layout/web-footer.php') ?>

<?php
if (isset($_GET["is_updated"])) {
    $eventsCarouselId = $_GET["is_updated"];
    if ($eventsCarouselId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateEventsCarousel").modal("show");
                });
            </script>';
    } else {
    }
}

?>
