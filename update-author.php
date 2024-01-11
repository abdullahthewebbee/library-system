<?php include "header.php"; //header
//if form submit
if(isset($_POST["submit"])){
  //validate inputs
  $author_id = mysqli_real_escape_string($conn, $_POST['author_id']);
  $author_name = mysqli_real_escape_string($conn, $_POST['author_name']);
//update query
  $sql = "UPDATE author SET author_name = '{$author_name}' WHERE author_id = '{$author_id}'";
  if(mysqli_query($conn, $sql)){
      header("$base_url/author.php"); // redirect
  }
} ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Update Author</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
              <?php
              $author_id = $_GET['aid'];
              $sql = "SELECT * FROM author WHERE author_id = '{$author_id}'" ;
              $result = mysqli_query($conn, $sql) or die("SQL query failed.");
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){ ?>
              <form class="yourform" action="" method="post" autocomplete="off">
                <div class="form-group">
                    <input type="hidden" class="form-control"  name="author_id" value="<?php echo $row['author_id']; ?>" required>
                </div>
                  <div class="form-group">
                      <label>Author Name</label>
                      <input type="text" class="form-control" name="author_name" value="<?php echo $row['author_name']; ?>" required>
                  </div>
                  <input type="submit" name="submit" class="btn btn-danger" value="Update" required>
              </form>
              <?php
                  }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
