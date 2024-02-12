<div class="modal fade" id="employeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Manage Employee</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-semibold my-2">Overview</h5>
                            <!-- Administrator View Start -->
                            <!-- HR Associate - Talent Acquisition and Retention can only see the button -->
                            <?php if ($position == 'HRATAR') { ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
                            <?php } ?>
                        </div>
                        <div class="py-2">
                            <?php include('../errors.php') ?>
                        </div>
                        <div class="table-responsive">
                            <table id="employeeTable" class="table data-table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Employee</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Department</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Services</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Company ID</h6>
                                        </th>
                                        <!-- Administrator View Start -->
                                        <?php if ($userRole == 1) { ?>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Username</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Password</h6>
                                            </th>
                                        <?php } ?>
                                        <!-- Administrator View End -->
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Birth Date</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Blood Type</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Address</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Contact Person</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Contact Person Number</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">SSS</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Pag Ibig</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">PHIC</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">TIN</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $fetchUsers = $usersFacade->FetchUsers();
                                    while ($row = $fetchUsers->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1"><?= $row["first_name"] . ' ' . $row["middle_name"] . ' ' . $row["last_name"] ?></h6>
                                                <?php
                                                $positionCode = $row["position"];
                                                $fetchPositionByCode = $positionsFacade->fetchPositionByCode($positionCode);
                                                while ($pos = $fetchPositionByCode->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <span class="fw-normal"><?= $pos["position_name"] ?></span>
                                                <?php } ?>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["department"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["services"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["company_id"] ?></p>
                                            </td>
                                            <!-- Administrator View Start -->
                                            <?php if ($userRole == 1) { ?>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["username"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["password"] ?></p>
                                                </td>
                                            <?php } ?>
                                            <!-- Administrator View End -->
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["birthdate"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["blood_type"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["address"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["contact_person"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["contact_person_number"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["sss"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["pag_ibig"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["phic"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row["tin"] ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if ($row["status"] == 'Probationary') { ?>
                                                        <span class="fw-semibold"><?= $row["status"] ?></span>
                                                    <?php } else { ?>
                                                        <span class="text-success fw-semibold"><?= $row["status"] ?></span>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <?php if ($position == 'HRATAR' && $row["status"] == 'Probationary') { ?>
                                                    <a href="generate-id?employee_id=<?= $row["id"] ?>" class="btn btn-warning">Generate ID</a>
                                                <?php } ?>
                                                <a href="employee?is_updated=<?= $row["id"] ?>" class="btn btn-info">Update</a>
                                                <a href="delete-employee?employee_id=<?= $row["id"] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>