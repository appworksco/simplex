<div class="modal fade" id="updateServiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="services" method="post">
                        <div class="card-body">
                            <?php
                            $fetchServiceById = $servicesFacade->fetchServiceById($serviceId);
                            while ($row = $fetchServiceById->fetch(PDO::FETCH_ASSOC)) { ?>
                            <div class="mb-3">
                                <label for="serviceName" class="form-label">Service Name</label>
                                <input type="text" class="form-control" id="serviceName" name="service_name" value="<?= $row["service_name"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="serviceCode" class="form-label">Service Code</label>
                                <input type="text" class="form-control" id="serviceCode" name="service_code" value="<?= $row["service_code"] ?>">
                            </div>
                            <?php } ?>
                            <input type="hidden" value="<?= $serviceId ?>" name="service_id">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="update_service">Update Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>