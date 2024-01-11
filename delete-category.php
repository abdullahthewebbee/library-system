<?php
  include "config.php"; // deb configuration

  $category_id = $_POST['category_id'];
  //check category name is used  in books table
  $check = "SELECT * FROM book WHERE book_category = '{$category_id}'";
  $result = mysqli_query($conn, $check);
  if(mysqli_num_rows($result) > 0){
    echo "<div class='alert alert-danger'>Cant't delete category record this category is used in books.</div>";
  }else{
    //delete query
    $sql = "DELETE FROM category WHERE category_id = '{$category_id}'";
    if(mysqli_query($conn, $sql)){
      echo "<div class='alert alert-success'>Publisher deleted successfully.</div>";
    }else{
      echo "<p style='color: red; margin: 10px 0;'>Server side error.</p>";
    }
  }
mysqli_close($conn);
?>
