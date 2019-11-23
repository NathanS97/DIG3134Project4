<?php
  include './common/start.php';
  include './config/db_conn.php';
  include './common/validate.php';

  $conn = connectDB();

  $sql = 'SELECT id, userName, password FROM user WHERE id = ?';

  if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $id = 1;
    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);
    $num_of_rows = mysqli_stmt_num_rows($stmt);

    mysqli_stmt_bind_result($stmt, $id, $userName, $password);

    mysqli_stmt_fetch($stmt);

    while(mysqli_stmt_fetch($stmt)) {
      echo "ID: " .$id. '<br>';
      echo "userName: " .$userName. '<br>';
      echo "password: " .$password. '<br>';

    }


    mysqli_stmt_close($stmt);
  }

?>
