<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <h4 class="mt-3 text-center">Login</h4>

            <section id="errors" class="errors text-center border hidden"></section>

            <form id="login_form">

                <div class="form-group">
                    <label for="email">Email: </label>
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
                    <label for="password">Password: </label> <br>
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
                <button type="button" id="login" class="btn btn-primary float-right mt-2 mb-2">Login</button>
            </form>
        </div>
    </div>
</div>
