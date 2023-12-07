<div class="modal fade" id="updatePositionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="positions" method="post">
                            <?php
                                $fetchPositionById = $positionsFacade->fetchPositionById($positionId);
                                while ($row = $fetchPositionById->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="mb-3">
                                    <label for="positionName" class="form-label">Position Name</label>
                                    <input type="text" class="form-control" id="positionName" name="position_name" value="<?= $row["position_name"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="positionCode" class="form-label">Position Code</label>
                                    <input type="text" class="form-control" id="positionCode" name="position_code" value="<?= $row["position_code"] ?>">
                                </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $positionId ?>" name="position_id">
                            <button type="submit" class="btn btn-primary" name="update_position">Update Position</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>