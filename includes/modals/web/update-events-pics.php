<!-- Modal for updating Home Carousel item -->
<div class="modal fade" id="updateEventsPics" tabindex="-1" aria-labelledby="updateEventspicsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Events Pics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <form action="events-pics" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php
                        $fetchEventsPicsById = $webFacade->fetchEventsPicsById($eventsPicsId);
                        while ($item = $fetchEventsPicsById->fetch(PDO::FETCH_ASSOC)) { ?>
                            <input type="hidden" name="current_image" value="<?= $item["image"] ?>">
                            <input type="hidden" name="itemId" value="<?= $item["id"] ?>">      
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $item["name"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">New Image</label>
                                <input type="file" class="form-control" id="image" name="image" value="<?= $item["image"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="caption" class="form-label">Caption</label>
                                <input type="text" class="form-control" id="caption" name="caption" value="<?= $item["caption"] ?>">
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_events_pics">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>