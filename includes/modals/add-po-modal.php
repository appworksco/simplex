<div class="modal fade" id="addPOModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Purchase Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="projectName" class="form-label">Project Name</label>
                                <select class="form-select" id="projectName" name="project_name">
                                    <?php
                                    $fetchBiddingInformaion = $biddingInformationFacade->fetchBiddingInformation();
                                    while ($row = $fetchBiddingInformaion->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="projectTypeId" class="form-label">Project Type</label>
                                <select class="form-select" id="projectTypeId" name="project_type_id"></select>
                            </div>
                            <div class="mb-3">
                                <label for="LGUId" class="form-label">LGU Name</label>
                                <select class="form-select" id="LGUId" name="lgu_id"></select>
                            </div>
                            <div class="mb-3">
                                <label for="PODate" class="form-label">PO Date (mm/dd/yyyy)</label>
                                <input type="text" class="form-control" id="PODate" name="po_date">
                            </div>
                            <div class="mb-3">
                                <label for="totalSKUAssortment" class="form-label">Total SKU Assortment</label>
                                <input type="text" class="form-control" id="totalSKUAssortment" name="total_sku_assortment">
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
                                <input type="checkbox" id="isConverted" onclick="myFunction()">
                                <label for="isConverted"> Is Converted</label>
                            </div>
                            <div class="mb-3">
                                <textarea class="w-100 p-2" id="remarks" name="remarks" style="height: 200px; display:none" placeholder="Remarks"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_purchase_order">Add Purchase Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>