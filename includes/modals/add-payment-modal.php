<div class="modal fade" id="addPaymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="deliveries" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="projectName" class="form-label">Project Name</label>
                                <select class="form-select" id="projectName" name="project_name">
                                    <?php
                                    $fetchBiddingInformaion = $biddingInformationFacade->fetchBiddingInformation();
                                    while ($row = $fetchBiddingInformaion->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="projectTypeId" class="form-label">Project Type</label>
                                <select class="form-select" id="projectTypeId" name="project_type_id">
                                    <?php
                                    $fetchProjectType = $projectTypeFacade->fetchProjectType();
                                    while ($row = $fetchProjectType->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row["id"] ?>"><?= $row["project_description"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="LGUId" class="form-label">LGU Name</label>
                                <select class="form-select" id="LGUId" name="lgu_id">
                                    <?php
                                    $fetchLGU = $LGUFacade->fetchLGU();
                                    while ($row = $fetchLGU->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row["id"] ?>"><?= $row["lgu_name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="PONumber" class="form-label">PO Number</label>
                                <input type="text" class="form-control" id="PONumber" name="po_number">
                            </div>
                            <div class="mb-3">
                                <label for="DRNumber" class="form-label">DR Number</label>
                                <input type="text" class="form-control" id="DRNumber" name="dr_number">
                            </div>
                            <div class="mb-3">
                                <label for="DRDate" class="form-label">DR Date (mm/dd/yyyy)</label>
                                <input type="text" class="form-control" id="DRDate" name="dr_date">
                            </div>
                            <div class="mb-3">
                                <label for="totalQuantity" class="form-label">Total Quantity</label>
                                <input type="text" class="form-control" id="totalQuantity" name="total_quantity">
                            </div>
                            <div class="mb-3">
                                <label for="totalAmount" class="form-label">Total Amount</label>
                                <input type="text" class="form-control" id="totalAmount" name="total_amount">
                            </div>
                            <div class="mb-3">
                                <label for="billAmount" class="form-label">Bill Amount</label>
                                <input type="text" class="form-control" id="billAmount" name="bill_amount">
                            </div>
                            <div class="mb-3">
                                <label for="billAmount" class="form-label">Bill Amount</label>
                                <input type="text" class="form-control" id="billAmount" name="bill_amount">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_delivery">Add Delivery</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>