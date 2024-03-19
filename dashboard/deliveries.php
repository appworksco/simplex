<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');
include realpath(__DIR__ . '/../models/municipalities-facade.php');
include realpath(__DIR__ . '/../models/lgu-facade.php');
include realpath(__DIR__ . '/../models/project-type-facade.php');
include realpath(__DIR__ . '/../models/bidding-information-facade.php');
include realpath(__DIR__ . '/../models/purchase-order-facade.php');
include realpath(__DIR__ . '/../models/deliveries-facade.php');
include realpath(__DIR__ . '/../models/payment-facade.php');

$usersFacade = new UsersFacade;
$positionsFacade = new PositionsFacade;
$departmentsFacade = new DepartmentsFacade;
$servicesFacade = new ServicesFacade;
$municipalitiesFacade = new MunicipalitiesFacade;
$LGUFacade = new LGUFacade;
$projectTypeFacade = new ProjectTypeFacade;
$biddingInformationFacade = new BiddingInformationFacade;
$POFacade = new PurchaseOrderFacade;
$deliveriesFacade = new DeliveriesFacade;
$paymentFacade = new PaymentFacade;

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
if (isset($_SESSION["can_create"])) {
    $canCreate = $_SESSION["can_create"];
}
if (isset($_SESSION["can_update"])) {
    $canUpdate = $_SESSION["can_update"];
}
if (isset($_SESSION["can_delete"])) {
    $canDelete = $_SESSION["can_delete"];
}
if (isset($_GET["is_updated"])) {
    $deliveryId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["update_delivery"])) {
    $deliveryId = $_POST["delivery_id"];
    $projectName = $_POST["project_name"];
    $BMNumber = $_POST["bm_no"];
    $projectTypeId = $_POST["project_type_id"];
    $LGUId = $_POST["lgu_id"];
    // $PONumber = $_POST["po_number"];
    $DRNumber = $_POST["dr_number"];
    $DRDate = $_POST["dr_date"];
    // $totalQuantity = $_POST["total_quantity"];
    // $totalAmount = $_POST["total_amount"];
    // $billQuantity = $totalQuantity;
    // $billAmount = $totalAmount;

    // $updateDelivery = $deliveriesFacade->updateDelivery($projectName, $BMNumber, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $deliveryId);
    $updateDelivery = $deliveriesFacade->updateDelivery($projectName, $BMNumber, $projectTypeId, $LGUId, $DRNumber, $DRDate, $deliveryId);
    if ($updateDelivery) {
        array_push($success, 'Delivery has been added successfully');
        // Add payment when delivery is added
        // $paymentFacade->updatePaymentDelivery($projectName, $projectTypeId, $LGUId, $PONumber, $DRNumber, $DRDate, $totalQuantity, $totalAmount, $billQuantity, $billAmount);
        $paymentFacade->updatePaymentDelivery($projectName, $BMNumber, $projectTypeId, $LGUId, $DRNumber, $DRDate);
    }
}

?>

