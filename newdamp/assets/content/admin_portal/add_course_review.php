<div class="row m-3 p-3 border rounded-3 bg-secondary bg-opacity-10" style="height: calc(100vh - 120px);">
    <div class="col-6 h-100" style="overflow: auto;">
        <form>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" required>
                        <div class="invalid-feedback">
                            The department cannot be empty.
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="number" class="form-control" id="code" required>
                        <div class="form-text">Enter only a number.</div>
                        <div class="invalid-feedback">
                            The course code cannot be empty.
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" placeholder="2017" required>
                        <div class="form-text">Enter only a single year without any special symbols.</div>
                        <div class="invalid-feedback">
                            The course year cannot be empty.
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" required>
                <div class="form-text">
                    Enter only the course title without any special symbols or unnecessary short forms.<br>
                    <!--Allowed - Introduction to Thermodynamics, CMOS Analog VLSI Design<br>
                    Not allowed - <u>Intro</u> to Thermodynamics, <u>Engg</u> of Fiber Materials, Linear Algebra <u>(MA 202)</u>-->
                </div>
                <div class="invalid-feedback">
                    The course title cannot be empty.
                </div>
            </div>
            <div class="mb-3">
                <label for="professors" class="form-label">Professors' Names</label>
                <input type="text" class="form-control" id="professors" required>
                <div class="form-text">
                    Enter only all the professors' names separated by comma without any special symbols (except '.') or unnecessary short forms and terms ('prof','dr','course-in-charge').<br>
                    <!--Allowed - B. K. Patil, Arjun Deshmukh<br>
                    Not allowed - <u>Prof.</u> B. K. Patil, Arjun Deshmukh <u>(Course-in-charge)</u>-->
                </div>
                <div class="invalid-feedback">
                    The professors' name cannot be empty.
                </div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" class="form-select" required>
                    <option selected disabled>Select Category...</option>
                </select>
                <div class="invalid-feedback">
                    Please select a course category.
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
                    <button id="add-continue" data-continue="1" type="submit" class="btn btn-success">Add & Continue</button>
                </div>
                <div class="col-auto me-auto">
                    <button id="add" data-continue="0" type="submit" class="btn btn-success">Add</button>
                </div>
                <div class="col-auto ms-auto">
                    <button id="preview" type="button" class="btn btn-info">Preview</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-6 border rounded-3 bg-white h-100">
        <div id="preview_text" class="h-100" style="overflow: auto;"></div>
    </div>
</div>
