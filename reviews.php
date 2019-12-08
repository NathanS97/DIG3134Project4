<?php
  include './common/start.php';
  include 'config/db_conn.php';
  include './reviewCard.php';
  start();
  logout();

  date_default_timezone_set('US/Eastern');

  $conn = connectDB();

  $sql = "SELECT * FROM reviews";
  $result = $conn->query($sql);

  $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);

  for ($i=0; $i < count($reviews); $i++) {
     ${'review'.$i} = new Reviewcard($reviews[$i]['title'], $reviews[$i]['img'], $reviews[$i]['dates'] );
  }

 ?>
<?php include './templates/header.php'; ?>
  <link rel="stylesheet" href="public/style/main.css">
  <link rel="stylesheet" href="public/style/mediaquery.css">
  <link rel="stylesheet" href="public/style/review.css">
<?php include './templates/nav.php'; ?>
  <!--Reviews page with comments, both from database, needs styling from Hongda - NS-->
  <div class="container review-box">
    <!--Reviews from database-->


      <div class="row">
        <?php echo $review0->renderCard(); ?>
      </div>

    <!--Comment form, gets comments and inserts to database - NS-->
    <div class="comment-section">
      <h4>Comment</h4>
      <?php
      if (isset($_SESSION['loggedin'])) {
        echo "<form action='".setCom()."' method='post'>
          <input type='hidden' name='username' value='".$_SESSION['userName']."'>
          <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
          <textarea name='comment'  class='comment-box'></textarea><br>
          <button type='submit' name='comSubmit'>Post comment</button>
        </form>";
      } else {
        echo "<p>You must be logged in to comment!</p>";
      }
      /*echo "<form action='".setCom()."' method='post'>
        <input type='hidden' name='username' value='".$_SESSION['userName']."'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='comment' cols='75' rows='3'></textarea><br>
        <button type='submit' name='comSubmit'>Post comment</button>
      </form>";*/

      getCom();
      ?>
    </div>
  </div>
<?php include './templates/footer.php' ?>
