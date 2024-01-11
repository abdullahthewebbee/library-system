<?php include "header.php" ?> <!-- header -->
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Add Publisher</h2>
            </div>
            <div class="offset-md-7 col-md-2">
              <a class="add-new" href="publisher.php">All Publishers</a>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form class="yourform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Publisher Name</label>
                        <input type="text" class="form-control" placeholder="publisher Name" name="publishername" value="" >
                    </div>
                    <input type="submit" name="save" class="btn btn-danger" value="save" >
                </form>
                <?php // if form submit
                if(isset($_POST['save'])){
                  if(!isset($_POST['publishername']) || empty($_POST['publishername'])){
                    echo "<div class='alert alert-danger'>Publisher name required.</div>";
                  }else{
                    // validate input
                    $publisher_name = mysqli_real_escape_string($conn, $_POST['publishername']);
                    //check publisher name already exists in table
                    $sql = "SELECT publisher_name FROM publisher WHERE publisher_name = '{$publisher_name}'";
                    $result = mysqli_query($conn, $sql) or die("SQL query failed");

                    if(mysqli_num_rows($result) > 0){ // check result rows
                        echo "<div class='alert alert-danger'>Publisher name already exist.</div>";
                    }else{
                        //insert query
                        $sql1 = "INSERT INTO publisher(publisher_name) VALUES ('{$publisher_name}')";
                        if(mysqli_query($conn, $sql1)){
                          header("$base_url/publisher.php"); // redirect
                        }
                    }
                  }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
