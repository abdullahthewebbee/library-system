<?php include "header.php" ?> <!-- header  -->
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h2 class="admin-heading">Add Book</h2>
      </div>
      <div class="offset-md-7 col-md-2">
        <a class="add-new" href="book.php">All Books</a>
      </div>
    </div>
    <div class="row">
      <div class="offset-md-3 col-md-6">
      <?php // if form submit
      if(isset($_POST['save'])){
        if(empty($_POST['book_name']) || empty($_POST['category']) || empty($_POST['author']) || empty($_POST['publisher'])){
          echo "<div class='alert alert-danger'>Please Fill All the Fields.</div>";
        }else{
          //validate inputs
          $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
          $book_category = mysqli_real_escape_string($conn, $_POST['category']);
          $book_author = mysqli_real_escape_string($conn, $_POST['author']);
          $book_publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
          // query for check book name exists or not
          $sql = "SELECT book_name FROM book WHERE book_name = '{$book_name}'";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) > 0){ //check result rows
            echo "<div class='alert alert-danger'>Book name already exist.</div>";
          }else{
            //insert query
            $sql1 ="INSERT INTO book(book_name,book_category,book_author,book_publisher,book_status) VALUES ('{$book_name}','{$book_category}','{$book_author}','{$book_publisher}','Y')";
            if(mysqli_query($conn, $sql1)){
              header("$base_url/book.php"); // redirect
            }  
          }
        }
      } ?>
      <form class="yourform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
        <div class="form-group">
            <label>Book Name</label>
            <input type="text" class="form-control" placeholder="Book Name" name="book_name" value="" required>
        </div>
        <div class="form-group">
          <label>Category</label>
          <select class="form-control" name="category" required>
            <option value="">Select Category</option>
            <?php
            $sql = "SELECT * FROM category";
            $result = mysqli_query($conn, $sql) or die("SQL query failed.");
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value='{$row['category_id']}''>{$row['category_name']}</option>";
                }
            } ?>
          </select>
        </div>
        <div class="form-group">
            <label>Author</label>
            <select class="form-control" name="author" required >
              <option value="">Select Author</option>
              <?php
              $sql = "SELECT * FROM author";
              $result = mysqli_query($conn, $sql) or die("SQL query failed.");
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value='{$row['author_id']}'>{$row['author_name']}</option>";
                }
              } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Publisher</label>
            <select class="form-control" name="publisher" required>
              <option value="">Select Publisher</option>
              <?php
              $sql = "SELECT * FROM publisher";
              $result = mysqli_query($conn, $sql) or die("SQL query failed.");
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  echo "<option value='{$row['publisher_id']}'>{$row['publisher_name']}</option>";
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
<?php include "footer.php" ?> <!-- footer  -->
