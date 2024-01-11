<?php
  include "config.php"; // db configuration

  $student_id = $_POST['sid'];
  //check category name is used  in books table
  $check = "SELECT * FROM book_issue WHERE issue_name = '{$student_id}' AND issue_status='N'";
  $result = mysqli_query($conn, $check);
  if(mysqli_num_rows($result) > 0){
    echo "<div class='alert alert-danger'>Cant't delete this student. Book issued to this student.</div>";
  }else{
    //delete query
    $sql = "DELETE FROM student WHERE student_id = '{$student_id}'";
    if(mysqli_query($conn, $sql)){
      echo "<div class='alert alert-success'>Student deleted successfully.</div>";
    }else{
      echo "<p style='color: red; margin: 10px 0;'>Server side error.</p>";
    }
  }
  mysqli_close($conn);
?>
