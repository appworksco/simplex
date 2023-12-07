<div class="modal fade" id="addEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form id="addAssetForm" action="fixed-asset-inventory?is_submitted=1" method="post" onsubmit="openModal()">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" name="middle_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="birthDate" class="form-label">Birth Date</label>
                                        <input type="date" class="form-control" id="birthDate" name="birth_date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bloodType" class="form-label">Blood Type</label>
                                        <input type="text" class="form-control" id="bloodType" name="blood_type">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status">
                                            <option value="Probitionary">Probitionary</option>
                                            <option value="Regular">Regular</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address">
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
                                        <select class="form-select" name="department" id="department">
                                            <?php 
                                            $fetchDepartments = $departmentsFacade->fetchDepartments();
                                            while ($row = $fetchDepartments->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?= $row["department_code"] ?>"><?= $row["department_name"] ?></option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <select class="form-select" name="position" id="position">
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
                                        <select class="form-select" name="services" id="services">
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
                            <input type="hidden" value="<?= $firstName . ' ' . $lastName ?>" name="added_by">
                            <input type="hidden" value="<?= date("m-d-y") ?>" name="added_on">
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