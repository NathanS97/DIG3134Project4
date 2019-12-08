<?php
  // turn into page to populate reviews table, use content Brooke created - NS
  // atom git commit test
  session_start();

  $errors = ["username" => "", "date" => "", "review" => "", "image" => "", 'title' => ''];

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

    if (empty($_POST['title'])) {
      $errors['title'] = "You must enter a location!";
    } else {
      $title = $_POST['title'];
      if (!preg_match("/^[a-zA-Z]+$/", $title)) {
          $errors['title'] = "Your review must be in regular sentences";
      }
    }

    if (empty($_POST['review'])) {
      $errors['review'] = "You must enter a review!";
      //exit();
    } else {
      $review = $_POST['review'];
      if (!preg_match("/[^\r\n]+((\r|\n|\r\n)[^\r\n]+)*/", $review)) {
          $errors['review'] = "Your review must be in regular sentences";
      }
    }

    if (!isset($_FILES['img'])) {
      $errors['image'] = "You must upload an image!";
      //exit();
    } else {
      $file_name = basename($_FILES["img"]["name"]);
      $file_dir = "public/img";
      $image = "./$file_dir/$file_name.";
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

        $sql = "INSERT INTO reviews (username, dates, review, img, title) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          //header("location: survey.php?error=sqlerror2");
          //exit();
        } else {
          mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_date, $param_review, $param_image, $param_title);
          $param_username = $username;
          $param_date = $date;
          $param_review = $review;
          $param_image = $image;
          $param_title = $title;
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
          <h2 class="survey_title">Where did you visit for your vacation?</h2>
          <input type="text" name="title">
        </div>
      <div class="survey_question">
        <h2 class="survey_title">When did you go on your trip?</h2>
        <input type="text" name="date" placeholder="01-01-2019">
      </div>

      <div class="survey_question" required>
        <h2 class="survey_title">Please write your review here:</h2>
        <textarea
          style="min-width: 900px; min-height: 500px; padding: 1em; font-size: 1.1rem; outline: none; border: none; border-bottom: 1px solid #c1c1c1;"
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

<?php
  // turn into page to populate reviews table, use content Brooke created - NS
  // atom git commit test
  // session_start();
  //
  // $errors = ["username" => "", "date" => "", "review" => "", "image" => "", 'title' => ''];
  //
  // if(isset($_POST['submit'])) {
  //
  //   if (!isset($_SESSION['userName'])) {
  //     $errors['username'] = "You must be logged in to continue!";
  //     //header("location: survey.php?error=notlogged");
  //     //exit();
  //   } else {
  //     $username = $_SESSION['userName'];
  //   }
  //
  //   if (empty($_POST['date'])) {
  //     $errors['date'] = "You must enter a date!";
  //   } else {
  //     $date = $_POST['date'];
  //   }
  //
  //   if (empty($_POST['title'])) {
  //     $errors['title'] = "You must enter a location!";
  //   } else {
  //     $title = $_POST['title'];
  //     if (!preg_match("/^[a-zA-Z]+$/", $title)) {
  //         $errors['title'] = "Your review must be in regular sentences";
  //     }
  //   }
  //
  //   if (empty($_POST['review'])) {
  //     $errors['review'] = "You must enter a review!";
  //     //exit();
  //   } else {
  //     $review = $_POST['review'];
  //     if (!preg_match("/[^\r\n]+((\r|\n|\r\n)[^\r\n]+)*/", $review)) {
  //         $errors['review'] = "Your review must be in regular sentences";
  //     }
  //   }
  //
  //   if (!isset($_FILES['img'])) {
  //     $errors['image'] = "You must upload an image!";
  //     //exit();
  //   } else {
  //     $file_name = basename($_FILES["img"]["name"]);
  //     $file_dir = "public/img";
      // $image = ".$file_dir./.$file_name.";
  //     $fileDestination = 'public/img'.$file_name;
  //     $file_tmp = $_FILES['img']['tmp_name'];
  //     $file_type = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
  //
  //     if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif" ) {
  //       $errors['image'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
  //     } else {
  //       if (move_uploaded_file($file_tmp, $fileDestination)) {
  //         echo "Your review containing ".$file_name." has been uploaded.";
  //       } else {
  //         echo "Sorry, there was an error uploading your review.";
  //       }
  //     }
  //   }
  //
  //   if (array_filter($errors)) {
  //     print_r($errors);
  //   } else {
  //     //SQL GOES HERE
  //     include 'config/db_conn.php';
  //     $conn = connectDB();
  //
  //
  //     $sql = "SELECT username FROM reviews WHERE username =?";
  //     $stmt = mysqli_stmt_init($conn);
  //
  //     if(!mysqli_stmt_prepare($stmt, $sql)) {
  //       //header("location: survey.php?error=sqlerror");
  //       exit();
  //     } else {
  //       mysqli_stmt_bind_param($stmt, "s", $username);
  //       mysqli_stmt_execute($stmt);
  //       mysqli_stmt_store_result($stmt);
  //       $resultCheck = mysqli_stmt_num_rows($stmt);
  //
  //       $sql = "INSERT INTO reviews (username, dates, review, img, title) VALUES (?,?,?,?,?)";
  //       $stmt = mysqli_stmt_init($conn);
  //
  //       if (!mysqli_stmt_prepare($stmt, $sql)) {
  //         //header("location: survey.php?error=sqlerror2");
  //         //exit();
  //       } else {
  //         mysqli_stmt_bind_param($stmt, "sssss", $username, $date, $review, $image, $title);
  //         mysqli_stmt_execute($stmt);
  //
  //         // CHECK mysqli_stmt_error($stmt);
  //
  //         //header("location: index.php?postreview=success");
  //         //exit();
  //       }
  //     }
  //   }
  // }
 ?>

<!--Markup also needs changing - NS -->
<?php //include './templates/header.php'; ?>
    <!-- <link rel="stylesheet" href="public/style/survey_style.css"> -->
<?php// include './templates/nav.php' ?>
  <!-- <div class="container">
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
          <h2 class="survey_title">Where did you visit for your vacation?</h2>
          <input type="text" name="title">
        </div>
      <div class="survey_question">
        <h2 class="survey_title">When did you go on your trip?</h2>
        <input type="text" name="date" placeholder="01-01-2019">
      </div>

      <div class="survey_question" required>
        <h2 class="survey_title">Please write your review here:</h2>
        <textarea
          style="min-width: 900px; min-height: 500px; padding: 1em; font-size: 1.1rem; outline: none; border: none; border-bottom: 1px solid #c1c1c1;"
          name="review"
          placeholder="Write a review!"></textarea>
      </div>
      <div class="survey_question">
        <h2 class="survey_title">Please upload an image of your trip:</h2>
        <input type="file" name="img">
      </div>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div> -->
<?php //include './templates/footer.php' ?>
