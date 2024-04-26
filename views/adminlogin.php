<div class="modal fade" id="AdminLoginModal" tabindex="-1" aria-labelledby="AdminLoginModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AdminLoginModalLabel">Admin Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Admin Login form start -->
        <form action="RegisterAuth.php" method="post" id="AdminLogForm">
          <div class="title">
            <h1></h1>
          </div>
          <div class="uname">
            <i class="fas fa-user"></i>
            <label for="uname" class="pl-2 font-weight-bold">Admin Email </label>  &emsp;  <small id="AdminEmailErr" class="AdminLogErr"></small>   <br>
            <input type="email" name="AdminEmail" id="AdminEmail" class="regip form-control">
          </div>
          <div class="passw">
            <label for="password" class="pl-2 font-weight-bold">Admin Password </label>  &emsp;  <small id="AdminPasswordErr" class="AdminLogErr"></small>   <br>
            <input type="password" name="AdminPassword" id="AdminPassword" class="regip form-control">
          </div>
          <!-- <input type="submit" id="submit"> -->
        </form>
        <!-- Admin Login form end -->


      </div>
      <div class="modal-footer">
        <span id="AminLogsuccessMsg"></span>
        <button type="button" class="btn btn-primary" onclick="adminlogin()">Admin Login</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>