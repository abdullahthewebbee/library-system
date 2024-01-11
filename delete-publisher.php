<?php
  include "config.php"; // db configuration

  $publisher_id = $_POST['publisher_id'];
  //check publisher name is used in books table
  $check = "SELECT * FROM book WHERE book_publisher = '{$publisher_id}'";
  $result = mysqli_query($conn, $check);
  if(mysqli_num_rows($result) > 0){
    echo "<div class='alert alert-danger'>Cant't delete publisher record this publisher is used in books.</div>";
  }else{
    //delete query
    $sql = "DELETE FROM publisher WHERE publisher_id = '{$publisher_id}'";
    if(mysqli_query($conn, $sql)){
      echo "<div class='alert alert-success'>Publisher deleted successfully.</div>";
    }else{
      echo "<p style='color: red; margin: 10px 0;'>Server side error.</p>";
    }
  }
  mysqli_close($conn);
?>
