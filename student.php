<?php include "header.php" ?> <!-- header -->
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="admin-heading">All Students</h2>
            </div>
            <div class="offset-md-6 col-md-2">
                <a class="add-new" href="add-student.php">Add Student</a>
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
              $sql = "SELECT * FROM student ORDER BY student_id DESC LIMIT {$offset}, {$limit}";
              $result = mysqli_query($conn, $sql);
               ?>
              <div class="message"></div>
                <table class="content-table">
                    <thead>
                      <th>S.No</th>
                      <th>Student Name</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </thead>
                    <tbody>
                      <?php if(mysqli_num_rows($result) > 0){
                      $serial = $offset + 1;
                      while($row = mysqli_fetch_assoc($result)) { ?>
                      <tr>
                        <td class="id"><?php echo $serial; ?></td>
                        <td><?php echo $row['student_name']; ?></td>
                        <td><?php echo ucfirst($row['student_gender']); ?></td>
                        <td><?php echo $row['student_phone']; ?></td>
                        <td><?php echo $row['student_email']; ?></td>
                        <td class="view">
                          <button data-sid='<?php echo $row['student_id'] ?>'  class="btn btn-primary view-btn">View</button>
                        </td>
                        <td class="edit">
                          <a href="update-student.php?sid=<?php echo $row['student_id']; ?>" class="btn btn-success">Edit</a>
                        </td>
                        <td class="delete">
                          <a href="#" data-sid="<?php echo $row['student_id']; ?>" class="btn btn-danger delete-student">Delete</a>
                        </td>
                      </tr>
                    <?php $serial++;
                      }
                    }else{ ?>
                      <tr>
                        <td colspan="8">No Students Found</td>
                      </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div id="modal">
                <div id="modal-form">
                  <table cellpadding="10px" width="100%"></table>
                  <div id="close-btn">X</div>
                </div>
              </div>
              <?php // pagination
                $sql1 = "SELECT * FROM student";
                $result1 = mysqli_query($conn, $sql1);
                if(mysqli_num_rows($result1) > 0){
                  $total_records = mysqli_num_rows($result1);
                  $total_page = ceil($total_records / $limit);
                  if($total_page > 1){
                    $pagination = "<ul class='pagination admin-pagination'>";
                    if($page > 1){
                      $pagination .= '<li class=""><a href="student.php?page='.($page - 1).'">Prev</a></li>';
                    }
                      for($i = 1; $i <= $total_page; $i++){
                        if($i == $page){
                          $active = "active";
                        }else{
                          $active = "";
                        }
                        $pagination .= '<li class="'.$active.'"><a href="student.php?page='.$i.'">'.$i.'</a></li>';
                      }
                    if($total_page > $page){
                      $pagination .= '<li class=""><a href="student.php?page='.($page + 1).'">Next</a></li>';
                    }
                    $pagination .= "</ul>";
                    echo $pagination;
                  }
                } ?>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.6.0.min.js" charset="utf-8"></script>
<script type="text/javascript">
      //Show shudent detail
      $(".view-btn").on("click", function(){
        var student_id = $(this).data("sid");
        $.ajax({
          url : "view-student.php",
          type : "POST",
          data : {student_id: student_id},
          success: function(data){
            $("#modal-form table").html(data);
            $("#modal").show();
          }
        });
      });

      //Hide modal box
      $('#close-btn').on("click",function(){
        $("#modal").hide();
      });

      //delete student script
      $(".delete-student").on("click", function(){
        var s_id = $(this).data("sid");
        $.ajax({
          url : "delete-student.php",
          type : "POST",
          data : {sid: s_id},
          success: function(data){
            $(".message").html(data);
            setTimeout(function(){ window.location.reload(); }, 2000);
          }
        });
      });
</script>
<?php include "footer.php" ?> <!-- footer -->
