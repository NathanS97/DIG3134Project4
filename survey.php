<?php
  session_start();
  $destination = $recommand = $reason = $travel_agent = $cost = $next_trip = $phone_number = $email = "";

  $errors = ["destination" => "", "reason" => "", "phone" => "", "email" => ""];
  $options = ["recommand", "travel_agent", "cost", "next_trip"];
  $optErr = ["recommand" =>"", "travel_agent" => "", "cost" => "", "next_trip" => ""];
  if (isset($_POST['submit'])) {
    if (empty($_POST['destination'])) {
        $errors['destination'] = "A destination is required";
    } else {
      $destination = $_POST['destination'];
      if (!preg_match("/^[a-zA-Z]+$/", $destination)) {
          $errors['destination'] = "Only letters allowed";
      }
    }
    if (empty($_POST['reason'])) {
        $errors['reason'] = "A few reasons are required";
    } else {
      $reason = $_POST['reason'];
      if (!preg_match("/\b((?!=|\,|\.).)+(.)\b/", $reason)) {
          $errors['reason'] = "Your comment must be some regular sentenses";
      }
    }
    if (!isset($_SESSION['loggedin'])) {
      if (empty($_POST['phone_number'])) {
          $errors['phone_number'] = "Your phone number is required";
      } else {
        $phone_number = $_POST["phone_number"];
        if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone_number)) {
            $errors['phone_number'] = "Phone number must be numbers separated by forward slash";
        }
      }
      if (empty($_POST['email'])) {
          $errors['email'] = "Your email is required";
      } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "$email is not a valid email address";
        }
      }
    }




    foreach ($options as $opt) {
      if (empty($_POST[$opt])) {
        $optErr[$opt] = "Please choose an option";
      }
    }
    // $recommand = $_POST['recommand'];
    $travel_agent = $_POST['travel_agent'];
    $next_trip = $_POST['cost'];
    $next_trip = $_POST['next_trip'];

    if (array_filter($errors)) {
      print_r($errors);
    } else {

      $_SESSION['email'] = $_POST['email'];
      $_SESSION['phone_number'] = $_POST['phone_number'];

      header('Location: fin.php');
    }
  }



 ?>

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
