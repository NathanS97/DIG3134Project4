<?php
  // turn into page to populate reviews table, use content Brooke created - NS
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
      # code...
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

    if (empty($_POST['img'])) {
      $errors['image'] = "You must upload an image!";
      exit();
    } else {
      $image = $_POST['img'];
    }

    if (array_filter($errors)) {
      print_r($errors);
    } else {
      //SQL GOES HERE
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
          $sql = "INSERT INTO reviews (username, date, review, image) VALUES (?,?,?,?)";
          $stmt = mysqli_stmt_init($connection);

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


      header('Location: fin.php');
    }
  }



 ?>
<!--Markup also needs changing - NS -->
<?php include './templates/header.php'; ?>
    <link rel="stylesheet" href="public/style/survey_style.css">
<?php include './templates/nav.php' ?>
  <div class="container">
    <form class="survey" action="survey.php" method="post">
      <h1 class="survey_pg_title">Vacation Travel Survey</h1>
      <div class="survey_question">
        <h2 class="survey_title">Where is your favorite vacation destination?</h2>
        <label for="destination">
          <input type="text" name="destination" class="survey_txt" value="<?php echo $destination ?>">
        </label>
        <div class="error_output">
          <?php echo $errors['destination']; ?>
        </div>
      </div>
      <div class="survey_question" required>
        <h2 class="survey_title">Would you like to recommand this place to other people?</h2>
        <label class="op_container">Yes
          <input type="radio" name="recommand" value="yes">
          <span class="checkmark"></span>
        </label>
        <label class="op_container">No
          <input type="radio" name="recommand" value="no">
          <span class="checkmark"></span>
        </label>
        <div class="error_output">
          <?php echo $optErr['recommand']; ?>
        </div>
      </div>
      <div class="survey_question">
        <h2 class="survey_title">Why</h2>
        <textarea name="reason" class="text_box" value="<?php echo $recommand; ?>"></textarea>
        <div class="error_output">
          <?php echo $errors['reason']; ?>
        </div>
      </div>
      <div class="survey_question">
        <h2 class="survey_title">How often do you use a travel agent when making vacation plans</h2>
        <select class="select_css" name="travel_agent" required>

          <option value="always">Always</option>
          <option value="most">Most of the time</option>
          <option value="half">About half</option>
          <option value="once">Once in a while</option>
          <option value="never">never</option>
        </select>
        <div class="error_output">
          <?php echo $optErr['travel_agent']; ?>
        </div>
      </div>
      <div class="survey_question">
        <h2 class="survey_title">How important is cost when choosing a vacation destination?</h2>
        <select class="select_css" name="cost" required>
          <option value="extremely">Extremely important</option>
          <option value="very">Very important</option>
          <option value="moderately">Moderately important</option>
          <option value="slightly">Slightly important</option>
          <option value="not_at_all">Not at all important</option>
        </select>
        <div class="error_output">
          <?php echo $optErr['cost']; ?>
        </div>
      </div>
      <div class="survey_question">
        <h2 class="survey_title">How likely are you to go on vacation outside the continental United States in the next 12 months?</h2>
        <select class="select_css" name="next_trip" required>
          <option value="extremely">Extremely likely</option>
          <option value="very">Very likely</option>
          <option value="moderately">Moderately likely</option>
          <option value="slightly">Slightly likely</option>
          <option value="not_at_all">Not at all likely</option>
        </select>
        <div class="error_output">
          <?php echo $optErr['next_trip']; ?>
        </div>
      </div>
      <?php if (!isset($_SESSION['loggedin'])) { ?>
        <div class="survey_question">
          <h2>Your contact</h2>
          <label for="phone_num contact">Phone number:
            <input type="text" name="phone_number" id="phone_num" value="<?php echo $phone_number; ?>">
          </label>
          <div class="error_output">
            <?php echo $errors['phone']; ?>
          </div>
          <label for="email contact">E-mail:
            <input type="text" name="email" id="email" value="<?php echo $email ?>">
          </label>
          <div class="error_output">
            <?php echo $errors['email']; ?>
          </div>
        </div>
      <?php } ?>
      <button type="submit" name="submit">Submit</button>
    </form>
  </div>
<?php include './templates/footer.php' ?>
