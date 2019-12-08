<?php
  include './common/start.php';
  include 'config/db_conn.php';
  start();
  logout();

  date_default_timezone_set('US/Eastern');
 ?>
<?php //include './templates/header.php'; ?>  
  <link rel="stylesheet" href="public/style/main.css">
  <link rel="stylesheet" href="public/style/mediaquery.css">
<?php //include './templates/nav.php'; ?>

  <!--Comment form, gets comments and inserts to database-->
  <div>
    <?php
    $cid = $_POST['cid'];
    $username = $_POST['username'];
    $date = $_POST['date'];
    $comment = $_POST['comment'];

    /*.$_SESSION['userName'].*/
    echo "<form action='".editCom()."' method='post'>
      <input type='hidden' name='cid' value='".$cid."'>
      <input type='hidden' name='username' value='".$username."'>
      <input type='hidden' name='date' value='".$date."'>
      <textarea name='comment' cols='75' rows='3'>".$comment."</textarea><br>
      <button type='submit' name='comSubmit'>Edit comment</button>
    </form>";
    ?>
  </div>
<?php include './templates/footer.php' ?>