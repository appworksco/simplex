<?php

include realpath(__DIR__ . '/../includes/layout/dashboard-header.php');
include realpath(__DIR__ . '/../models/expenses-facade.php');

$expensesFacade = new ExpensesFacade;

if (isset($_GET["expense_id"])) {
    $expenseId = $_GET["expense_id"];
    $deleteExpense = $expensesFacade->deleteExpense($expenseId);
    if ($deleteExpense) {
        header("Location: expenses?delete_msg=Bidding has been deleted successfully!");
    }
}
