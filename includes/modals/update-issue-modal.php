<div class="modal fade" id="updateIssueModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Issue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="issues" method="post">
                        <div class="card-body">
                            <?php
                            $fetchIssueById = $issuesFacade->fetchIssueById($issueId);
                            while ($row = $fetchIssueById->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="mb-3">
                                <label for="issue" class="form-label">Issue</label>
                                <input type="text" class="form-control" id="issue" name="issue" value="<?= $row["issue"] ?>">
                            </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $issueId ?>" name="issue_id">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_issue">Update Issue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>