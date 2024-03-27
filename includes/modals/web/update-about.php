<div class="modal fade" id="updateAbout" tabindex="-1" aria-labelledby="updateAboutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update About</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="about" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php
                        $fetchAboutById = $webFacade->fetchAboutById($aboutId);
                        while ($item = $fetchAboutById->fetch(PDO::FETCH_ASSOC)) { ?>
                            <input type="hidden" name="itemId" value="<?= $item["id"] ?>">      
                            <div class="mb-3">
                                <label for="mission" class="form-label">Mission</label>
                                <textarea class="form-control" id="mission" name="mission"><?= $item["mission"] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="vision" class="form-label">Vision</label>
                                <textarea class="form-control" id="vision" name="vision"><?= $item["vision"] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="descript" class="form-label">Description</label>
                                <textarea class="form-control" id="descript" name="descript"><?= $item["descript"] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Text</label>
                                <textarea class="form-control" id="text" name="text"><?= $item["text"] ?></textarea>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_about">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>