<?php include "header.php"; // header
//if form submit
if(isset($_POST['submit'])){
//validate inputs
  $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
  $student_name = mysqli_real_escape_string($conn, $_POST['studentname']);
  $student_address = mysqli_real_escape_string($conn, $_POST['address']);
  $student_gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $student_class = mysqli_real_escape_string($conn, $_POST['class']);
  $student_age = mysqli_real_escape_string($conn, $_POST['age']);
  $student_phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $student_email = mysqli_real_escape_string($conn, $_POST['email']);
//update query
  $sql = "UPDATE student SET student_name = '{$student_name}', student_address = '{$student_address}', student_gender = '{$student_gender}',
          student_class = '{$student_class}', student_age = '{$student_age}', student_phone = '{$student_phone}', student_email = '{$student_email}'
          WHERE student_id = '{$student_id}'";
  if(mysqli_query($conn, $sql)){
    header("$base_url/student.php"); // redirect
  }
} ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Update Student</h2>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <?php
                  $student_id = $_GET['sid'];
                  //select query
                  $sql = "SELECT * FROM student WHERE student_id = '{$student_id}'";
                  $result = mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){ ?>
                <form class="yourform" action="" method="post" autocomplete="off">
                  <div class="form-group">
                      <input type="hidden" class="form-control" name="student_id" value="<?php echo $row['student_id']; ?>" required>
                  </div>
                    <div class="form-group">
                        <label>Student Name</label>
                        <input type="text" class="form-control"  name="studentname" value="<?php echo $row['student_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control"  name="address" value="<?php echo $row['student_address']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" <?php echo ($row['student_gender'] == 'male') ? 'selected' : ''; ?> >Male</option>
                            <option value="female" <?php echo ($row['student_gender'] == 'female') ? 'selected' : ''; ?> >Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <input type="text" class="form-control"  name="class" value="<?php echo $row['student_class']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="text" class="form-control"  name="age" value="<?php echo $row['student_age']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control"  name="phone" value="<?php echo $row['student_phone']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control"  name="email" value="<?php echo $row['student_email']; ?>" required>
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
