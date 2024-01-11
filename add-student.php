<?php include "header.php" ?> <!-- header -->
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2 class="admin-heading">Add Student</h2>
            </div>
            <div class="offset-md-7 col-md-2">
                <a class="add-new" href="student.php">All Students</a>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <?php // if form submit
                if(isset($_POST['save'])){
                    if(empty($_POST['studentname']) || empty($_POST['address']) || empty($_POST['gender']) || empty($_POST['class']) || empty($_POST['age']) || empty($_POST['phone']) || empty($_POST['email'])){
                        echo "<div class='alert alert-danger'>Please Fill All the Fields.</div>";
                    }else{
                        //validate inputs
                        $student_name = mysqli_real_escape_string($conn, $_POST['studentname']);
                        $student_address = mysqli_real_escape_string($conn, $_POST['address']);
                        $student_gender = mysqli_real_escape_string($conn, $_POST['gender']);
                        $student_class = mysqli_real_escape_string($conn, $_POST['class']);
                        $student_age = mysqli_real_escape_string($conn, $_POST['age']);
                        $student_phone = mysqli_real_escape_string($conn, $_POST['phone']);
                        $student_email = mysqli_real_escape_string($conn, $_POST['email']);
                        //insert query
                        $sql = "INSERT INTO student(student_name,student_address,student_gender,student_class,student_age,student_phone,student_email)
                                VALUES ('{$student_name}','$student_address','$student_gender','$student_class','$student_age','$student_phone','$student_email')";

                        if(mysqli_query($conn, $sql)){
                        header("$base_url/student.php"); //redirect
                        }else{
                        echo "<div class='alert alert-danger'>Query failed.</div>";
                        }
                    }
                } ?>
                <form class="yourform" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Student Name</label>
                        <input type="text" class="form-control" placeholder="Student Name" name="studentname" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Address" name="address" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <input type="text" class="form-control" placeholder="Class" name="class" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" class="form-control" placeholder="Age" name="age" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Phone" name="phone" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-danger" value="save" required>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?> <!-- footer -->
