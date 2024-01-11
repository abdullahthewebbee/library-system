<?php include "header.php" ?> <!--- header -->
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">All Books</h2>
            </div>
            <div class="offset-md-7 col-md-2">
                <a class="add-new" href="add-book.php">Add Book</a>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="message"></div>
            <?php
            if(isset($_GET['page'])){
              $page = $_GET['page'];
            }else{
              $page = 1;
            }
            $offset = ($page - 1) * $limit;
            //select query
            $sql = "SELECT book.book_id, book.book_status, book.book_name, book.book_category, book.book_author, book.book_publisher,
                    category.category_name, author.author_name, publisher.publisher_name FROM book
                    LEFT JOIN category ON book.book_category = category.category_id
                    LEFT JOIN author ON book.book_author  = author.author_id
                    LEFT JOIN publisher ON book.book_publisher = publisher.publisher_id
                    ORDER BY book.book_id DESC LIMIT {$offset}, {$limit}";

            $result = mysqli_query($conn, $sql) or die("Sql query failed."); ?>
            <table class="content-table">
                <thead>
                  <th>S.No</th>
                  <th>Book Name</th>
                  <th>Category</th>
                  <th>Author</th>
                  <th>Publisher</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </thead>
                <tbody>
                  <?php if(mysqli_num_rows($result) > 0){ 
                  $serial = $offset + 1;
                  while($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <td class="id"><?php echo $serial; ?></td>
                    <td><?php echo $row['book_name'] ?></td>
                    <td><?php echo $row['category_name'] ?></td>
                    <td><?php echo $row['author_name'] ?></td>
                    <td><?php echo $row['publisher_name'] ?></td>
                    <td>
                    <?php
                    if($row['book_status'] == 'Y'){
                        echo "<span class='badge badge-success'>Available</span>";
                    }else{
                        echo "<span class='badge badge-danger'>Issued</span>";
                    } ?>
                    </td>
                    <td class="edit">
                      <a href="update-book.php?bid=<?php echo $row['book_id']; ?>" class="btn btn-success">Edit</a>
                    </td>
                    <td class="delete">
                      <a href="#" class="btn btn-danger delete-book" data-bid=<?php echo $row['book_id']; ?> >Delete</a>
                    </td>
                  </tr>
                <?php
                    $serial++;
                  }
                }else{ ?>
                  <tr>
                    <td colspan="8">No Books Found</td>
                  </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php //pagination
            $sql1 = "SELECT * FROM book";
            $result1 = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result1) > 0){
              $total_records = mysqli_num_rows($result1);
              $total_page = ceil($total_records / $limit);
              if($total_page > 1){
                $pagination =  "<ul class='pagination admin-pagination'>";
                if($page > 1){
                  $pagination .= '<li class=""><a href="book.php?page='.($page - 1).'">Prev</a></li>';
                }
                for($i = 1; $i <= $total_page; $i++){
                  if($i == $page){
                    $active = "active";
                  }else{
                    $active = "";
                  }
                  $pagination .= '<li class="'.$active.'"><a href="book.php?page='.$i.'">'.$i.'</a></li>';
                }
                if($total_page > $page){
                  $pagination .= '<li class=""><a href="book.php?page='.($page + 1).'">Next</a></li>';
                }
                $pagination .= "</ul>";
                echo $pagination;
              }
            } ?>
          </div>
        </div>
    </div>
</div>
<!-- jquery -->
<script src="js/jquery-3.6.0.min.js" charset="utf-8"></script>
<script type="text/javascript">
//delete book script
$(".delete-book").on("click", function(){
  var book_id = $(this).data("bid");
  $.ajax({
    url : "delete-book.php",
    type : "POST",
    data : {book_id: book_id},
    success: function(data){
      $(".message").html(data);
      setTimeout(function(){ window.location.reload(); }, 2000);
    }
  });
});
</script>
<?php include "footer.php" ?> <!--- footer -->
