<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/users-facade.php');
include realpath(__DIR__ . '/../models/positions-facade.php');
include realpath(__DIR__ . '/../models/departments-facade.php');
include realpath(__DIR__ . '/../models/services-facade.php');
include realpath(__DIR__ . '/../models/municipalities-facade.php');
include realpath(__DIR__ . '/../models/lgu-facade.php');
include realpath(__DIR__ . '/../models/project-type-facade.php');
include realpath(__DIR__ . '/../models/expenses-facade.php');
include realpath(__DIR__ . '/../models/bidding-information-facade.php');


$usersFacade = new UsersFacade;
$positionsFacade = new PositionsFacade;
$departmentsFacade = new DepartmentsFacade;
$servicesFacade = new ServicesFacade;
$municipalitiesFacade = new MunicipalitiesFacade;
$LGUFacade = new LGUFacade;
$projectTypeFacade = new ProjectTypeFacade;
$expensesFacade = new ExpensesFacade;
$biddingInformationFacade = new BiddingInformationFacade;

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
if (isset($_SESSION["department"])) {
    $department = $_SESSION["department"];
}
if (isset($_GET["is_updated"])) {
    $expenseId = $_GET["is_updated"];
}
if (isset($_GET["delete_msg"])) {
    $msg = $_GET["delete_msg"];
    array_push($success, $msg);
}

// Redirect user if user id is empty
if ($userId == 0) {
    header("Location: ../index?invalid=You do not have permission to access the page!");
}

if (isset($_POST["add_expense"])) {
    $projectName = $_POST["project_name"];
    $BMNumber = $_POST["bm_no"];
    $projectTypeId = $_POST["project_type_id"];
    $LGUId = $_POST["lgu_id"];
    $expenseType = $_POST["expense_type"];
    $totalAmount = $_POST["total_amount"];
    $remarks = $_POST["remarks"];

    $fetchBiddingByBMNO = $biddingInformationFacade->fetchBiddingByBMNO($BMNumber);
    while ($bidding = $fetchBiddingByBMNO->fetch(PDO::FETCH_ASSOC)) {
        $projectBudgetAmount = $bidding["project_budget_amount"];
        if ($projectBudgetAmount > $totalAmount) {
            $addExpense = $expensesFacade->addExpense($projectName, $projectTypeId, $LGUId, $expenseType, $totalAmount, $remarks);
            if ($addExpense) {
                array_push($success, 'Expense has been added successfully');
                // Update project expense amount in bidding
                $biddingInformationFacade->updateProjectExpenseAmount($totalAmount, $BMNumber);
            }
        } else {
            array_push($invalid, 'Amount has passed the allocated budget!');
        }
    }
}

if (isset($_POST["update_expense"])) {
    $expenseId = $_POST["expense_id"];
    $projectName = $_POST["project_name"];
    $BMNumber = $_POST["bm_no"];
    $projectTypeId = $_POST["project_type_id"];
    $LGUId = $_POST["lgu_id"];
    $expenseType = $_POST["expense_type"];
    $totalAmount = $_POST["total_amount"];
    $remarks = $_POST["remarks"];

    $fetchBiddingByBMNO = $biddingInformationFacade->fetchBiddingByBMNO($BMNumber);
    while ($bidding = $fetchBiddingByBMNO->fetch(PDO::FETCH_ASSOC)) {
        $projectBudgetAmount = $bidding["project_budget_amount"];
        if ($projectBudgetAmount > $totalAmount) {
            $addExpense = $expensesFacade->updateExpense($projectName, $projectTypeId, $LGUId, $expenseType, $totalAmount, $remarks, $expenseId);
            if ($addExpense) {
                array_push($success, 'Expense has been added successfully');
                // Update project expense amount in bidding
                $biddingInformationFacade->updateProjectExpenseAmount($totalAmount, $BMNumber);
            }
        } else {
            array_push($invalid, 'Amount has passed the allocated budget!');
        }
    }
}

?>

<!-- Content Wrapper Start -->
<div class="content-wrapper">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold my-2">Overview</h5>
                <?php if ($canCreate == 1) { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExpensesModal">Add Expenses</button>
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
                                <h6 class="fw-semibold mb-0">Project Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Project Type</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">LGU Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Expense Type</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Total Amount</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Remarks</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchExpenses = $expensesFacade->fetchExpenses();
                        while ($row = $fetchExpenses->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <?php
                                    if ($canUpdate == 1) { ?>
                                        <a href="expenses?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                    <?php }
                                    if ($canDelete == 1) { ?>
                                        <a href="delete-expense?expense_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this municipality?');">Delete</a>
                                    <?php } ?>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["project_name"] ?></p>
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
                                    <?php
                                    $LGUId = $row["lgu_id"];
                                    $fetchLGUById = $LGUFacade->fetchLGUById($LGUId);
                                    while ($LGU =  $fetchLGUById->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <p class="mb-0 fw-normal"><?= $LGU["lgu_name"] ?></p>
                                    <?php }
                                    ?>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["expense_type"] ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= number_format($row["total_amount"],2 ) ?></p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row["remarks"] ?></p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper End -->

<?php include realpath(__DIR__ . '/../includes/modals/add-expenses-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/modals/update-expense-modal.php') ?>
<?php include realpath(__DIR__ . '/../includes/layout/dashboard-footer.php') ?>

<?php
// Open modal if add asset form is submitted
if (isset($_GET["is_updated"])) {
    $expenseId = $_GET["is_updated"];
    if ($expenseId) {
        echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#updateExpenseModal").modal("show");
            });
        </script>';
    } else {
    }
}
?>

<script>
    // add Expense
    $(document).ready(function() {
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
        });
    });

    // update PO
    $(document).ready(function() {
        $('#updateProjectName').change(function() {
            var projectName = $(this).val();

            // // Fetch items based on the selected category using AJAX
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

            // // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-project-type-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#updateProjectTypeId').html(data)
                }
            })

            // // Fetch items based on the selected category using AJAX
            $.ajax({
                url: 'get-lgu-info.php',
                type: 'POST',
                data: {
                    projectName: projectName
                },
                success: function(data) {
                    $('#updateLGUId').html(data)
                }

            })
        });
    });
</script>