<!--  Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Delivery Reports</h5>
                <?php if ($canCreate == 1) { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeliveryModal">Add Delivery</button>
                <?php } ?>
            </div>
            <div class="py-2">
                <?php include('../errors.php') ?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped data-table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Type</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">LGU Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">1st PO</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">2nd PO</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">3rd PO</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">4th PO</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">5th PO</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">DR Number</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">DR Date</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchDeliveries = $deliveriesFacade->fetchDeliveries();
                        while ($row = $fetchDeliveries->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <?php
                                    if ($canUpdate == 1) { ?>
                                        <a href="deliveries?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                    <?php }
                                    if ($canDelete == 1) { ?>
                                        <a href="delete-delivery?delivery_id=<?= $row["id"] ?>&po_no=<?= $row["1st_po_no"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this delivery?');">Delete</a>
                                    <?php } ?>
                                </td>
                                <td class="border-bottom-0">
                                    <?php
                                    $projectTypeId = $row["project_type_id"];
                                    $fetchProjectTypeById = $projectTypeFacade->fetchProjectTypeById($projectTypeId);
                                    while ($projectType = $fetchProjectTypeById->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <p class="mb-0 fw-normal"><?= $projectType["project_description"] ?></p>
                                    <?php }
                                    ?>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["project_name"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <?php
                                    $LGUId = $row["lgu_id"];
                                    $fetchLGUById = $LGUFacade->fetchLGUById($LGUId);
                                    while ($LGU =  $fetchLGUById->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <p class="mb-0 fw-normal"><?= $LGU["lgu_name"] ?></p>
                                    <?php }
                                    ?>
                                </td>
                                <td class="border-bottom-0">
                                    <?php if ($row["1st_po_no"] != NULL) { ?>
                                        <p class="mb-0 fw-normal">
                                            PO No: <?= $row["1st_po_no"] ?> <br>
                                            Total Quantity: <?= $row["1st_total_quantity"] ?> <br>
                                            Total Amount: <?= number_format($row["1st_total_amount"], 2) ?> <br>
                                        </p>
                                    <?php } ?>
                                </td>
                                <td class="border-bottom-0">
                                    <?php if ($row["2nd_po_no"] != NULL) { ?>
                                        <p class="mb-0 fw-normal">
                                            PO No: <?= $row["2nd_po_no"] ?> <br>
                                            Total Quantity: <?= $row["2nd_total_quantity"] ?> <br>
                                            Total Amount: <?= number_format($row["2nd_total_amount"], 2) ?> <br>
                                        </p>
                                    <?php } ?>
                                </td>
                                <td class="border-bottom-0">
                                    <?php if ($row["3rd_po_no"] != NULL) { ?>
                                        <p class="mb-0 fw-normal">
                                            PO No: <?= $row["3rd_po_no"] ?> <br>
                                            Total Quantity: <?= $row["3rd_total_quantity"] ?> <br>
                                            Total Amount: <?= number_format($row["3rd_total_amount"], 2) ?> <br>
                                        </p>
                                    <?php } ?>
                                </td>
                                <td class="border-bottom-0">
                                    <?php if ($row["4th_po_no"] != NULL) { ?>
                                        <p class="mb-0 fw-normal">
                                            PO No: <?= $row["4th_po_no"] ?> <br>
                                            Total Quantity: <?= $row["4th_total_quantity"] ?> <br>
                                            Total Amount: <?= number_format($row["4th_total_amount"], 2) ?> <br>
                                        </p>
                                    <?php } ?>
                                </td>
                                <td class="border-bottom-0">
                                    <?php if ($row["5th_po_no"] != NULL) { ?>
                                        <p class="mb-0 fw-normal">
                                            PO No: <?= $row["5th_po_no"] ?> <br>
                                            Total Quantity: <?= $row["5th_total_quantity"] ?> <br>
                                            Total Amount: <?= number_format($row["5th_total_amount"], 2) ?> <br>
                                        </p>
                                    <?php } ?>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["dr_no"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["dr_date"] ?></p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include realpath(__DIR__ . '/../includes/modals/add-delivery-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-delivery-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $deliveryId = $_GET["is_updated"];
    if ($deliveryId) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#updateDeliveryModal").modal("show");
                });
            </script>';
    } else {
    }
}
?>

<script>
    $(document).ready(function() {

        // Has multiple delivery
        $('#deliveryType').on('change', function() {
            if (this.value == '1') {
                $("#singlePOsingleDelivery").show();
            } else {
                $("#singlePOsingleDelivery").hide();
            }
            if (this.value == '2') {
                $("#multiplePOsingleDelivery").show();
            } else {
                $("#multiplePOsingleDelivery").hide();
            }
            if (this.value == '3') {
                $("#singlePOmultipleDelivery").show();
            } else {
                $("#singlePOmultipleDelivery").hide();
            }
        });

        // Add delivery
        $('#projectName').change(function() {
            var projectName = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-bo-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#BMNoId').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-project-type-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#projectTypeId').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-lgu-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#LGUId').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#projectPOList').html(data)
                }
            })
        });

        // Add delivery
        $('#projectNameMpsd').change(function() {
            var projectName = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-bo-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#BMNoIdMpsd').html(data)
                }
            })
            $.ajax({
                url: 'get-bo-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#BMNoIdMpsd').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-project-type-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#projectTypeIdMpsd').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-lgu-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#LGUIdMpsd').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#1stPOList').html(data),
                        $('#2ndPOList').html(data),
                        $('#3rdPOList').html(data),
                        $('#4thPOList').html(data),
                        $('#5thPOList').html(data)
                }
            })
        });

        // Add delivery
        $('#projectNameSpmd').change(function() {
            var projectName = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-bo-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#BMNoId').html(data)
                }
            })
            $.ajax({
                url: 'get-bo-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#BMNoIdSpmd').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-project-type-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#projectTypeIdSpmd').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-lgu-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#LGUIdSpmd').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#projectPOListSpmd').html(data)
                }
            })
        });

        // Update delivery
        $('#projectNameUpdate').change(function() {
            var projectName = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-bo-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#updateBMNoId').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-project-type-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#projectTypeIdUpdate').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-lgu-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#LGUIdUpdate').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#projectPOListUpdate').html(data)
                }
            })
        });
    });

    $(document).ready(function() {

        // Add delivery
        $('#projectPOList').change(function() {
            var projectPOList = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-num-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#PONumber').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-quantity-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#totalQuantity').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-amount-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#totalAmount').html(data)
                }
            })
        });

        // Add delivery 1st PO
        $('#1stPOList').change(function() {
            var projectPOList = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-num-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#1stPONumber').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-quantity-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#1stTotalQuantity').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-amount-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#1stTotalAmount').html(data)
                }
            })
        });

        // Add delivery 2nd PO
        $('#2ndPOList').change(function() {
            var projectPOList = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-num-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#2ndPONumber').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-quantity-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#2ndTotalQuantity').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-amount-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#2ndTotalAmount').html(data)
                }
            })
        });

        // Add delivery 3rd PO
        $('#3rdPOList').change(function() {
            var projectPOList = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-num-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#3rdPONumber').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-quantity-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#3rdTotalQuantity').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-amount-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#3rdTotalAmount').html(data)
                }
            })
        });

        // Add delivery 4th PO
        $('#4thPOList').change(function() {
            var projectPOList = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-num-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#4thPONumber').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-quantity-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#4thTotalQuantity').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-amount-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#4thTotalAmount').html(data)
                }
            })
        });

        // Add delivery 5th PO
        $('#5thPOList').change(function() {
            var projectPOList = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-num-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#5thPONumber').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-quantity-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#5thTotalQuantity').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-amount-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#5thTotalAmount').html(data)
                }
            })
        });

        // Add delivery
        $('#projectPOListSpmd').change(function() {
            var projectPOList = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-num-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#PONumberSpmd').html(data)
                }
            })
        });

        // Update delivery
        $('#projectPOListUpdate').change(function() {
            var projectPOList = $(this).val();

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-num-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#PONumberUpdate').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-quantity-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#totalQuantityUpdate').html(data)
                }
            })

            // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-po-total-amount-info.php',
                type: 'POST',
                data: {
                    projectPOList: projectPOList
                },
                success: function(data) {
                    $('#totalAmountUpdate').html(data)
                }
            })
        });
    });
</script>