<?php include "header.php" ?> <!-- header -->
<div id="admin-content">
    <div class="container">
      <div class="row">
          <div class="col-md-3">
              <h2 class="admin-heading">All Book Issue</h2>
          </div>
          <div class="offset-md-6 col-md-3">
              <a class="add-new" href="add-book-issue.php">Add Book Issue</a>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <?php
        if(isset($_GET['page'])){
          $page = $_GET['page'];
        }else{
          $page = 1;
        }
        $offset = ($page - 1) * $limit;
        //select query
        $sql = "SELECT book_issue.issue_id,book_issue.issue_status,book_issue.issue_name,book_issue.issue_book,
                book_issue.issue_date,book_issue.return_date,student.student_id,student.student_phone,student.student_email,student.student_name,book.book_name FROM book_issue
                LEFT JOIN student ON book_issue.issue_name = student.student_id
                LEFT JOIN book ON book_issue.issue_book = book.book_id
                ORDER BY book_issue.issue_id DESC LIMIT {$offset}, {$limit}";
        $result = mysqli_query($conn, $sql) or die("SQL query failed."); ?>
          <table class="content-table">
              <thead>
                <th>S.No</th>
                <th>Student Name</th>
                <th>Book Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
              </thead>
              <tbody>
                <?php if(mysqli_num_rows($result) > 0){
                $serial = $offset + 1;
                while($row = mysqli_fetch_assoc($result)) { 
                  if((date('Y-m-d') > $row['return_date']) && $row['issue_status'] == "N"){
                  $over = 'style="background:rgba(255,0,0,0.2)"';
                  }else{ $over = ''; } ?>
                <tr <?php echo $over; ?>>
                  <td><?php echo $serial; ?></td>
                  <td><?php echo $row['student_name']; ?></td>
                  <td><?php echo $row['book_name']; ?></td>
                  <td><?php echo $row['student_phone']; ?></td>
                  <td><?php echo $row['student_email']; ?></td>
                  <td><?php echo date('d M, Y',strtotime($row['issue_date'])); ?></td>
                  <td><?php echo date('d M, Y',strtotime($row['return_date'])); ?></td>
                  <td>
                  <?php if($row['issue_status'] == 'Y'){
                    echo "<span class='badge badge-success'>Returned</span>";
                  }else{
                    echo "<span class='badge badge-danger'>Issued</span>";
                  } ?>
                  </td>
                  <td class="edit">
                    <a href="update-issue-book.php?iid=<?php echo $row['issue_id']; ?>"  class="btn btn-success">Edit</a>
                  </td>
                  <td class="delete">
                    <a href="delete-issue-book.php?iid=<?php echo $row['issue_id']; ?>" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                <?php
                    $serial++;
                  }
                }else{ ?>
                  <tr>
                    <td colspan="10">No Books Issued</td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
        <?php // pagination
        $sql1 = "SELECT * FROM book_issue";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1) > 0){
          $total_records = mysqli_num_rows($result1);
          $total_page = ceil($total_records / $limit);
          if($total_page > 1){
            $pagination =  "<ul class='pagination admin-pagination'>";
            if($page > 1){ // show previous button
              $pagination .= '<li class=""><a href="book-issue.php?page='.($page - 1).'">Prev</a></li>';
            }
            for($i = 1; $i <= $total_page; $i++){
              if($i == $page){
                $active = "active";
              }else{
                $active = "";
              }
              $pagination .= '<li class="'.$active.'"><a href="book-issue.php?page='.$i.'">'.$i.'</a></li>';
            }
            if($total_page > $page){ //show next button
              $pagination .= '<li class=""><a href="book-issue.php?page='.($page + 1).'">Next</a></li>';
            }
            $pagination .= "</ul>";
            echo $pagination;
          }
        } ?>
        </div>
      </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
