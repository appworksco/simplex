<div class="modal fade" id="updateTicketModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Assisting Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="cts" method="post">
                        <div class="card-body">
                            <?php
                            $fetchTicketById = $ctsFacade->fetchTicketById($ctsId);

                            while ($row = $fetchTicketById->fetch(PDO::FETCH_ASSOC)) {
                                $ticket_no = $row["ticket_no"];
                            ?>
                                <div class="mb-3">
                                    <label for="assistors_remark" class="form-label">Please leave a comment</label>
                                    <textarea class="form-control" id="assistors_remark" name="assistors_remark" rows="2"><?= $row["assistors_remark"] ?></textarea>
                                </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $ctsId ?>" name="cts_id">
                            <input type="hidden" value="<?= $status ?>" name="status">
                            <input type="hidden" value="<?= $ticket_no ?>" name="ticket_no">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_ticket">Done assisting? click this!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>