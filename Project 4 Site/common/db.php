<?php
  function readDB($conn, $sql) {
    return mysqli_query($conn, $sql);
  }
 ?>
