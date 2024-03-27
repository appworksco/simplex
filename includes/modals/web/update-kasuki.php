<!-- Modal for updating Kasuki item -->
<div class="modal fade" id="updateKasuki" tabindex="-1" aria-labelledby="updateKasukiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Kasuki</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="kasuki" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php
                        $fetchKasukiById = $webFacade->fetchKasukiById($kasukiId);
                        while ($item = $fetchKasukiById->fetch(PDO::FETCH_ASSOC)) { ?>
                            <input type="hidden" name="current_image1" value="<?= $item["image1"] ?>">
                            <input type="hidden" name="current_image2" value="<?= $item["image2"] ?>">
                            <input type="hidden" name="itemId" value="<?= $item["id"] ?>">      
                            <div class="mb-3">
                                <label for="text_title" class="form-label">Text Title</label>
                                <input type="text" class="form-control" id="text_title" name="text_title" value="<?= $item["text_title"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="text_body" class="form-label">Text Body</label>
                                <textarea class="form-control" id="text_body" name="text_body"><?= $item["text_body"] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image1" class="form-label">Image 1</label>
                                <input type="file" class="form-control" id="image1" name="image1">
                            </div>
                            <div class="mb-3">
                                <label for="image2" class="form-label">Image 2</label>
                                <input type="file" class="form-control" id="image2" name="image2">
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_kasuki">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>