<div class="modal fade" id="addKasuki" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Ka-suki</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="kasuki" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="text_title" class="form-label">Text Title</label>
                                <input type="text" class="form-control" id="text_title" name="text_title">
                            </div>
                            <div class="mb-3">
                                <label for="text_body" class="form-label">Text Body</label>
                                <textarea class="form-control" id="text_body" name="text_body"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image1" class="form-label">Image 1</label>
                                <input type="file" class="form-control" id="image1" name="image1">
                            </div>
                            <div class="mb-3">
                                <label for="image2" class="form-label">Image 2</label>
                                <input type="file" class="form-control" id="image2" name="image2">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_kasuki">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>