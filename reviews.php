<?php
  include './common/start.php';
  include 'config/db_conn.php';
  start();
  logout();

  date_default_timezone_set('US/Eastern');
 ?>
<?php include './templates/header.php'; ?>  
  <link rel="stylesheet" href="public/style/main.css">
  <link rel="stylesheet" href="public/style/mediaquery.css">
<?php include './templates/nav.php'; ?>
  <!--Reviews page with comments, both from database, needs styling from Hongda - NS-->
  <div class="">
    <!--Reviews from database-->
    <?php
      $conn = connectDB();

      $sql = "SELECT * FROM reviews";
      $result = $conn->query($sql);
  
      while ($row = $result->fetch_assoc()) 
      {
      ?>
        <div class="">
          <h3 class=""><?php echo $row['username']?></h3>
          <p class=""><?php echo $row['dates']?></p>
          <p class=""><?php echo $row['review']?>></p>
          <img src="<?php echo $row['img']?>" alt="database content">
        </div>
      <?php
      }
      ?>

    <!--Comment form, gets comments and inserts to database - NS-->
    <div class=""> 
      <?php
      if (isset($_SESSION['loggedin'])) {
        echo "<form action='".setCom()."' method='post'>
          <input type='hidden' name='username' value='".$_SESSION['userName']."'>
          <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
          <textarea name='comment' cols='75' rows='3'></textarea><br>
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