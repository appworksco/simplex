<div class="modal fade" id="updatePOModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Purchase Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="card-body">
                            <?php
                            $fetchPOById = $POFacade->fetchPOById($POId);
                            while ($row = $fetchPOById->fetch(PDO::FETCH_ASSOC)) { ?>
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
                                    <label for="PODate" class="form-label">PO Date (mm/dd/yyyy)</label>
                                    <input type="text" class="form-control" id="PODate" name="po_date" value="<?= $row["po_date"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="totalSKUAssortment" class="form-label">Total SKU Assortment</label>
                                    <input type="text" class="form-control" id="totalSKUAssortment" name="total_sku_assortment" value="<?= $row["total_sku_assortment"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="totalQuantity" class="form-label">Total Quantity</label>
                                    <input type="text" class="form-control" id="totalQuantity" name="total_quantity" value="<?= $row["total_sku_quantity"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="totalAmount" class="form-label">Total Amount</label>
                                    <input type="text" class="form-control" id="totalAmount" name="total_amount" value="<?= $row["total_amount"] ?>">
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="isConvertedUpdate" onclick="myFunctionUpdate()">
                                    <label for="isConvertedUpdate"> Is Converted</label>
                                </div>
                                <div class="mb-3">
                                    <textarea class="w-100 p-2" id="remarksUpdate" name="remarks" style="height: 200px; display:none" placeholder="Remarks"><?= $row["remarks"] ?></textarea>
                                </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $POId ?>" name="po_id">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_purchase_order">Update Purchase Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>