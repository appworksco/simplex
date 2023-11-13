<div class="modal fade" id="updateDepartmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="departments" method="post">
                            <?php
                                $fetchDepartmentById = $departmentsFacade->fetchDepartmentById($departmentId);
                                while ($row = $fetchDepartmentById->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="mb-3">
                                    <label for="departmentName" class="form-label">Department Name</label>
                                    <input type="text" class="form-control" id="departmentName" name="department_name" value="<?= $row["department_name"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="departmentCode" class="form-label">Department Code</label>
                                    <input type="text" class="form-control" id="departmentCode" name="department_code" value="<?= $row["department_code"] ?>">
                                </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $departmentId ?>" name="department_id">
                            <button type="submit" class="btn btn-primary" name="update_department">Update Department</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>