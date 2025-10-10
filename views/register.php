<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <h4 id="form_header" class="mt-3 text-center">Register</h4>

            <form id="register_form">

                <div class="form-group">
                    <label for="first_name">First name (*): </label>
                    <input
                        type="text"
                        maxlength="255"
                        class="form-control form-control-lg"
                        id="first_name"
                        name="first_name"
                        placeholder="Enter first name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="last_name">Last name (*): </label>
                    <input
                        type="text"
                        maxlength="255"
                        class="form-control form-control-lg"
                        id="last_name"
                        name="last_name"
                        placeholder="Enter last name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Phone number (*): </label><br>
                    <label><b>Tip</b>: phone must contain 11 digits</label>
                    <input type="text"
                       maxlength="18"
                       class="form-control form-control-lg"
                       id="phone"
                       name="phone"
                       placeholder="+X (XXX) XXX XXXX"
                       required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email (*): </label>
                    <input
                        type="email"
                        maxlength="255"
                        class="form-control form-control-lg"
                        id="email"
                        name="email"
                        placeholder="Enter email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password (*): </label> <br>
                    <label><b>Tip</b>: password must contain at least 8 symbols and at least 1 digit and 1 letter</label>
                    <input
                        type="password"
                        maxlength="255"
                        class="form-control form-control-lg"
                        id="password"
                        name="password"
                        placeholder="Enter password"
                        required
                    >
                </div>
                <button type="button" id="register" class="btn btn-primary float-right mt-2 mb-2">Submit</button>
            </form>

        </div>
    </div>
</div>
