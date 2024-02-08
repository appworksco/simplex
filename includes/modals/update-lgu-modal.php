<div class="modal fade" id="updateLGUModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update LGU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="lgu" method="post">
                        <div class="card-body">
                            <?php
                            $fetchLGUById = $LGUFacade->fetchLGUById($LGUId);
                            while ($row = $fetchLGUById->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="mb-3">
                                    <label for="lguCode" class="form-label">LGU Code</label>
                                    <input type="text" class="form-control" id="lguCode" name="lgu_code" value="<?= $row["lgu_code"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="lguName" class="form-label">LGU Name</label>
                                    <input type="text" class="form-control" id="lguNmae" name="lgu_name" value="<?= $row["lgu_name"] ?>">
                                </div>
                                <div class="mb-3">
                                <label for="municipalityId" class="form-label">Municipality</label>
                                <select class="form-select" id="municipalityId" name="municipality_id">
                                    <?php
                                    $fetchMunicipalities = $municipalitiesFacade->fetchMunicipalities();
                                    while ($row = $fetchMunicipalities->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?= $row["id"] ?>"><?= $row["municipality_name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $LGUId ?>" name="lgu_id">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_lgu">Update LGU</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>