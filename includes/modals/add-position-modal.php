<div class="modal fade" id="addPositionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="positions" method="post">
                            <div class="mb-3">
                                <label for="positionName" class="form-label">Position Name</label>
                                <input type="text" class="form-control" id="positionName" name="position_name">
                            </div>
                            <div class="mb-3">
                                <label for="positionCode" class="form-label">Position Code</label>
                                <input type="text" class="form-control" id="positionCode" name="position_code">
                            </div>
                            <button type="submit" class="btn btn-primary" name="add_position">Add Position</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>