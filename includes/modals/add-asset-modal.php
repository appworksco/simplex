<div class="modal fade" id="addAssetModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Asset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form id="addAssetForm" action="fixed-asset-inventory?is_submitted=1" method="post" onsubmit="openModal()">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="employee" class="form-label">Employee</label>
                                        <input class="form-control" list="employees" id="employee" placeholder="Type to search..." name="employee">
                                        <datalist id="employees">
                                            <?php
                                            $fetchUsers = $usersFacade->fetchUsers();
                                            while ($row = $fetchUsers->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?= $row["first_name"] . ' ' . $row["middle_name"] . ' ' . $row["last_name"] ?>">
                                            <?php } ?> 
                                        </datalist>
                                    </div>
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <select id="department" class="form-select" name="department">
                                            <?php
                                            $fetchDepartments = $departmentsFacade->fetchDepartments();
                                            while ($row = $fetchDepartments->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?= $row["department_code"] ?>"><?= $row["department_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="assetName" class="form-label">Name of Item / Asset</label>
                                        <input type="text" class="form-control" id="assetName" name="asset_name">
                                    </div>
                                </div> 
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description">
                                    </div>
                                    <div class="mb-3">
                                        <label for="qty" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="qty" name="qty">
                                    </div>
                                    <div class="mb-3">
                                        <label for="condition" class="form-label">Condition</label>
                                        <select id="condition" class="form-select" name="condition">
                                            <option value="">None</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Scrap">Scrap</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <select id="remarks" class="form-select" name="remarks">
                                    <option value="">None</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>
                            <?php
                            $fetchAssetsSeriesNumber = $assetsFacade->fetchAssetsSeriesNumber();
                            while ($row = $fetchAssetsSeriesNumber->fetch(PDO::FETCH_ASSOC)) { ?>
                                <input type="hidden" value="<?= $row["series_number"] ?>" name="barcode">
                            <?php } ?>
                            <input type="hidden" value="<?= $firstName . ' ' . $lastName ?>" name="added_by">
                            <input type="hidden" value="<?= date("m-d-y") ?>" name="added_on">
                            <button type="submit" class="btn btn-info" name="add_asset">Save & Add Another</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>