<?php include "header.php"; // header
//if form submit
if(isset($_POST['submit'])){
    //validate input
  $category_id = mysqli_real_escape_string($conn, $_POST['categor_id']);
  $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
  //update query
  $sql = "UPDATE category SET category_name = '{$category_name}' WHERE category_id = '{$category_id}'";
  if(mysqli_query($conn, $sql)){
    header("$base_url/category.php"); // redirect
  }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">UpdateCategory</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
              <?php
            $category_id = $_GET['cid'];
            //select query
            $sql = "SELECT * FROM category WHERE category_id = '{$category_id}'";
            $result = mysqli_query($conn, $sql) or die("SQL query failed.");
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){ ?>
                <form class="yourform" action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="categor_id" value="<?php echo $row['category_id']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control"  name="category_name" value="<?php echo $row['category_name']; ?>" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-danger" value="save" required>
                </form>
                <?php }
                  } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
