<?php
include "config.php"; //db configuration

$author_id = $_POST['author_id'];
$check = "SELECT * FROM book WHERE book_author = '{$author_id}'";
$result = mysqli_query($conn, $check);
if(mysqli_num_rows($result) > 0){
  echo "<div class='alert alert-danger'>Cant't delete author record this author is used in books.</div>";
}else{
  //delete query
  $sql = "DELETE FROM author WHERE author_id = '{$author_id}'";

  if(mysqli_query($conn, $sql)){
    echo "<div class='alert alert-success'>Author deleted successfully.</div>";
  }else{
    echo "<div class='alert alert-danger'>Server side error.</div>";
  }
}
mysqli_close($conn);
?>
