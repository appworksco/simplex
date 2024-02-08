<div class="modal fade" id="updateMunicipalityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Municipality</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="municipality" method="post">
                        <div class="card-body">
                            <?php
                            $fetchMunicipalityById = $municipalitiesFacade->fetchMunicipalityById($municipalityId);
                            while ($row = $fetchMunicipalityById->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="mb-3">
                                    <label for="municipalityName" class="form-label">Municipality Name</label>
                                    <input type="text" class="form-control" id="municipalityName" name="municipality_name" value="<?= $row["municipality_name"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?= $row["address"] ?>">
                                </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $municipalityId ?>" name="municipality_id">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_municipality">Update Municipality</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>