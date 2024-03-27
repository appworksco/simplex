<div class="modal fade" id="addCareer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="careers" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="job_position" class="form-label">Job Position</label>
                                <input type="text" class="form-control" id="job_position" name="job_position">
                            </div>
                            <div class="mb-3">
                                <label for="job_description" class="form-label">Job Description</label>
                                <textarea class="form-control" id="job_description" name="job_description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="job_requirement" class="form-label">Job Requirement</label>
                                <textarea class="form-control" id="job_requirement" name="job_requirement"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_career">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>