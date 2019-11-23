<?php
  // function for users to delete their comment, call in button/hyperlink - NS
  function delCom($conn) {
    if (isset($_POST['commentDelete'])) {
      $commentID = $_POST['cid'];

      $sql = "DELETE FROM comments WHERE comment='$commentID'";
      $result = $conn->query($sql);
      header("location: index.php");
    }
  }
?>