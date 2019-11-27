<?php
  // turn into page to populate reviews table, use content Brooke created - NS
  // atom git commit test
  session_start();

  $errors = ["username" => "", "date" => "", "review" => "", "image" => ""];
  if (isset($_POST['submit'])) {

    if (!isset($_SESSION['userName'])) {
      $errors['username'] = "You must be logged in to continue!";
      header("location: survey.php");
      exit();
    } else {
      $username = $_SESSION['userName'];
    }

    if (empty($_POST['date'])) {
      $errors['date'] = "You must enter a date!";
    }

    if (empty($_POST['review'])) {
      $errors['review'] = "You must enter a review!";
      exit();
    } else {
      $review = $_POST['review'];
      if (!preg_match("/\b((?!=|\,|\.).)+(.)\b/", $review)) {
          $errors['review'] = "Your review must be in regular sentences";
      }
    }

    if (!isset($_FILES['image'])) {
      $errors['image'] = "You must upload an image!";
      exit();
    } else {
      $file_name = $_FILES['image']['name'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors['image']="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"public/img/".$file_name);
         echo "Success";
      } else {
         print_r($errors);
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
        header("location: survey.php?error=sqlerror");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        if ($resultCheck = 0) {
          header("location: survey.php?error=userreviewtaken");
        } else {
          $sql = "INSERT INTO reviews (username, dates, review, img) VALUES (?,?,?,?)";
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: survey.php?error=sqlerror2");
            exit();
          } else {
            mysqli_stmt_bind_param($stmt, "ssss", $username, $date, $review, $image);
            mysqli_stmt_execute($stmt);

            header("location: index.php?postreview=success");
            exit();
          }
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
        <input type="file" name="image">
      </div>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
<?php include './templates/footer.php' ?>
