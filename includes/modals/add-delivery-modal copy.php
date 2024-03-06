<div class="modal fade" id="addDeliveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="deliveries" method="post">
                        <div class="card-body">

                            <!-- Delivery type -->
                            <div class="mb-3">
                                <label for="deliveryType" class="form-label">Delivery Type</label>
                                <select class="form-select" id="deliveryType" name="delivery_type">
                                    <option value="0">Please Select...</option>
                                    <option value="1">Single PO - Single Delivery</option>
                                    <option value="2">Multiple PO - Single Delivery</option>
                                    <option value="3">Single PO - Multiple Delivery</option>
                                </select>
                            </div>

                            <!-- Single PO - Single Delivery -->
                            <div id="singlePOsingleDelivery" style="display: none;">
                                <div class="mb-3">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <select class="form-select" id="projectName" name="project_name">
                                        <option value="">Please Select...</option>
                                        <?php
                                        $fetchPO = $POFacade->fetchPO();
                                        while ($row = $fetchPO->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="BMNoId" class="form-label">BM Number</label>
                                    <select class="form-select" id="BMNoId" name="bm_no"></select>
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
                                    <label for="projectPOList" class="form-label">Project PO List</label>
                                    <select class="form-select" id="projectPOList" name="project_po_list"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="PONumber" class="form-label">PO Number</label>
                                    <select class="form-select" id="PONumber" name="po_number"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="DRNumber" class="form-label">DR Number</label>
                                    <input type="text" class="form-control" id="DRNumber" name="dr_number">
                                </div>
                                <div class="mb-3">
                                    <label for="DRDate" class="form-label">DR Date (mm/dd/yyyy)</label>
                                    <input type="text" class="form-control" id="DRDate" name="dr_date">
                                </div>

                                <!-- Has multiple delivery -->
                                <div class="mb-3">
                                    <label for="hasMultipleDelivery" class="form-label">Has Multiple Delivery</label>
                                    <select class="form-select" id="hasMultipleDelivery" name="has_multiple_delivery">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>

                                <!-- Has multiple delivery -->
                                <div id="hasMultipleDeliveryYes">
                                    <div class="mb-3">
                                        <label for="totalQuantityCustom" class="form-label">Total Quantity</label>
                                        <input type="text" class="form-select" id="totalQuantityCustom" name="total_quantity_custom">
                                    </div>
                                    <div class="mb-3">
                                        <label for="totalAmountCustom" class="form-label">Total Amount</label>
                                        <input type="text" class="form-select" id="totalAmountCustom" name="total_amount_custom">
                                    </div>
                                </div>

                                <!-- No multiple delivery -->
                                <div id="noMultipleDeliveryNo" style="display: none">
                                    <div class="mb-3">
                                        <label for="totalQuantity" class="form-label">Total Quantity</label>
                                        <select class="form-select" id="totalQuantity" name="total_quantity"></select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="totalAmount" class="form-label">Total Amount</label>
                                        <select class="form-select" id="totalAmount" name="total_amount"></select>
                                    </div>
                                </div>
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