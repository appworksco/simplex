<div class="modal fade" id="updatePaymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="paymentMode" class="form-label">Payment Mode</label>
                            <select class="form-select" id="paymentMode" onchange="paymentMode(this)">
                                <option value="0">Please Select...</option>
                                <option value="1">Full Payment</option>
                                <option value="2">Partial Payment</option>
                            </select>
                        </div>
                    </div>

                    <!-- <form action="payments" method="post"> -->

                    <?php
                    $fetchPaymentById = $paymentFacade->fetchPaymentById($paymentId);
                    while ($row = $fetchPaymentById->fetch(PDO::FETCH_ASSOC)) { ?>

                        <input type="hidden" value="<?= $row["po_no"] ?>" name="po_number">
                        <input type="hidden" value="<?= $paymentId ?>" name="payment_id">

                        <form action="add-payment-full" method="post">
                            <!-- If payment mode is full payment -->
                            <div id="fullPayment" style="display:none;">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="billNumber" class="form-label">Bill Number</label>
                                        <input type="text" class="form-control" id="billNumber" name="bill_number" value="<?= $row["bill_no"] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="billDate" class="form-label">Bill Date</label>
                                        <div class="input-group date datepicker">
                                            <input type="text" class="form-control" id="billDate" name="bill_date" value="<?= $row["bill_date"] ?>" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="paymentDate" class="form-label">Payment Date</label>
                                        <div class="input-group date datepicker">
                                            <input type="text" class="form-control" id="paymentDate" name="payment_date" value="<?= $row["payment_date"] ?>" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="paymentAmount" class="form-label">Payment Amount</label>
                                        <input type="text" class="form-control" id="paymentAmount" name="payment_amount" value="<?= $row["bill_amount"] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="paymentReceiptNumber" class="form-label">Payment Receipt Number</label>
                                        <input type="text" class="form-control" id="paymentReceiptNumber" name="payment_receipt_number" value="<?= $row["payment_receipt_number"] ?>">
                                    </div>
                                    <input type="hidden" name="bm_no" value="<?= $row["bm_no"] ?>">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" name="full_payment">Update Payment</button>
                                </div>
                            </div>
                        </form>

                        <form action="add-payment-partial" method="post">
                            <!-- If payment mode is partial payment -->
                            <div id="partialPayment" style="display:none;">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        1st Payment
                                                        <?php if ($row["1st_bill_no"] != NULL) { ?>
                                                            <span class="text-success ms-2">Paid</span>
                                                        <?php } ?>
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="p-3">
                                                        <div class="mb-3">
                                                            <label for="1stBillNumber" class="form-label">Bill Number</label>
                                                            <input type="text" class="form-control" id="1stBillNumber" name="1st_bill_number" value="<?= $row["1st_bill_no"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="1stPaymentMode" class="form-label">Payment Mode</label>
                                                            <select class="form-select" name="1st_payment_mode" id="1stPaymentMode">
                                                                <?php if ($row["1st_payment_mode"] == NULL) { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["1st_payment_mode"] == 'Advance Payment') { ?>
                                                                    <option value="Advance Payment" selected>Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["1st_payment_mode"] == 'Partial Payment') { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment" selected>Partial Payment</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="1stPaymentDate" class="form-label">Payment Date (mm/dd/yyyy)</label>
                                                            <div class="input-group date datepicker">
                                                                <input type="text" class="form-control" id="1stPaymentDate" name="1st_payment_date" value="<?= $row["1st_payment_date"] ?>" required>
                                                                <span class="input-group-append">
                                                                    <span class="input-group-text bg-light d-block">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="1stPaymentAmount" class="form-label">Payment Amount</label>
                                                            <input type="text" class="form-control" id="1stPaymentAmount" name="1st_payment_amount" value="<?= $row["1st_payment_amount"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="1stPaymentReceiptNumber" class="form-label">Payment Receipt Number</label>
                                                            <input type="text" class="form-control" id="1stPaymentReceiptNumber" name="1st_payment_receipt_number" value="<?= $row["1st_payment_receipt_number"] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        2nd Payment
                                                        <?php if ($row["2nd_bill_no"] != NULL) { ?>
                                                            <span class="text-success ms-2">Paid</span>
                                                        <?php } ?>
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="p-3">
                                                        <div class="mb-3">
                                                            <label for="2ndBillNumber" class="form-label">Bill Number</label>
                                                            <input type="text" class="form-control" id="2ndBillNumber" name="2nd_bill_number" value="<?= $row["2nd_bill_no"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="2ndPaymentMode" class="form-label">Payment Mode</label>
                                                            <select class="form-select" name="2nd_payment_mode" id="2ndPaymentMode">
                                                                <?php if ($row["2nd_payment_mode"] == NULL) { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["2nd_payment_mode"] == 'Advance Payment') { ?>
                                                                    <option value="Advance Payment" selected>Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["2nd_payment_mode"] == 'Partial Payment') { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment" selected>Partial Payment</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="2ndPaymentDate" class="form-label">Payment Date (mm/dd/yyyy)</label>
                                                            <input type="text" class="form-control" id="2ndPaymentDate" name="2nd_payment_date" value="<?= $row["2nd_payment_date"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="2ndPaymentAmount" class="form-label">Payment Amount</label>
                                                            <input type="text" class="form-control" id="2ndPaymentAmount" name="2nd_payment_amount" value="<?= $row["2nd_payment_amount"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="2ndPaymentReceiptNumber" class="form-label">Payment Receipt Number</label>
                                                            <input type="text" class="form-control" id="2ndPaymentReceiptNumber" name="2nd_payment_receipt_number" value="<?= $row["2nd_payment_receipt_number"] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        3rd Payment
                                                        <?php if ($row["3rd_bill_no"] != NULL) { ?>
                                                            <span class="text-success ms-2">Paid</span>
                                                        <?php } ?>
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="p-3">
                                                        <div class="mb-3">
                                                            <label for="3rdBillNumber" class="form-label">Bill Number</label>
                                                            <input type="text" class="form-control" id="3rdBillNumber" name="3rd_bill_number" value="<?= $row["3rd_bill_no"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="3rdPaymentMode" class="form-label">Payment Mode</label>
                                                            <select class="form-select" name="3rd_payment_mode" id="3rdPaymentMode">
                                                                <?php if ($row["3rd_payment_mode"] == NULL) { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["3rd_payment_mode"] == 'Advance Payment') { ?>
                                                                    <option value="Advance Payment" selected>Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["3rd_payment_mode"] == 'Partial Payment') { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment" selected>Partial Payment</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="3rdPaymentDate" class="form-label">Payment Date (mm/dd/yyyy)</label>
                                                            <input type="text" class="form-control" id="3rdPaymentDate" name="3rd_payment_date" value="<?= $row["3rd_payment_date"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="3rdPaymentAmount" class="form-label">Payment Amount</label>
                                                            <input type="text" class="form-control" id="3rdPaymentAmount" name="3rd_payment_amount" value="<?= $row["3rd_payment_amount"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="3rdPaymentReceiptNumber" class="form-label">Payment Receipt Number</label>
                                                            <input type="text" class="form-control" id="3rdPaymentReceiptNumber" name="3rd_payment_receipt_number" value="<?= $row["3rd_payment_receipt_number"] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                        4th Payment
                                                        <?php if ($row["4th_bill_no"] != NULL) { ?>
                                                            <span class="text-success ms-2">Paid</span>
                                                        <?php } ?>
                                                    </button>
                                                </h2>
                                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                    <div class="p-3">
                                                        <div class="mb-3">
                                                            <label for="4thBillNumber" class="form-label">Bill Number</label>
                                                            <input type="text" class="form-control" id="4thBillNumber" name="4th_bill_number" value="<?= $row["4th_bill_no"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="4thPaymentMode" class="form-label">Payment Mode</label>
                                                            <select class="form-select" name="4th_payment_mode" id="4thPaymentMode">
                                                                <?php if ($row["4th_payment_mode"] == NULL) { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["4th_payment_mode"] == 'Advance Payment') { ?>
                                                                    <option value="Advance Payment" selected>Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["4th_payment_mode"] == 'Partial Payment') { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment" selected>Partial Payment</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="4thPaymentDate" class="form-label">Payment Date (mm/dd/yyyy)</label>
                                                            <input type="text" class="form-control" id="4thPaymentDate" name="4th_payment_date" value="<?= $row["4th_payment_date"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="4thPaymentAmount" class="form-label">Payment Amount</label>
                                                            <input type="text" class="form-control" id="4thPaymentAmount" name="4th_payment_amount" value="<?= $row["4th_payment_amount"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="4thPaymentReceiptNumber" class="form-label">Payment Receipt Number</label>
                                                            <input type="text" class="form-control" id="4thPaymentReceiptNumber" name="4th_payment_receipt_number" value="<?= $row["4th_payment_receipt_number"] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                        5th Payment
                                                        <?php if ($row["5th_bill_no"] != NULL) { ?>
                                                            <span class="text-success ms-2">Paid</span>
                                                        <?php } ?>
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                    <div class="p-3">
                                                        <div class="mb-3">
                                                            <label for="5thBillNumber" class="form-label">Bill Number</label>
                                                            <input type="text" class="form-control" id="5thBillNumber" name="5th_bill_number" value="<?= $row["5th_bill_no"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="5thPaymentMode" class="form-label">Payment Mode</label>
                                                            <select class="form-select" name="5th_payment_mode" id="5thPaymentMode">
                                                                <?php if ($row["5th_payment_mode"] == NULL) { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["5th_payment_mode"] == 'Advance Payment') { ?>
                                                                    <option value="Advance Payment" selected>Advance Payment</option>
                                                                    <option value="Partial Payment">Partial Payment</option>
                                                                <?php }
                                                                if ($row["5th_payment_mode"] == 'Partial Payment') { ?>
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Partial Payment" selected>Partial Payment</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="5thPaymentDate" class="form-label">Payment Date (mm/dd/yyyy)</label>
                                                            <input type="text" class="form-control" id="5thPaymentDate" name="5th_payment_date" value="<?= $row["5th_payment_date"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="5thPaymentAmount" class="form-label">Payment Amount</label>
                                                            <input type="text" class="form-control" id="5thPaymentAmount" name="5th_payment_amount" value="<?= $row["5th_payment_amount"] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="5thPaymentReceiptNumber" class="form-label">Payment Receipt Number</label>
                                                            <input type="text" class="form-control" id="5thPaymentReceiptNumber" name="5th_payment_receipt_number" value="<?= $row["5th_payment_receipt_number"] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="partial_payment">Update Payment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>