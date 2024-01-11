<?php include "header.php" ?> <!-- header -->
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <h2 class="admin-heading text-center">Monthwise Book Issue Report</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-4 col-md-4">
                <form class="yourform mb-5" action="" method="post">
                    <div class="form-group">
                        <input type="month" name="month" class="form-control" value="<?php echo date('Y-m') ?>">
                    </div>
                    <input type="submit" class="btn btn-danger" name="search_month" value="Search">
                </form>
            </div>
        </div>
        <?php
        if(isset($_POST['search_month']) && !empty($_POST['month'])){
            //validate input
          $month = mysqli_real_escape_string($conn, $_POST['month']);
          //select query
          $sql = "SELECT book_issue.issue_id,book_issue.issue_name,book_issue.issue_book,book_issue.issue_status,
                  book_issue.issue_date,book_issue.return_date,student.student_id,student.student_phone,student.student_email,student.student_name,book.book_name FROM book_issue
                  LEFT JOIN student ON book_issue.issue_name = student.student_id
                  LEFT JOIN book ON book_issue.issue_book = book.book_id
                  WHERE DATE_FORMAT(book_issue.issue_date,'%Y-%m') = '{$month}'
                  ORDER BY book_issue.issue_id DESC";
          $result = mysqli_query($conn, $sql) or die("SQL query failed.");
          if(mysqli_num_rows($result) > 0){ ?>
        <div class="row">
            <div class="col-md-12">
              <table class="content-table">
                  <thead>
                    <th>S.No</th>
                    <th>Student Name</th>
                    <th>Book Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                  </thead>
                  <tbody>
                    <?php $serial = 1;
                    while($row = mysqli_fetch_assoc($result)) { 
                    if((date('Y-m-d') > $row['return_date']) && $row['issue_status'] == "N"){
                    $over = 'style="background:rgba(255,0,0,0.2)"';
                    }else{ $over = ''; } ?>
                    <tr <?php echo $over; ?> >
                      <td><?php echo $serial; ?></td>
                      <td><?php echo $row['student_name']; ?></td>
                      <td><?php echo $row['book_name']; ?></td>
                      <td><?php echo $row['student_phone']; ?></td>
                      <td><?php echo $row['student_email']; ?></td>
                      <td><?php echo date('d F, Y',strtotime($row['issue_date'])); ?></td>
                      <td><?php echo date('d F, Y',strtotime($row['return_date'])); ?></td>
                    </tr>
                    <?php $serial++; } ?>
                  </tbody>
              </table>
            </div>
        </div>
      <?php
          }
        } ?>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
