<?php include "header.php" ?> <!-- header -->
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="admin-heading">Change Password</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
              <form class="yourform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="username" value="" required>
                </div>
                  <div class="form-group">
                      <label>Old Password</label>
                      <input type="password" class="form-control" placeholder="Enter Old Password" name="password" value="" required>
                  </div>
                  <div class="form-group">
                      <label>New Password</label>
                      <input type="password" class="form-control" placeholder="Enter New Password" name="new_password" value="" required>
                  </div>
                  <input type="submit" name="save" class="btn btn-danger" value="Submit" required>
              </form>
              <?php // if form submit
              if(isset($_POST['save'])){
                $username = $_SESSION['username'];
                //validate inputs
                $password = mysqli_real_escape_string($conn, md5($_POST['password']));
                $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
                //update query
                $sql = "UPDATE admin SET password = '{$new_password}' WHERE username = '{$username}' AND password = '{$password}'";
                if(mysqli_query($conn, $sql)){
                  echo "<div class='alert alert-success'>Password changed successfully.</div>";
                }else{
                  echo "<div class='alert alert-danger'>Failed to changed password.</div>";
                }
              } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
