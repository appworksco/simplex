<div class="modal fade" id="addLGUModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add LGU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="lgu" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="LGUCode" class="form-label">LGU Code</label>
                                <input type="text" class="form-control" id="LGUCode" name="lgu_code">
                            </div>
                            <div class="mb-3">
                                <label for="LGUName" class="form-label">LGU Name</label>
                                <input type="text" class="form-control" id="LGUName" name="lgu_name">
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
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_lgu">Add LGU</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>