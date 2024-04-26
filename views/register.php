<div class="modal fade" id="StudRegModal" tabindex="-1" aria-labelledby="StudRegModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="StudRegModalLabel">Registeration</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Registration form start -->
                <form action="RegisterAuth.php" method="post" id="stuRegForm">
                    <div class="title">
                        <h1></h1>
                    </div>
                    <div class="uname">
                        <i class="fas fa-user"></i>
                        <label for="uname" class="pl-2 font-weight-bold">User Name </label> &emsp;  <small id="stuunameerr" class="stuRegErr"></small> <br>
                        <input id="uname" type="text" name="uname" class="regip form-control">
                    </div>
                    <div class="email">
                        <i class="fas fa-envelope"></i>
                        <label for="email" class="pl-2 font-weight-bold">Email Address </label> &emsp;  <small id="stuemailerr" class="stuRegErr"></small> <br>
                        <input id="email" type="email" name="email" class="regip form-control">
                    </div>
                    <div class="passw">
                        <label for="password" class="pl-2 font-weight-bold">Password </label> &emsp;  <small id="stupasswerr" class="stuRegErr"></small> <br>
                        <input id="password" type="password" name="password" class="regip form-control">
                    </div>
                    <div class="conf_passw">
                        <label for="confirm_password" class="pl-2 font-weight-bold">Confirm Password </label> &emsp;  <small id="stuconpasswerr" class="stuRegErr"></small> <br>
                        <input id="confirm_password" type="password" name="confirm_password" class="regip form-control">
                    </div>
                    <!-- <input type="submit" id="submit"> -->
                </form>
                <!-- Registration form end -->


            </div>
            <div class="modal-footer">
                <span id="RegsuccessMsg"></span>
                <button type="button" class="btn btn-primary" onclick="addStu()">Sign up</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>