<div class="modal fade" id="addDeliveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <!-- <form action="deliveries" method="post"> -->
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

                        <form action="add-delivery-spsd" method="post">
                            <!-- Single PO - Single Delivery -->
                            <div id="singlePOsingleDelivery" style="display: none;">
                                <div class="mb-3">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <select class="form-select" id="projectName" name="project_name_spsd">
                                        <option value="">Please Select...</option>
                                        <?php
                                        $fetchPO = $POFacade->fetchPODeliveries();
                                        while ($row = $fetchPO->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="BMNoId" class="form-label">BM Number</label>
                                    <select class="form-select" id="BMNoId" name="bm_no_spsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="projectTypeId" class="form-label">Project Type</label>
                                    <select class="form-select" id="projectTypeId" name="project_type_id_spsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="LGUId" class="form-label">LGU Name</label>
                                    <select class="form-select" id="LGUId" name="lgu_id_spsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="projectPOList" class="form-label">Project PO List</label>
                                    <select class="form-select" id="projectPOList" name="project_po_list_spsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="PONumber" class="form-label">PO Number</label>
                                    <select class="form-select" id="PONumber" name="po_number_spsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="DRNumber" class="form-label">DR Number</label>
                                    <input type="text" class="form-control" id="DRNumber" name="dr_number_spsd" required>
                                </div>
                                <div class="mb-3">
                                    <label for="DRDateSpsd" class="form-label">DR Date</label>
                                    <div class="input-group date datepicker">
                                        <input type="text" class="form-control" id="DRDateSpsd" name="dr_date_spsd" required>
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="totalQuantity" class="form-label">Total Quantity</label>
                                    <select class="form-select" id="totalQuantity" name="total_quantity_spsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="totalAmount" class="form-label">Total Amount</label>
                                    <select class="form-select" id="totalAmount" name="total_amount_spsd"></select>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="add_delivery_spsd">Add Delivery</button>
                                </div>
                            </div>
                        </form>

                        <form action="add-delivery-mpsd" method="post">
                            <!-- Multiple PO - Single Delivery -->
                            <div id="multiplePOsingleDelivery" style="display: none;">
                                <div class="mb-3">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <select class="form-select" id="projectNameMpsd" name="project_name_mpsd">
                                        <option value="">Please Select...</option>
                                        <?php
                                        $fetchPO = $POFacade->fetchPODeliveries();
                                        while ($row = $fetchPO->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="BMNoId" class="form-label">BM Number</label>
                                    <select class="form-select" id="BMNoIdMpsd" name="bm_no_mpsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="projectTypeId" class="form-label">Project Type</label>
                                    <select class="form-select" id="projectTypeIdMpsd" name="project_type_id_mpsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="LGUId" class="form-label">LGU Name</label>
                                    <select class="form-select" id="LGUIdMpsd" name="lgu_id_mpsd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="1stPOList" class="form-label">1st PO</label>
                                    <select class="form-select" id="1stPOList" name="1st_po"></select>
                                    <select class="d-none" id="1stPONumber" name="1st_po_number"></select>
                                    <select class="d-none" id="1stTotalQuantity" name="1st_total_quantity"></select>
                                    <select class="d-none" id="1stTotalAmount" name="1st_total_amount"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="2ndPOList" class="form-label">2nd PO</label>
                                    <select class="form-select" id="2ndPOList" name="2nd_po"></select>
                                    <select class="d-none" id="2ndPONumber" name="2nd_po_number"></select>
                                    <select class="d-none" id="2ndTotalQuantity" name="2nd_total_quantity"></select>
                                    <select class="d-none" id="2ndTotalAmount" name="2nd_total_amount"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="3rdPOList" class="form-label">3rd PO</label>
                                    <select class="form-select" id="3rdPOList" name="3rd_po"></select>
                                    <select class="d-none" id="3rdPONumber" name="3rd_po_number"></select>
                                    <select class="d-none" id="3rdTotalQuantity" name="3rd_total_quantity"></select>
                                    <select class="d-none" id="3rdTotalAmount" name="3rd_total_amount"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="4thPOList" class="form-label">4th PO</label>
                                    <select class="form-select" id="4thPOList" name="4th_po"></select>
                                    <select class="d-none" id="4thPONumber" name="4th_po_number"></select>
                                    <select class="d-none" id="4thTotalQuantity" name="4th_total_quantity"></select>
                                    <select class="d-none" id="4thTotalAmount" name="4th_total_amount"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="5thPOList" class="form-label">5th PO</label>
                                    <select class="form-select" id="5thPOList" name="5th_po"></select>
                                    <select class="d-none" id="5thPONumber" name="5th_po_number"></select>
                                    <select class="d-none" id="5thTotalQuantity" name="5th_total_quantity"></select>
                                    <select class="d-none" id="5thTotalAmount" name="5th_total_amount"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="DRNumber" class="form-label">DR Number</label>
                                    <input type="text" class="form-control" id="DRNumber" name="dr_number_mpsd" required>
                                </div>
                                <div class="mb-3">
                                    <label for="DRDateMpsd" class="form-label">DR Date</label>
                                    <div class="input-group date datepicker">
                                        <input type="text" class="form-control" id="DRDateMpsd" name="dr_date_mpsd" required>
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="add_delivery_mpsd">Add Delivery</button>
                                </div>
                            </div>
                        </form>

                        <form action="add-delivery-spmd" method="post">
                            <!-- Single PO - Multiple Delivery -->
                            <div id="singlePOmultipleDelivery" style="display: none;">
                                <div class="mb-3">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <select class="form-select" id="projectNameSpmd" name="project_name_spmd">
                                        <option value="">Please Select...</option>
                                        <?php
                                        $fetchPO = $POFacade->fetchPODeliveries();
                                        while ($row = $fetchPO->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="BMNoId" class="form-label">BM Number</label>
                                    <select class="form-select" id="BMNoIdSpmd" name="bm_no_spmd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="projectTypeId" class="form-label">Project Type</label>
                                    <select class="form-select" id="projectTypeIdSpmd" name="project_type_id_spmd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="LGUId" class="form-label">LGU Name</label>
                                    <select class="form-select" id="LGUIdSpmd" name="lgu_id_spmd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="projectPOListSpmd" class="form-label">Project PO List</label>
                                    <select class="form-select" id="projectPOListSpmd" name="project_po_list_spmd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="PONumber" class="form-label">PO Number</label>
                                    <select class="form-select" id="PONumberSpmd" name="po_number_spmd"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="DRNumber" class="form-label">DR Number</label>
                                    <input type="text" class="form-control" id="DRNumberSpmd" name="dr_number_spmd" required>
                                </div>
                                <div class="mb-3">
                                    <label for="DRDateSpmd" class="form-label">DR Date</label>
                                    <div class="input-group date datepicker">
                                        <input type="text" class="form-control" id="DRDateSpmd" name="dr_date_spmd" required>
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="totalQuantitySpmd" class="form-label">Total Quantity</label>
                                    <input type="number" class="form-control" id="totalQuantitySpmd" name="total_quantity_spmd" required>
                                </div>
                                <div class="mb-3">
                                    <label for="totalAmountSpmd" class="form-label">Total Amount</label>
                                    <input type="number" class="form-control" id="totalAmountSpmd" name="total_amount_spmd" required>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="add_delivery_spmd">Add Delivery</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>