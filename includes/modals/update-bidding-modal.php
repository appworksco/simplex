<div class="modal fade" id="updateBiddingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Bidding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="bidding-information" method="post">
                        <div class="card-body">
                            <?php
                            $fetchBiddingById = $biddingInformationFacade->fetchBiddingById($biddingId);
                            while ($row = $fetchBiddingById->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="biddingDate" class="form-label">Bidding Date (mm/dd/yyyy)</label>
                                            <input type="text" class="form-control" id="biddingDate" name="bidding_date" value="<?= $row["bid_date"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="projectName" class="form-label">Project Name</label>
                                            <input type="text" class="form-control" id="projectName" name="project_name" value="<?= $row["project_name"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="projectTypeId" class="form-label">Project Type</label>
                                            <select class="form-select" id="projectTypeId" name="project_type_id">
                                                <?php
                                                $fetchProjectType = $projectTypeFacade->fetchProjectType();
                                                while ($projectType = $fetchProjectType->fetch(PDO::FETCH_ASSOC)) {
                                                    if ($row["project_type_id"] == $projectType["id"]) { ?>
                                                        <option value="<?= $projectType["id"] ?>" selected><?= $projectType["project_description"] ?></option>
                                                    <?php } else {  ?>
                                                        <option value="<?= $projectType["id"] ?>"><?= $projectType["project_description"] ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="LGUId" class="form-label">LGU Name</label>
                                            <select class="form-select" id="LGUId" name="lgu_id">
                                                <?php
                                                $fetchLGU = $LGUFacade->fetchLGU();
                                                while ($LGU = $fetchLGU->fetch(PDO::FETCH_ASSOC)) {
                                                    if ($row["lgu_id"] == $LGU["id"]) { ?>
                                                        <option value="<?= $LGU["id"] ?>" selected><?= $LGU["lgu_name"] ?></option>
                                                    <?php } else {  ?>
                                                        <option value="<?= $LGU["id"] ?>"><?= $LGU["lgu_name"] ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="projectStatus" class="form-label">Project Status</label>
                                            <select class="form-select" id="projectStatus" name="project_status">
                                                <?php
                                                if ($row["project_status"] == 'Won') { ?>
                                                    <option value="Won" selected>Won</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Lost">Lost</option>
                                                    <option value="Disqualified">Disqualified</option>
                                                    <option value="Re-bid">Re-bid</option>
                                                <?php }
                                                if ($row["project_status"] == 'Cancelled') { ?>
                                                    <option value="Won">Won</option>
                                                    <option value="Cancelled" selected>Cancelled</option>
                                                    <option value="Lost">Lost</option>
                                                    <option value="Disqualified">Disqualified</option>
                                                    <option value="Re-bid">Re-bid</option>
                                                <?php }
                                                if ($row["project_status"] == 'Lost') { ?>
                                                    <option value="Won">Won</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Lost" selected>Lost</option>
                                                    <option value="Disqualified">Disqualified</option>
                                                    <option value="Re-bid">Re-bid</option>
                                                <?php }
                                                if ($row["project_status"] == 'Disqualified') { ?>
                                                    <option value="Won">Won</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Lost">Lost</option>
                                                    <option value="Disqualified" selected>Disqualified</option>
                                                    <option value="Re-bid">Re-bid</option>
                                                <?php }
                                                if ($row["project_status"] == 'Re-bid') { ?>
                                                    <option value="Won">Won</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Lost">Lost</option>
                                                    <option value="Disqualified">Disqualified</option>
                                                    <option value="Re-bid" selected>Re-bid</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="paymentStructure" class="form-label">Payment Structure</label>
                                            <select class="form-select" id="paymentStructure" name="payment_structure">
                                                <?php
                                                if ($row["payment_structure"] == 'Progressive') { ?>
                                                    <option value="Progressive" selected>Progressive</option>
                                                    <option value="Upon Completion">Upon Completion</option>
                                                <?php }
                                                if ($row["payment_structure"] == 'Upon Completion') { ?>
                                                    <option value="Progressive">Progressive</option>
                                                    <option value="Upon Completion" selected>Upon Completion</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="projectBudgetAmount" class="form-label">Project Budget Amount</label>
                                            <input type="text" class="form-control" id="projectBudgetAmount" name="project_budget_amount" value="<?= $row["project_budget_amount"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="awardDate" class="form-label">Award Date (mm/dd/yyyy)</label>
                                            <input type="text" class="form-control" id="awardDate" name="award_date" value="<?= $row["award_date"] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="deliveryTargetMonth" class="form-label">Delivery Target Month</label>
                                            <select class="form-select" id="deliveryTargetMonth" name="delivery_target_month">
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <textarea class="w-100 p-2" id="remarks" name="remarks" style="height: 200px"><?= $row["remarks"] ?></textarea>
                                        </div>
                                    </div>
                                <?php } ?>
                                <input type="hidden" value="<?= $biddingId ?>" name="bidding_id">
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_bidding">Update Bidding</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>