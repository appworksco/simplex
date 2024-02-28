<div class="modal fade" id="updateExpenseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="card-body">
                            <?php
                            $fetchExpenseById = $expensesFacade->fetchExpenseById($expenseId);
                            while ($row = $fetchExpenseById->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="mb-3">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <select class="form-select" id="updateProjectName" name="project_name">
                                        <option value="">Please Select...</option>
                                        <?php
                                        $fetchBiddingInformaion = $biddingInformationFacade->fetchBiddingInformation();
                                        while ($bidding = $fetchBiddingInformaion->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <option value="<?= $bidding["project_name"] ?>"><?= $bidding["project_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="BMNoId" class="form-label">BM Number</label>
                                    <select class="form-select" id="updateBMNoId" name="bm_no"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="projectTypeId" class="form-label">Project Type</label>
                                    <select class="form-select" id="updateProjectTypeId" name="project_type_id"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="LGUId" class="form-label">LGU Name</label>
                                    <select class="form-select" id="updateLGUId" name="lgu_id"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="expenseType" class="form-label">Expense Type</label>
                                    <select class="form-select" id="expenseType" name="expense_type">
                                        <?php if ($row["expense_type"] == 'BID DOCS') { ?>
                                            <option value="BID DOCS" selected>BID DOCS</option>
                                            <option value="NOTARIAL FEE">NOTARIAL FEE</option>
                                            <option value="PERFORMANCE BOND">PERFORMANCE BOND</option>
                                            <option value="SOP FEE">SOP FEE</option>
                                            <option value="OTHER EXPENSES">OTHER EXPENSES</option>
                                        <?PHP }
                                        if ($row["expense_type"] == 'NOTARIAL FEE') { ?>
                                            <option value="BID DOCS">BID DOCS</option>
                                            <option value="NOTARIAL FEE" selected>NOTARIAL FEE</option>
                                            <option value="PERFORMANCE BOND">PERFORMANCE BOND</option>
                                            <option value="SOP FEE">SOP FEE</option>
                                            <option value="OTHER EXPENSES">OTHER EXPENSES</option>
                                        <?PHP }
                                        if ($row["expense_type"] == 'PERFORMANCE BOND') { ?>
                                            <option value="BID DOCS">BID DOCS</option>
                                            <option value="NOTARIAL FEE">NOTARIAL FEE</option>
                                            <option value="PERFORMANCE BOND" selected>PERFORMANCE BOND</option>
                                            <option value="SOP FEE">SOP FEE</option>
                                            <option value="OTHER EXPENSES">OTHER EXPENSES</option>
                                        <?PHP } 
                                        if ($row["expense_type"] == 'SOP FEE') { ?>
                                            <option value="BID DOCS">BID DOCS</option>
                                            <option value="NOTARIAL FEE">NOTARIAL FEE</option>
                                            <option value="PERFORMANCE BOND">PERFORMANCE BOND</option>
                                            <option value="SOP FEE" selected>SOP FEE</option>
                                            <option value="OTHER EXPENSES">OTHER EXPENSES</option>
                                        <?PHP } 
                                        if ($row["expense_type"] == 'OTHER EXPENSES') { ?>
                                            <option value="BID DOCS">BID DOCS</option>
                                            <option value="NOTARIAL FEE">NOTARIAL FEE</option>
                                            <option value="PERFORMANCE BOND">PERFORMANCE BOND</option>
                                            <option value="SOP FEE">SOP FEE</option>
                                            <option value="OTHER EXPENSES" selected>OTHER EXPENSES</option>
                                        <?PHP }?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="totalAmount" class="form-label">Total Amount</label>
                                    <input type="text" class="form-control" id="totalAmount" name="total_amount" value="<?= $row["total_amount"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="remarksUpdate" class="form-label">Remarks Update</label>
                                    <textarea class="w-100 p-2" id="remarksUpdate" name="remarks" style="height: 200px" placeholder="Remarks"><?= $row["remarks"] ?></textarea>
                                </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $expenseId ?>" name="expense_id">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_expense">Update Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>