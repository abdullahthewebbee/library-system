<?php include "header.php"; // header
//if form submit
if(isset($_POST['submit'])){
  // validate inputs
  $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
  $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
  $book_category = mysqli_real_escape_string($conn, $_POST['category']);
  $book_author = mysqli_real_escape_string($conn, $_POST['author']);
  $book_publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
  //update query
  $sql2 = "UPDATE book SET book_name = '{$book_name}', book_category = '{$book_category}', book_author = '{$book_author}', book_publisher = '{$book_publisher}' WHERE book_id = '{$book_id}'";
  if(mysqli_query($conn, $sql2)){
    header("$base_url/book.php"); //redirect
  }
} ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Update Book</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
            <?php
            $book_id = $_GET['bid'];
            //select query
            $sql = "SELECT book.book_id, book.book_name, book.book_category, book.book_author, book.book_publisher,
                    category.category_name, author.author_name, publisher.publisher_name FROM book
                    LEFT JOIN category ON book.book_category = category.category_id
                    LEFT JOIN author ON book.book_author  = author.author_id
                    LEFT JOIN publisher ON book.book_publisher = publisher.publisher_id
                    WHERE book.book_id = {$book_id}";
            $result = mysqli_query($conn, $sql) or die("Sql query failed.");
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){ ?>
                <form class="yourform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                  <div class="form-group">
                      <input type="hidden" class="form-control" placeholder="Book Name" name="book_id" value="<?php echo $row['book_id']; ?>" required>
                  </div>
                    <div class="form-group">
                        <label>Book Name</label>
                        <input type="text" class="form-control" placeholder="Book Name" name="book_name" value="<?php echo $row['book_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category" required>
                          <option disabled>Select Category</option>
                          <?php
                          $sql1 = "SELECT * FROM category";
                          $result1 = mysqli_query($conn, $sql1) or die("SQL query failed.");
                          if(mysqli_num_rows($result1) > 0){
                              while($row1 = mysqli_fetch_assoc($result1)){
                                if($row['category'] == $row1['category_id']){
                                  $selected = "selected";
                                }else{
                                  $selected = "";
                                }
                                echo "<option {$selected} value='{$row1['category_id']}''>{$row1['category_name']}</option>";
                              }
                          } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <select class="form-control" name="author" required>
                          <option disabled>Select Author</option>
                          <?php
                          $sql1 = "SELECT * FROM author";
                          $result1 = mysqli_query($conn, $sql1) or die("SQL query failed.");
                          if(mysqli_num_rows($result1) > 0){
                            while($row1 = mysqli_fetch_assoc($result1)){
                              if($row['author'] == $row1['author_id']){
                                $selected = "selected";
                              }else{
                                $selected = "";
                              }
                              echo "<option {$selected} value='{$row1['author_id']}'>{$row1['author_name']}</option>";
                            }
                          } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Publisher</label>
                        <select class="form-control" name="publisher" required>
                          <option disabled>Select Publisher</option>
                          <?php
                          $sql1 = "SELECT * FROM publisher";
                          $result1 = mysqli_query($conn, $sql1) or die("SQL query failed.");
                          if(mysqli_num_rows($result1) > 0){
                            while($row1 = mysqli_fetch_assoc($result1)){
                              if($row['publisher'] == $row1['publisher_id']){
                                $selected = "selected";
                              }else{
                                $selected = "";
                              }
                              echo "<option value='{$row1['publisher_id']}'>{$row1['publisher_name']}</option>";
                            }
                          } ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-danger" value="Update" required>
                </form>
                <?php }
                  } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
