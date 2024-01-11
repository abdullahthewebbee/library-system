<?php

include "config.php"; //db configuration

$student_id = $_POST["student_id"];
//select query
$sql = "SELECT * FROM student WHERE student_id = {$student_id}";
$result = mysqli_query($conn, $sql) or die("SQL query failed.");
$output = "";
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
                  <td>Student Name :</td>
                  <td>
                    <b>{$row['student_name']}</b>
                  </td>
                </tr>
                <tr>
                  <td>Address :</td>
                  <td>
                    <b>{$row['student_address']}</b>
                  </td>
                </tr>
                <tr>
                  <td>Gender :</td>
                  <td>
                    <b>{$row['student_gender']}</b>
                  </td>
                </tr>
                <tr>
                  <td>Class :</td>
                  <td>
                    <b>{$row['student_class']}</b>
                  </td>
                </tr>
                <tr>
                  <td>Age :</td>
                  <td>
                    <b>{$row['student_age']}</b>
                  </td>
                </tr>
                <tr>
                  <td>Phone :</td>
                  <td>
                    <b>{$row['student_phone']}</b>
                  </td>
                </tr>
                <tr>
                  <td>Email :</td>
                  <td>
                    <b>{$row['student_email']}</b>
                  </td>
                </tr>";
  }

  mysqli_close($conn);

  echo $output;
}else{
  echo "<h2>No record found.</h2>";
} ?>
