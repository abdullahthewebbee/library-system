<?php include "header.php"; // header
//if form submit
if(isset($_POST['save'])){
  $issue_id = $_GET['iid'];
  $book_id = $_POST['book-id'];
  $date = date('Y-m-d');
  //update book issue table
  $sql = "UPDATE book_issue SET issue_status = 'Y', return_day = '{$date}' WHERE issue_id = {$issue_id};";
  //update book status in books table
  $sql .= "UPDATE book SET book_status = 'Y' WHERE book_id = {$book_id}";
  if(mysqli_multi_query($conn, $sql)){
    header("$base_url/book-issue.php"); // redirect
  }
} ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Return Book</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
              <?php
              // -----------------
              //get fine value from settings table
              $q = "SELECT * FROM settings";
              $rq = mysqli_query($conn, $q);
              if(mysqli_num_rows($rq) > 0){
                $fine = 0;
                while($r = mysqli_fetch_assoc($rq)){
                  $fine = $r['fine'];
                }
              }
              // ----------------
              $issue_id = $_GET['iid'];
              //select query
                $sql = "SELECT book_issue.issue_id,book_issue.issue_name,book_issue.issue_book,book_issue.issue_status,book_issue.return_day,
                        book_issue.issue_date,book_issue.return_date,student.student_id,student.student_phone,student.student_email,student.student_name,book.book_name FROM book_issue
                        LEFT JOIN student ON book_issue.issue_name = student.student_id
                        LEFT JOIN book ON book_issue.issue_book = book.book_id
                        WHERE issue_id = {$issue_id}
                        ORDER BY book_issue.issue_id DESC";
                $result = mysqli_query($conn, $sql) or die("SQL query failed.");
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){ ?>
                <div class="yourform">
                  <table cellpadding="10px" width="90%" style="margin: 0 0 20px;">
                    <tr>
                      <td>Student Name : </td>
                      <td><b><?php echo $row['student_name'] ?></b></td>
                    </tr>
                    <tr>
                      <td>Book Name : </td>
                      <td><b><?php echo $row['book_name'] ?></b></td>
                    </tr>
                    <tr>
                      <td>Phone : </td>
                      <td><b><?php echo $row['student_phone'] ?></b></td>
                    </tr>
                    <tr>
                      <td>Email : </td>
                      <td><b><?php echo $row['student_email'] ?></b></td>
                    </tr>
                    <tr>
                      <td>Issue Date : </td>
                      <td><b><?php echo date('d M, Y',strtotime($row['issue_date'])); ?></b></td>
                      </tr>
                      <tr>
                        <td>Return Date : </td>
                        <td><b><?php echo date('d M, Y',strtotime($row['return_date'])); ?></b></td>
                      </tr>
                      <?php
                      if($row['issue_status'] == 'Y'){ ?>
                        <tr>
                          <td>Status</td>
                          <td><b>Returned</b></td>
                        </tr>
                        <tr>
                          <td>Returned On</td>
                          <td><b><?php echo date('d M, Y',strtotime($row['return_day'])); ?></b></td>
                        </tr>
                    <?php  }else{
                          if(date('Y-m-d') > $row['return_date']){ ?>
                            <tr>
                              <td>Fine</td>
                              <?php
                              $date1 = date_create(date('Y-m-d'));
                              $date2 = date_create($row['return_date']);
                              $diff = date_diff($date1,$date2);
                              $days = $diff->format('%a');
                               ?>
                              <td><?php echo 'Rs. '.($fine * $days); ?></td>
                            </tr>
                          <?php } ?>
                    <?php }  ?>
                  </table><?php
                  if($row['issue_status'] == 'N'){ ?>
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                    <input type="hidden" name="book-id" value="<?php echo $row['issue_book'] ?>">
                    <input type='submit' class='btn btn-danger' name='save' value='Return Book'>
                  </form>
              <?php  } ?>
                </div>
              <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
