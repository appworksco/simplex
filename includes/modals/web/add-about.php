<div class="modal fade" id="addAbout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add About</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form action="about" method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="mission" class="form-label">Mission</label>
                                <textarea class="form-control" id="mission" name="mission"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="vision" class="form-label">Vision</label>
                                <textarea class="form-control" id="vision" name="vision"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="descript" class="form-label">Descript</label>
                                <textarea class="form-control" id="descript" name="descript"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Text</label>
                                <textarea class="form-control" id="text" name="text"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="add_about">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>