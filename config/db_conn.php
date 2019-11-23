<?php
  function connectDB() {
    return mysqli_connect('localhost', 'root', '', 'users');
    if (!$conn) {
      die(mysqli_connect_error());
    }
  }




 ?>
