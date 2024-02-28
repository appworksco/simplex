<?php

class ExpensesFacade extends DBConnection
{

    public function fetchExpenses()
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_expense");
        $sql->execute();
        return $sql;
    }

    public function fetchAssetsSeriesNumber()
    {
        $sql = $this->connect()->prepare("SELECT series_number FROM assets_series");
        $sql->execute();
        return $sql;
    }

    public function updateSeries($updatedSeries)
    {
        $sql = $this->connect()->prepare("UPDATE assets_series SET series_number = '$updatedSeries'");
        $sql->execute();
        return $sql;
    }

    public function addExpense($projectName, $projectTypeId, $LGUId, $expenseType, $totalAmount, $remarks)
    {
        $sql = $this->connect()->prepare("INSERT INTO bd_expense(project_name, project_type_id, lgu_id, expense_type, total_amount, remarks) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->execute([$projectName, $projectTypeId, $LGUId, $expenseType, $totalAmount, $remarks]);
        return $sql;
    }

    public function deleteAsset($assetNum)
    {
        $sql = $this->connect()->prepare("DELETE FROM assets WHERE id = $assetNum");
        $sql->execute();
        return $sql;
    }
}
