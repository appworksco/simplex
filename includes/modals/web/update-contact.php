<div class="modal fade" id="updateContact" tabindex="-1" aria-labelledby="updateContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Contact Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="contact" method="post">
                    <div class="card-body">
                        <?php
                        $fetchContactById = $webFacade->fetchContactById($contactId);
                        while ($item = $fetchContactById->fetch(PDO::FETCH_ASSOC)) { ?>
                            <input type="hidden" name="itemId" value="<?= $item["id"] ?>">      
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $item["email"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $item["name"] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message"><?= $item["message"] ?></textarea>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update_contact">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>