<?php

  include "config.php"; // db configuration

  $book_id = $_POST['book_id'];
  //check book is issued 
  $check = "SELECT * FROM book_issue WHERE issue_book = '{$book_id}'";
  $result = mysqli_query($conn, $check);
  if(mysqli_num_rows($result) > 0){
    echo "<div class='alert alert-danger'>Cant't delete book record this is used in book issue.</div>";
  }else{
    //delete query
    $sql = "DELETE FROM book WHERE book_id = '{$book_id}'";

    if(mysqli_query($conn, $sql)){
      echo "<div class='alert alert-success'>Book record deleted successfully.</div>";
    }else{
      echo "<p style='color: red; margin: 10px 0;'>Server side error.</p>";
    }
  }
  mysqli_close($conn);
?>
