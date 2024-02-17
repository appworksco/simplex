<div class="modal fade" id="updatePaymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="payments" method="post">
                        <?php
                        $fetchPaymentById = $paymentFacade->fetchPaymentById($paymentId);
                        while ($row = $fetchPaymentById->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="billNumber" class="form-label">Bill Number</label>
                                    <input type="text" class="form-control" id="billNumber" name="bill_number">
                                </div>
                                <div class="mb-3">
                                    <label for="billDate" class="form-label">Bill Date (mm/dd/yyyy)</label>
                                    <input type="text" class="form-control" id="billDate" name="bill_date">
                                </div>
                                <div class="mb-3">
                                    <label for="paymentMode" class="form-label">Payment Mode</label>
                                    <select class="form-select" name="payment_mode" id="paymentMode">
                                        <option value="Full Payment">Full Payment</option>
                                        <option value="Partial Payment">Partial Payment</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="paymentDate" class="form-label">Payment Date (mm/dd/yyyy)</label>
                                    <input type="text" class="form-control" id="paymentDate" name="payment_date">
                                </div>
                                <div class="mb-3">
                                    <label for="paymentAmount" class="form-label">Payment Amount</label>
                                    <input type="text" class="form-control" id="paymentAmount" name="payment_amount">
                                </div>
                                <div class="mb-3">
                                    <label for="paymentReceiptNumber" class="form-label">Payment Receipt Number</label>
                                    <input type="text" class="form-control" id="paymentReceiptNumber" name="payment_receipt_number">
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title text-center text-danger">*** For Partial Payment Only ***</h6>
                                    <div class="mb-3">
                                        <label for="partialBillNumber" class="form-label">Bill Number</label>
                                        <input type="text" class="form-control" id="partialBillNumber" name="partial_bill_number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="partialPaymentMode" class="form-label">Payment Mode</label>
                                        <select class="form-select" name="partial_payment_mode" id="">
                                            <option value="Full Payment">Advance Payment</option>
                                            <option value="Partial Payment">Partial Payment</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="partialPaymentDate" class="form-label">Payment Date (mm/dd/yyyy)</label>
                                        <input type="text" class="form-control" id="partialPaymentDate" name="partial_payment_date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="partialPaymentAmount" class="form-label">Payment Amount</label>
                                        <input type="text" class="form-control" id="partialPaymentAmount" name="partial_payment_amount">
                                    </div>
                                    <div class="mb-3">
                                        <label for="partialPaymentReceiptNumber" class="form-label">Payment Receipt Number</label>
                                        <input type="text" class="form-control" id="partialPaymentReceiptNumber" name="partial_payment_receipt_number">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <input type="hidden" value="<?= $paymentId ?>" name="payment_id">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_payment">Update Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>