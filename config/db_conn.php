<?php
  function connectDB() {
    return mysqli_connect('localhost', 'root', '', 'project_four');
    if (!$conn) {
      die(mysqli_connect_error());
    }
  }




 ?>
