<?php include "header.php"; // header
// if form submit
if(isset($_POST['submit'])){
//validate inputs
    $publisher_id = mysqli_real_escape_string($conn, $_POST['publisher_id']);
    $publisher_name = mysqli_real_escape_string($conn, $_POST['publisher_name']);
    //update query
    $sql = "UPDATE publisher SET publisher_name = '{$publisher_name}' WHERE publisher_id = '{$publisher_id}'";
    if(mysqli_query($conn, $sql)){
    header("$base_url/publisher.php");
    }
} ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Update Publisher</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
              <?php
                $publisher_id = $_GET['pid'];
                //select query
                $sql = "SELECT * FROM publisher WHERE publisher_id = '{$publisher_id}'";
                $result = mysqli_query($conn, $sql) or die("SQL query failed.");
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){

                ?>
                <form class="yourform" action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="publisher_id" value="<?php echo $row['publisher_id']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Publisher Name</label>
                        <input type="text" class="form-control"  name="publisher_name" value="<?php echo $row['publisher_name']; ?>" required>
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
