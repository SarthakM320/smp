<div class="row m-3 p-3 border rounded-3 bg-secondary bg-opacity-10" style="height: 88vh;">
    <div class="col-6">
        <form>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" required>
                <div class="invalid-feedback">
                    The title cannot be empty.
                </div>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="14" required></textarea>
                <div class="invalid-feedback">
                    The content cannot be empty.
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-auto">
                    <button id="edit" type="submit" class="btn btn-success">Edit</button>
                </div>
                <div class="col-auto">
                    <button id="preview" type="button" class="btn btn-info">Preview</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-6 border rounded-3 bg-white h-100">
        <div id="preview_text" class="h-100" style="overflow: scroll;"></div>
    </div>
</div>