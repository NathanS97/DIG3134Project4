<?php
  // turn into page to populate reviews table, use content Brooke created - NS
  // atom git commit test
  session_start();

  $errors = ["username" => "", "date" => "", "review" => "", "image" => ""];

  if(isset($_POST['submit'])) {

    if (!isset($_SESSION['userName'])) {
      $errors['username'] = "You must be logged in to continue!";
      //header("location: survey.php?error=notlogged");
      //exit();
    } else {
      $username = $_SESSION['userName'];
    }

    if (empty($_POST['date'])) {
      $errors['date'] = "You must enter a date!";
    } else {
      $date = $_POST['date'];
    }

    if (empty($_POST['review'])) {
      $errors['review'] = "You must enter a review!";
      //exit();
    } else {
      $review = $_POST['review'];
      if (!preg_match("/\b((?!=|\,|\.).)+(.)\b/", $review)) {
          $errors['review'] = "Your review must be in regular sentences";
      }
    }

    if (!isset($_FILES['img'])) {
      $errors['image'] = "You must upload an image!";
      //exit();
    } else {
      $file_name = basename($_FILES["img"]["name"]);
      $file_dir = "public/img";
      $image = ".$file_dir./.$file_name.";
      $file_tmp = $_FILES['img']['tmp_name'];
      $file_type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
      
      if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif" ) {
        $errors['image'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
      } else {
        if (move_uploaded_file($file_tmp, $image)) {
          echo "Your review containing ".$file_name." has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your review.";
        }
      }
    }

    if (array_filter($errors)) {
      print_r($errors);
    } else {
      //SQL GOES HERE
      include 'config/db_conn.php';
      $conn = connectDB();
      

      $sql = "SELECT username FROM reviews WHERE username =?";
      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt, $sql)) {
        //header("location: survey.php?error=sqlerror");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        $sql = "INSERT INTO reviews (username, dates, review, img) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          //header("location: survey.php?error=sqlerror2");
          //exit();
        } else {
          mysqli_stmt_bind_param($stmt, "ssss", $username, $date, $review, $image);
          mysqli_stmt_execute($stmt);

          // CHECK mysqli_stmt_error($stmt);

          //header("location: index.php?postreview=success");
          //exit();
        }
      }
    }
  }
 ?>

<!--Markup also needs changing - NS -->
<?php include './templates/header.php'; ?>
    <link rel="stylesheet" href="public/style/survey_style.css">
<?php include './templates/nav.php' ?>
  <div class="container">
    <form class="survey" action="survey.php" method="post" enctype="multipart/form-data">
      <h1 class="survey_pg_title">Vacation Travel Review</h1>
        <div class="error_output">
          <?php echo $errors['username']; ?>
        </div>
        <div class="error_output">
          <?php echo $errors['date']; ?>
        </div>
        <div class="error_output">
          <?php echo $errors['review']; ?>
        </div>
        <div class="error_output">
          <?php echo $errors['image']; ?>
        </div>
      <div class="survey_question">
        <h2 class="survey_title">When did you go on your trip?</h2>
        <input type="text" name="date" placeholder="01-01-2019">
      </div>
      <div class="survey_question" required>
        <h2 class="survey_title">Please write your review here:</h2>
        <textarea
          cols="40"
          rows="4"
          name="review"
          placeholder="Write a review!"></textarea>
      </div>
      <div class="survey_question">
        <h2 class="survey_title">Please upload an image of your trip:</h2>
        <input type="file" name="img">
      </div>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
<?php include './templates/footer.php' ?>
