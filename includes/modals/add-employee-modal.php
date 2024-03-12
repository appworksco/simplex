<div class="modal fade" id="addEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form id="addAssetForm" action="employee" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name <span class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" name="middle_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name <span class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="birthDate" class="form-label">Birth Date (mm/dd/yyyy)<span class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control" id="birthDate" name="birth_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bloodType" class="form-label">Blood Type</label>
                                        <input type="text" class="form-control" id="bloodType" name="blood_type">
                                    </div>
                                    <div class="mb-3">
                                        <label for="companyID" class="form-label">Company ID</label>
                                        <input type="text" class="form-control" id="companyId" name="company_id">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address <span class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contactPerson" class="form-label">Contact Person</label>
                                        <input type="text" class="form-control" id="contactPerson" name="contact_person">
                                    </div>
                                    <div class="mb-3">
                                        <label for="contactPersonNumber" class="form-label">Contact Person Number</label>
                                        <input type="text" class="form-control" id="contactPersonNumber" name="contact_person_number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <select class="form-select" id="department" name="department" required>
                                            <?php
                                            $fetchDepartments = $departmentsFacade->fetchDepartments();
                                            while ($row = $fetchDepartments->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?= $row["department_code"] ?>"><?= $row["department_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <select class="form-select" id="position" name="position" required>
                                            <?php
                                            $fetchPositions = $positionsFacade->fetchPositions();
                                            while ($row = $fetchPositions->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?= $row["position_code"] ?>"><?= $row["position_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="services" class="form-label">Services</label>
                                        <select class="form-select" id="services" name="services" required>
                                            <?php
                                            $fetchServices = $servicesFacade->fetchServices();
                                            while ($row = $fetchServices->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?= $row["service_code"] ?>"><?= $row["service_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sss" class="form-label">SSS</label>
                                        <input type="text" class="form-control" id="sss" name="sss">
                                    </div>
                                    <div class="mb-3">
                                        <label for="pagIbig" class="form-label">PAG IBIG</label>
                                        <input type="text" class="form-control" id="pagIbig" name="pag_ibig">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phic" class="form-label">PHIC</label>
                                        <input type="text" class="form-control" id="phic" name="phic">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tin" class="form-label">TIN</label>
                                        <input type="text" class="form-control" id="tin" name="tin">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Account Access</p>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirm_password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" name="add_employee">Add Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>