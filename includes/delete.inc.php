<?php
  // function for users to delete their comment, call in button/hyperlink - NS
  function delCom($conn) {
    if (isset($_POST['commentDelete'])) {
      $commentID = $_POST['comm'];

      $sql = "DELETE FROM comments WHERE comment='$commentID'";
      $result = $conn->query($sql);
      header("location: index.php");
    }
  }

  function delAcc($conn) {
    if (isset($_POST['accountDelete'])) {
      $accountID = $_POST['acc'];

      $sql = "DELETE FROM account WHERE username='$accountID'";
      $result = $conn->query($sql);
      header("location: index.php");
    }
  }
?>