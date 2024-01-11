<?php include "header.php"; // header
if(isset($_POST['save'])){
  //validate inputs
  $setting_id = mysqli_real_escape_string($conn, $_POST['id']);
  $return_days = mysqli_real_escape_string($conn, $_POST['returndays']);
  $fine = mysqli_real_escape_string($conn, $_POST['fine']);
//update query
  $sql = "UPDATE settings SET return_days = '{$return_days}', fine = '{$fine}' WHERE id = '{$setting_id}'";
  if(mysqli_query($conn, $sql)){
    echo "<div class='alert alert-success'>Updated successfully.</div>";
  }else{
    echo "<div class='alert alert-danger'>Updated not successfully.</div>";
  }
} ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Setting</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
              <?php
              $sql = "SELECT * FROM settings";
              $result = mysqli_query($conn, $sql) or die("SQL query failed.");
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){ ?>
              <form class="yourform" action="" method="post" autocomplete="off">
                  <div class="form-group">
                      <input type="hidden" class="form-control"  name="id" value="<?php echo $row['id'] ?>" required>
                  </div>
                  <div class="form-group">
                      <label>Return Days</label>
                      <input type="number" class="form-control"  name="returndays" value="<?php echo $row['return_days'] ?>" required>
                  </div>
                  <div class="form-group">
                      <label>Fine (in Rs.)</label>
                      <input type="number" class="form-control"  name="fine" value="<?php echo $row['fine'] ?>" required>
                  </div>
                  <input type="submit" name="save" class="btn btn-danger" value="Update" required>
              </form>
              <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
