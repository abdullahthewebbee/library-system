<?php include "header.php" ?> <!-- header -->
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Add Category</h2>
            </div>
            <div class="offset-md-7 col-md-2">
              <a class="add-new" href="category.php">All Categories</a>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form class="yourform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" placeholder="Category Name" name="categoryname" value="" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-danger" value="save" required>
                </form>
                <?php // if form submit
                if(isset($_POST['save'])){
                  if(!isset($_POST['categoryname']) || empty($_POST['categoryname'])){
                    echo "<div class='alert alert-danger'>Category name required.</div>";
                  }else{
                    //validate input
                    $category_name = mysqli_real_escape_string($conn, $_POST['categoryname']);
                    // select query for check category name already exists
                    $sql = "SELECT category_name FROM category WHERE category_name = '{$category_name}'";
                    $result = mysqli_query($conn, $sql) or die("SQL query failed");

                    if(mysqli_num_rows($result) > 0){ // check result rows
                        echo "<div class='alert alert-danger'>Category name already exist.</div>";
                    }else{
                        //insert query
                        $sql1 = "INSERT INTO category(category_name) VALUES ('{$category_name}')";
                        if(mysqli_query($conn, $sql1)){
                          header("$base_url/category.php"); //redirect
                        }
                    }
                  }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
