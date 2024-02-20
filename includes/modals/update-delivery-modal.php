<div class="modal fade" id="updateDeliveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="deliveries" method="post">
                        <div class="card-body">
                            <?php
                            $fetchDeliveryById = $deliveriesFacade->fetchDeliveryById($deliveryId);
                            while ($row = $fetchDeliveryById->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="mb-3">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <select class="form-select" id="projectNameUpdate" name="project_name">
                                        <option value="">Please Select...</option>
                                        <?php
                                        $fetchBiddingInformaion = $biddingInformationFacade->fetchBiddingInformation();
                                        while ($bidding = $fetchBiddingInformaion->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?= $bidding["project_name"] ?>"><?= $bidding["project_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="projectTypeId" class="form-label">Project Type</label>
                                    <select class="form-select" id="projectTypeIdUpdate" name="project_type_id"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="LGUId" class="form-label">LGU Name</label>
                                    <select class="form-select" id="LGUIdUpdate" name="lgu_id"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="projectPOList" class="form-label">Project PO List</label>
                                    <select class="form-select" id="projectPOListUpdate" name="project_po_list"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="PONumber" class="form-label">PO Number</label>
                                    <select class="form-select" id="PONumberUpdate" name="po_number"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="DRNumber" class="form-label">DR Number</label>
                                    <input type="text" class="form-control" id="DRNumber" name="dr_number" value="<?= $row["dr_no"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="DRDate" class="form-label">DR Date (mm/dd/yyyy)</label>
                                    <input type="text" class="form-control" id="DRDate" name="dr_date" value="<?= $row["dr_date"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="totalQuantity" class="form-label">Total Quantity</label>
                                    <select class="form-select" id="totalQuantityUpdate" name="total_quantity"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="totalAmount" class="form-label">Total Amount</label>
                                    <select class="form-select" id="totalAmountUpdate" name="total_amount"></select>
                                </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $deliveryId ?>" name="delivery_id">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_delivery">Update Delivery</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>