<?php include "header.php" ?> <!-- header -->
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
          <h2 class="admin-heading">Add Book Issue</h2>
      </div>
      <div class="offset-md-7 col-md-2">
        <a class="add-new" href="book-issue.php">All Issue List</a>
      </div>
    </div>
    <div class="row">
      <div class="offset-md-3 col-md-6">
        <?php //if form submit
        if(isset($_POST['save'])){
          // --------------------
          // get return days from settings table
          $sql = "SELECT * FROM settings";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){
            $return_days = 0;
            while($row = mysqli_fetch_assoc($result)){
              $return_days = $row['return_days'];
            }
          }
          // --------------------
          if(empty($_POST['student_name']) || empty($_POST['book_name'])){
            echo "<div class='alert alert-danger'>Please Fill All the Fields.</div>";
          }else{
            // validate inputs
            $issue_name = mysqli_real_escape_string($conn, $_POST['student_name']);
            $issue_book = mysqli_real_escape_string($conn, $_POST['book_name']);
            $issue_date = date('Y-m-d');
            $return_date = date('Y-m-d',strtotime("+".$return_days." days"));
            //insert query
            $sql = "INSERT INTO book_issue(issue_name,issue_book,issue_date,return_date,issue_status) VALUES ('{$issue_name}','{$issue_book}','{$issue_date}','$return_date','N')";
            if(mysqli_query($conn, $sql)){
              $update = "UPDATE book SET book_status = 'N' WHERE book_id = {$issue_book}";
              $result = mysqli_query($conn, $update);
              header("$base_url/book-issue.php"); //redirect
            }else{
              echo "<div class='alert alert-danger'>Query failed.</div>";
            }
          }
        } ?>
        <form class="yourform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
          <div class="form-group">
              <label>Student Name</label>
              <select class="form-control" name="student_name" required>
                <option value="">Select Name</option>
                <?php
                $sql = "SELECT * FROM student";
                $result = mysqli_query($conn, $sql) or die("SQL query failed.");
                if(mysqli_num_rows($result) > 0){ //check result rows
                    while($row = mysqli_fetch_assoc($result)){
                      echo "<option value='{$row['student_id']}'>{$row['student_name']}</option>";
                    }
                } ?>
              </select>
          </div>
          <div class="form-group">
              <label>Book Name</label>
              <select class="form-control" name="book_name" required>
                <option value="">Select Name</option>
                <?php
                $sql = "SELECT * FROM book WHERE book_status = 'Y'";
                $result = mysqli_query($conn, $sql) or die("SQL query failed.");
                if(mysqli_num_rows($result) > 0){ // check result rows
                    while($row = mysqli_fetch_assoc($result)){
                      echo "<option value='{$row['book_id']}'>{$row['book_name']}</option>";
                    }
                } ?>
              </select>
          </div>
          <input type="submit" name="save" class="btn btn-danger" value="save" required>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
