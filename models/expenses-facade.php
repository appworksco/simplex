<?php

class ExpensesFacade extends DBConnection
{

    public function fetchExpenses()
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_expense");
        $sql->execute();
        return $sql;
    }

    public function fetchExpenseById($expenseId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_expense WHERE id = '$expenseId'");
        $sql->execute();
        return $sql;
    }

    public function updateExpense($projectName, $projectTypeId, $LGUId, $expenseType, $totalAmount, $remarks, $expenseId)
    {
        $sql = $this->connect()->prepare("UPDATE bd_expense SET project_name = '$projectName', project_type_id = '$projectTypeId', lgu_id = '$LGUId', expense_type = '$expenseType', total_amount = '$totalAmount' WHERE id = '$expenseId'");
        $sql->execute();
        return $sql;
    }

    public function addExpense($projectName, $projectTypeId, $LGUId, $expenseType, $totalAmount, $remarks)
    {
        $sql = $this->connect()->prepare("INSERT INTO bd_expense(project_name, project_type_id, lgu_id, expense_type, total_amount, remarks) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->execute([$projectName, $projectTypeId, $LGUId, $expenseType, $totalAmount, $remarks]);
        return $sql;
    }

    public function deleteExpense($expenseId)
    {
        $sql = $this->connect()->prepare("DELETE FROM bd_expense WHERE id = $expenseId");
        $sql->execute();
        return $sql;
    }
}
