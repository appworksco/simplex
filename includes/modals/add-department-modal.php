<div class="modal fade" id="addDepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="departments" method="post">
                            <div class="mb-3">
                                <label for="departmentName" class="form-label">Department Name</label>
                                <input type="text" class="form-control" id="departmentName">
                            </div>
                            <div class="mb-3">
                                <label for="departmentCode" class="form-label">Department Code</label>
                                <input type="password" class="form-control" id="departmentCode">
                            </div>
                            <button type="submit" class="btn btn-primary" name="add_department">Add Department</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>