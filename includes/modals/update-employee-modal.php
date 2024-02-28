<div class="modal fade" id="updateEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form id="addAssetForm" action="employee" method="post">
                        <div class="card-body">
                            <?php
                            $fetchEmployeeById = $usersFacade->fetchEmployeeById($employeeId);
                            while ($employee = $fetchEmployeeById->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">First Name <span class="text-danger">&ast;</span></label>
                                            <input type="text" class="form-control" id="firstName" name="first_name" value="<?= $employee["first_name"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="middleName" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" id="middleName" name="middle_name" value="<?= $employee["middle_name"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Last Name <span class="text-danger">&ast;</span></label>
                                            <input type="text" class="form-control" id="lastName" name="last_name" value="<?= $employee["last_name"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="birthDate" class="form-label">Birth Date (mm/dd/yyyy)<span class="text-danger">&ast;</span></label>
                                            <input type="text" class="form-control" id="birthDate" name="birth_date" value="<?= $employee["birthdate"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="bloodType" class="form-label">Blood Type</label>
                                            <input type="text" class="form-control" id="bloodType" name="blood_type" value="<?= $employee["blood_type"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="companyID" class="form-label">Company ID</label>
                                            <input type="text" class="form-control" id="companyId" name="company_id" value="<?= $employee["company_id"] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?= $employee["address"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactPerson" class="form-label">Contact Person</label>
                                            <input type="text" class="form-control" id="contactPerson" name="contact_person" value="<?= $employee["contact_person"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactPersonNumber" class="form-label">Contact Person Number</label>
                                            <input type="text" class="form-control" id="contactPersonNumber" name="contact_person_number" value="<?= $employee["contact_person_number"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="department" class="form-label">Department</label>
                                            <select class="form-select" id="department" name="department">
                                                <?php
                                                $fetchDepartments = $departmentsFacade->fetchDepartments();
                                                while ($row = $fetchDepartments->fetch(PDO::FETCH_ASSOC)) {
                                                    if ($employee["department"] == $row["department_code"]) { ?>
                                                        <option value="<?= $row["department_code"] ?>" selected><?= $row["department_name"] ?></option>
                                                    <?php } else {  ?>
                                                        <option value="<?= $row["department_code"] ?>"><?= $row["department_name"] ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="position" class="form-label">Position</label>
                                            <select class="form-select" id="position" name="position">
                                                <?php
                                                $fetchPositions = $positionsFacade->fetchPositions();
                                                while ($row = $fetchPositions->fetch(PDO::FETCH_ASSOC)) {
                                                    if ($employee["position"] == $row["position_code"]) { ?>
                                                        <option value="<?= $row["position_code"] ?>" selected><?= $row["position_name"] ?></option>
                                                    <?php } else {  ?>
                                                        <option value="<?= $row["position_code"] ?>"><?= $row["position_name"] ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <?php if ($employee["status"] == 'Probationary') { ?>
                                                    <option value="Probationary" selected>Probationary</option>
                                                    <option value="Regular">Regular</option>
                                                <?php } else { ?>
                                                    <option value="Probationary">Probationary</option>
                                                    <option value="Regular" selected>Regular</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="services" class="form-label">Services</label>
                                            <select class="form-select" id="services" name="services">
                                                <?php
                                                $fetchServices = $servicesFacade->fetchServices();
                                                while ($row = $fetchServices->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <option value="<?= $row["service_code"] ?>"><?= $row["service_name"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sss" class="form-label">SSS</label>
                                            <input type="text" class="form-control" id="sss" name="sss" value="<?= $employee["sss"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pagIbig" class="form-label">PAG IBIG</label>
                                            <input type="text" class="form-control" id="pagIbig" name="pag_ibig" value="<?= $employee["pag_ibig"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phic" class="form-label">PHIC</label>
                                            <input type="text" class="form-control" id="phic" name="phic" value="<?= $employee["phic"] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tin" class="form-label">TIN</label>
                                            <input type="text" class="form-control" id="tin" name="tin" value="<?= $employee["tin"] ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $employeeId ?>" name="employee_id">
                        </div>
                        <div class="card-body">
                            <p>Account Permission</p>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="canCreate" class="form-label">Can Create</label>
                                        <select class="form-select" id="canCreate" name="can_create">
                                            <?php if ($employee["can_create"] === 0) { ?>
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            <?php } else { ?>
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="canUpdate" class="form-label">Can Update</label>
                                        <select class="form-select" id="canUpdate" name="can_update">
                                            <?php if ($employee["can_update"] === 0) { ?>
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            <?php } else { ?>
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="canDelete" class="form-label">Can Delete</label>
                                        <select class="form-select" id="canDelete" name="can_delete">
                                            <?php if ($employee["can_delete"] === 0) { ?>
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            <?php } else { ?>
                                                <option value="0">No</option>
                                                <option value="1" selected>Yes</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" name="update_employee">Update Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>