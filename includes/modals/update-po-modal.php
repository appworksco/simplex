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
                                    <label for="projectName" class="form-label">Project Name - <span class="text-info"><?= $row["project_name"] ?></span></label>
                                    <?php
                                    if ($row["bm_no"] == NULL) { ?>
                                        <select class="form-select" id="updateProjectName" name="project_name">
                                            <option value="">Please Select...</option>
                                            <?php
                                            $fetchBiddingInformaion = $biddingInformationFacade->fetchBiddingInformation();
                                            while ($bidding = $fetchBiddingInformaion->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?= $bidding["project_name"] ?>"><?= $bidding["project_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <select class="form-select" id="updateProjectName" name="project_name">
                                            <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <label for="BMNoId" class="form-label">BM Number</label>
                                    <?php
                                    if ($row["bm_no"] == NULL) { ?>
                                        <select class="form-select" id="updateBMNoId" name="bm_no"></select>
                                    <?php } else { ?>
                                        <select class="form-select" id="updateBMNoId" name="bm_no">
                                            <option value="<?= $row["bm_no"] ?>"><?= $row["bm_no"] ?></option>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <label for="projectTypeId" class="form-label">Project Type</label>
                                    <?php
                                    if ($row["project_type_id"] == NULL) { ?>
                                        <select class="form-select" id="updateLGUId" name="project_type_id"></select>
                                    <?php } else { ?>
                                        <select class="form-select" id="updateLGUId" name="project_type_id">

                                            <?php

                                            // Establish connection to MySQL database
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $dbname = "one_centro";
                                            $conn = new mysqli($servername, $username, $password, $dbname);

                                            // Check connection
                                            if ($conn->connect_error) {
                                                die("Connection failed: " . $conn->connect_error);
                                            }

                                            $projectTypeId = $row["project_type_id"];
                                            $fetchProjectTypeById = "SELECT * FROM bd_project_type WHERE id = '$projectTypeId'";
                                            $fetchProjectTypeById = mysqli_query($conn, $fetchProjectTypeById);
                                            while ($projectType = mysqli_fetch_assoc($fetchProjectTypeById)) {
                                                $out .= '<option value="' . $projectType["id"] . '">' . $projectType["project_description"] . '</option>';
                                            }

                                            echo $out;

                                            ?>

                                        </select>

                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <label for="LGUId" class="form-label">LGU Name</label>
                                    <?php
                                    if ($row["lgu_id"] == NULL) { ?>
                                        <select class="form-select" id="updateLGUId" name="lgu_id"></select>
                                    <?php } else { ?>
                                        <select class="form-select" id="updateLGUId" name="lgu_id">

                                            <?php

                                            // Establish connection to MySQL database
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $dbname = "one_centro";
                                            $conn = new mysqli($servername, $username, $password, $dbname);

                                            // Check connection
                                            if ($conn->connect_error) {
                                                die("Connection failed: " . $conn->connect_error);
                                            }

                                            $LGUId = $row["lgu_id"];
                                            $fetchLGUById = "SELECT * FROM bd_lgu WHERE id = '$LGUId'";
                                            $fetchLGUById= mysqli_query($conn, $fetchLGUById);
                                            while ($LGU = mysqli_fetch_assoc($fetchLGUById)) {
                                                $out .= '<option selected value="' . $LGU["id"] . '">' . $LGU["lgu_name"] . '</option>';
                                            }

                                            echo $out;

                                            ?>

                                        </select>

                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <label for="PODate" class="form-label">PO Date</label>
                                    <div class="input-group date datepicker">
                                        <input type="text" class="form-control" id="PODate" name="po_date" value="<?= $row["po_date"] ?>" required>
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-light d-block">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
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