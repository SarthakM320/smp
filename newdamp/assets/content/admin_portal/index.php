<div class="row m-3 p-3">
    <div class="col-5 p-5 ms-auto me-auto border rounded-3">
        <div class="col-2 fs-4 ms-auto me-auto">Login</div>
        <form>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" required>
                <div class="invalid-feedback">
                    Username cannot be empty.
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" required>
                <div class="invalid-feedback">
                    Password cannot be empty.
                </div>
            </div>
            <div class="mb-3">
                <label for="branch" class="form-label">Branch</label>
                <select id="branch" class="form-select" aria-label="Default select" required>
                    <option selected disabled>Select Branch...</option>
                    <option value="ae">Aerospace Engineering</option>
                    <option value="ce">Civil Engineering</option>
                    <option value="ch">Chemistry</option>
                    <option value="cl">Chemical Engineering</option>
                    <option value="cs">Computer Science & Engineering</option>
                    <option value="ee">Electrical Engineering</option>
                    <option value="en">Energy Science & Engineering</option>
                    <option value="ep">Engineering Physics</option>
                    <option value="es">Environmental Sciences</option>
                    <option value="hs">Economics</option>
                    <option value="ma">Mathematics</option>
                    <option value="me">Mechanical Engineering</option>
                    <option value="mm">MEMS</option>
                </select>
                <div class="invalid-feedback">
                    Please select a branch.
                </div>
            </div>
            <div class="mb-3 invalid-feedback">
                Either username or password is incorrect.
            </div>
            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
