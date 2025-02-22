<div class="modal fade" id="addBiddingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Bidding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="bidding-information" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="biddingDate" class="form-label">Bidding Date</label>
                                <div class="input-group date datepicker">
                                    <input type="text" class="form-control" id="biddingDate" name="bidding_date" required>
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-light d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="projectName" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="projectName" name="project_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="projectTypeId" class="form-label">Project Type</label>
                                <select class="form-select" id="projectTypeId" name="project_type_id" required>
                                    <?php
                                    $fetchProjectType = $projectTypeFacade->fetchProjectType();
                                    while ($row = $fetchProjectType->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row["id"] ?>"><?= $row["project_description"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="LGUId" class="form-label">LGU Name</label>
                                <select class="form-select" id="LGUId" name="lgu_id" required>
                                    <?php
                                    $fetchLGU = $LGUFacade->fetchLGU();
                                    while ($row = $fetchLGU->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row["id"] ?>"><?= $row["lgu_name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="projectBudgetAmount" class="form-label">Project Budget Amount</label>
                                <input type="text" class="form-control" id="projectBudgetAmount" name="project_budget_amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="totalSKUQuantity" class="form-label">Total SKU Quantity</label>
                                <input type="text" class="form-control" id="totalSKUQuantity" name="total_sku_quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="totalQuantity" class="form-label">Total Quantity</label>
                                <input type="text" class="form-control" id="totalQuantity" name="total_quantity" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_bidding">Add Bidding</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>