<div class="modal fade" id="addTicketModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="cts" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="issue" class="form-label">Issue</label>
                                <select class="form-select" id="issue" name="issue">
                                    <?php 
                                    $fetchIssues = $issuesFacade->fetchIssues();
                                    while ($row = $fetchIssues->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row["issue"] ?>"><?= $row["issue"] ?></option>
                                    <?php } ?>    
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <textarea class="form-control" style="height: 20%" placeholder="What is your problem?" name="description"></textarea>
                            </div>
                            <label for="severity" class="form-label">Severity</label>
                            <select class="form-select" name="severity">
                                <option value="Low">Low</option>
                                <option value="Moderate">Moderate</option>
                                <option value="Major">Major</option>
                                <option value="Critical">Critical</option>
                            </select>
                            <br>
                            <div class="mb-3">
                                <label for="image" class="form-label">You can add an image here: </label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_ticket">Add Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>