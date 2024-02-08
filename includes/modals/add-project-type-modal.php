<div class="modal fade" id="addProjectTypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Project Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="project-type" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="projectTypeCode" class="form-label">Project Type Code</label>
                                <input type="text" class="form-control" id="projectTypeCode" name="project_type_code">
                            </div>
                            <div class="mb-3">
                                <label for="projectDescription" class="form-label">Project Description</label>
                                <input type="text" class="form-control" id="projectDescription" name="project_description">
                            </div>
                            <div class="mb-3">
                                <label for="projectDetails" class="form-label">Project Details</label>
                                <input type="text" class="form-control" id="projectDetails" name="project_details">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_project_type">Add Project Type</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>