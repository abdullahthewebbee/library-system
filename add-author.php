<?php include "header.php" ?> <!--- header -->
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Add Author</h2>
            </div>
            <div class="offset-md-7 col-md-2">
              <a class="add-new" href="author.php">All Authors</a>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form class="yourform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Author Name</label>
                        <input type="text" class="form-control" placeholder="Author Name" name="authorname" value="" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-danger" value="save" required>
                </form>
                <?php //if form submit
                if(isset($_POST['save'])){
                  if(!isset($_POST['authorname']) || empty($_POST['authorname'])){
                    echo "<div class='alert alert-danger'>Author name required.</div>";
                  }else{
                    $author_name = mysqli_real_escape_string($conn, $_POST['authorname']);
                    //query for check author name exists or not
                    $sql = "SELECT author_name FROM author WHERE author_name = '{$author_name}'";
                    $result = mysqli_query($conn, $sql) or die("Sql query failed.");
                    //check result rows
                    if(mysqli_num_rows($result) > 0){
                      echo "<div class='alert alert-danger'>Author name already exist.</div>";
                    }else{
                      // insert query
                      $sql1 = "INSERT INTO author(author_name) VALUES ('{$author_name}')";
                      if(mysqli_query($conn, $sql1)){
                        header("$base_url/author.php"); // redirect
                      }
                    }
                  }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!--- footer -->
