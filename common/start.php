<?php
  function start() {
    return session_start();
  }

  function clearSession() {
    session_unset();
    session_destroy();
  }

  function loggedin() {
    return isset($_SESSION["loggedin"]);
  }

  function logout() {
    if (isset($_GET["signout"])) {
      if ($_GET['signout'] === 'true') {
        clearSession();
      }
    }
  }

  function delCom() {
    if (isset($_GET['deleteComment'])) {
      $commentID = $_POST['comment'];

      $sql = "DELETE FROM comments WHERE comment=?";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?error=sqlerror");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "s", $commentID);
        mysqli_stmt_execute($stmt);
      }
  
      header("location: index.php");
      exit();
    }
  }

  function delAcc() {
    include 'config/db_conn.php';

    if (isset($_GET['deleteAcc'])) {
      $accountID = $_SESSION['userName'];

      $conn = connectDB();
      $sql = "DELETE FROM account WHERE username=$accountID";

      if (mysqli_query($conn, $sql)) {
        header("location: index.php?delete=success"); 
        exit();
      } else {
        header("location: index.php?delete=failure");
        exit();
      }
    }
  }
?>
