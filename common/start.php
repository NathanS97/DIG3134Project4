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

  // Functions added for new tables + CRUD -NS
  function setCom() {
    //function to get comment data from form, adds to data table

    if (isset($_POST['comSubmit'])) {
      $username = $_POST['username'];
      $date = $_POST['date'];
      $comment = $_POST['comment'];
      
      $conn = connectDB();
      $sql = "INSERT INTO comments (username, dates, comment) VALUES ('$username','$date','$comment')";
      $result = $conn->query($sql);
      exit();

    }
  }

  function getCom() {
    //populates page with comments
    $conn = connectDB();

    $sql = "SELECT * FROM comments";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
      echo "<div class='comment-box'><p>";
      echo $row['username']."<br>";
      echo $row['dates']."<br>";
      echo nl2br($row['comment']);
      //end of comment, with edit and delelte buttons - NS
      if ($row['username'] == $_SESSION['userName']) {
        echo "</p>
        <form class='edit-form' action='editComment.php' method='POST'>
          <input type='hidden' name='cid' value='".$row['cid']."'>
          <input type='hidden' name='username' value='".$row['username']."'>
          <input type='hidden' name='date' value='".$row['dates']."'>
          <input type='hidden' name='comment' value='".$row['comment']."'>
          <button>Edit</button>
        </form>
        <form class='delete-form' action='".deleteCom()."' method='POST'>
          <input type='hidden' name='cid' value='".$row['cid']."'>
          <button name='comDelete'>Delete</button>
        </form>
      </div>";
      } else {
        echo "";
      }
      /*echo "</p>
        <form class='edit-form' action='editComment.php' method='POST'>
          <input type='hidden' name='cid' value='".$row['cid']."'>
          <input type='hidden' name='username' value='".$row['username']."'>
          <input type='hidden' name='date' value='".$row['dates']."'>
          <input type='hidden' name='comment' value='".$row['comment']."'>
          <button>Edit</button>
        </form>
        <form class='delete-form' action='".deleteCom()."' method='POST'>
          <input type='hidden' name='cid' value='".$row['cid']."'>
          <button name='comDelete'>Delete</button>
        </form>
      </div>";*/
    }
  }

  function editCom() {
    //function used to update the table with users edited comment - NS
    if (isset($_POST['comSubmit'])) {
      $cid = $_POST['cid'];
      $username = $_POST['username'];
      $date = $_POST['date'];
      $comment = $_POST['comment'];
      
      $conn = connectDB();
      $sql = "UPDATE comments SET comment='$comment' WHERE cid='$cid'";
      $result = $conn->query($sql);
      header("location: reviews.php");
    }
  }

  function deleteCom() {
    //function to delete comment when user presses the button - NS
    if (isset($_POST['comDelete'])) {
      $cid = $_POST['cid'];
      
      $conn = connectDB();
      $sql = "DELETE FROM comments WHERE cid='$cid'";
      $result = $conn->query($sql);
      header("location: reviews.php");
    }
  }

  function delAcc() {
    //function to delete user account - NS
    include 'config/db_conn.php';

    if (isset($_GET['deleteAcc'])) {
      $accountID = $_SESSION['userName'];

      $conn = connectDB();
      $sql = "DELETE FROM account WHERE username=?";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?error=sqlerror");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "s", $accountID);
        mysqli_stmt_execute($stmt);

        clearSession();
        header("location: index.php?delete=success");
        exit();
      }
    }
  }
?>
