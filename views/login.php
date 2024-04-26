<div class="modal fade" id="StudLoginModal" tabindex="-1" aria-labelledby="StudLoginModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="StudLoginModalLabel">Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Login form start -->
        <form action="" method="post" id="stuLogForm">
          <div class="title">
            <h1></h1>
          </div>
          <div class="uname">
            <i class="fas fa-user"></i>
            <label for="uname" class="pl-2 font-weight-bold">Email </label>  &emsp;  <small id="stuLogemailerr" class="stuLogErr"></small>  <br>
            <input type="email" name="Logemail" id="Logemail" class="logip form-control">
          </div>
          <div class="passw">
            <label for="password" class="pl-2 font-weight-bold">Password </label> &emsp;  <small id="stuLogpasswerr" class="stuLogErr"></small>  <br>
            <input type="password" name="Logpassw" id="Logpassw" class="logip form-control">
          </div>
          <!-- <input type="submit" id="submit"> -->
        </form>
        <!-- Login form end -->


      </div>
      <div class="modal-footer">
        <span id="LogsuccessMsg"></span>
        <button type="button" class="btn btn-primary" onclick="checkStuLogin()">Sign in</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>