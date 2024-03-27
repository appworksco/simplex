<div class="modal fade" id="updateCareer" tabindex="-1" aria-labelledby="updateCareerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Career</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="careers" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php
                        $fetchCareerById = $webFacade->fetchCareerById($careerId);
                        while ($item = $fetchCareerById->fetch(PDO::FETCH_ASSOC)) { ?>
                            <input type="hidden" name="itemId" value="<?= $item["id"] ?>">      
                            <div class="mb-3">
                                <label for="job_position" class="form-label">Job Position</label>
                                <textarea class="form-control" id="mission" name="mission"><?= $item["job_position"] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="job_description" class="form-label">Job Description</label>
                                <textarea class="form-control" id="job_description" name="job_description"><?= $item["job_description"] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="job_requirement" class="form-label">Job Requirement</label>
                                <textarea class="form-control" id="job_requirement" name="job_requirement"><?= $item["job_requirement"] ?></textarea>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_career">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>