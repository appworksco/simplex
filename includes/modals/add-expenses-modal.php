<div class="modal fade" id="addExpensesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="expenses" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="projectName" class="form-label">Project Name</label>
                                <select class="form-select" id="projectName" name="project_name" required>
                                    <option value="">Please Select...</option>
                                    <?php
                                    $fetchBiddingInformaion = $biddingInformationFacade->fetchBiddingInformation();
                                    while ($row = $fetchBiddingInformaion->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="BMNoId" class="form-label">BM Number</label>
                                <select class="form-select" id="BMNoId" name="bm_no" required></select>
                            </div>
                            <div class="mb-3">
                                <label for="projectTypeId" class="form-label">Project Type</label>
                                <select class="form-select" id="projectTypeId" name="project_type_id" required></select>
                            </div>
                            <div class="mb-3">
                                <label for="LGUId" class="form-label">LGU Name</label>
                                <select class="form-select" id="LGUId" name="lgu_id" required></select>
                            </div>
                            <div class="mb-3">
                                <label for="expenseType" class="form-label">Expense Type</label>
                                <select class="form-select" id="expenseType" name="expense_type" required>
                                    <option value="BID DOCS">BID DOCS</option>
                                    <option value="NOTARIAL FEE">NOTARIAL FEE</option>
                                    <option value="PERFORMANCE BOND">PERFORMANCE BOND</option>
                                    <option value="SOP FEE">SOP FEE</option>
                                    <option value="OTHER EXPENSES">OTHER EXPENSES</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="totalAmount" class="form-label">Total Amount</label>
                                <input type="text" class="form-control" id="totalAmount" name="total_amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="w-100 p-2" id="remarks" name="remarks" style="height: 200px"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_expense">Add Expense</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>