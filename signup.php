<?php
  include './common/start.php';
  include './config/db_conn.php';
  include './common/validate.php';
  $username = $password = $email = "";

  $errors = ["username" => "", "email" => "", "password" => "" ];

  if (isset($_POST['submit'])) {
    //write all data to a file


    list($result1, $result2, $result3) = signupValidation($_POST);
    // print_r($result1);
    // print_r($result2);
    // print_r($result3);
    $username = $result1[0];
    $email = $result2[0];
    $password = $result3[0];

    // echo $username . "<br>";
    // echo $password . "<br>";
    // echo $email;

    $errors['username'] = $result1[1];
    $errors['email'] = $result2[1];
    $errors['password'] = $result3[1];

    if (!array_filter($errors)) {
      // echo $username . " " . $email;
      $conn = connectDB();
      $sql = "SELECT username FROM account WHERE username = ? AND email = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_email);
        $param_username = $username;
        $param_email = $email;

        if(mysqli_stmt_execute($stmt)) {
          mysqli_stmt_store_result($stmt);
          if (mysqli_stmt_num_rows($stmt) == 1) {
            $errors['username'] = "This username is already taken.";
            $errors['email'] = "This email is already taken.";
          } else {
            $sql = "INSERT INTO account (username, email, password) VALUES (?, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
              mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
              $param_username = $username;
              $param_email = $email;
              $param_password = password_hash($password, PASSWORD_DEFAULT);
              if (mysqli_stmt_execute($stmt)) {
                header('Location: index.php');
              } else {
                echo "Something went wrong. Please try again later.";
              }
            }
          }
        } else {
          echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
      }
      mysqli_close($conn);
      // $sql = "SELECT  FROM user WHERE userName = '$username' AND email = '$email'";
      // $result = mysqli_query($conn, $sql);
      // $row = mysqli_fetch_assoc($result);
      // if ($row) {
      //   $errors['username'] = "This username has alreadly existed";
      //   $errors['email'] = "This email has alreadly been used";
      // } else {
      //   include('./config/db_conn.php');
      //   $sql = "INSERT INTO `user` (userName, email, password) VALUES ('$username', '$email', '$encrypted_pass')";
      //   $result = mysqli_query($conn, $sql);
      //   if ($result) {
      //     mysqli_close($conn);
      //     header('Location: index.php');
      //   }
      // }

    }
  }
 ?>

<?php include "./templates/header.php" ?>
  <link rel="stylesheet" href="public/style/sign_up.css">
  <link rel="stylesheet" href="public/style/signupmediaquery.css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.slim.js"
  integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
  crossorigin="anonymous"></script>
<?php include "./templates/nav.php" ?>
  <div class="container">
    <div class="hero-section">
      <div class="hero-container">
        <h1 class="hero-title">Sign Up for VACAYELP</h1>
        <p class="hero-text">Create an account to review your favorite place and share it with others</p>
      </div>
    </div>
    <div class="sidebar">
      <form class="sign-up-form" action="signup.php" method="post">
        <h2 class="sign-up-header">Create an account</h2>
        <div class="sign-up-container">
          <label for="username" class="sign-up-label">
            <input type="text" name="username" id="username" class="sign-up-input" onblur="inputHandle(this)">
            <span class="sign-up-title">Username:</span>
            <div class="error_output">
              <?php echo $errors['username']; ?>
            </div>
          </label>
          <label for="email" class="sign-up-label">
            <input type="email" name="email" id="email" class="sign-up-input" onblur="inputHandle(this)">
            <span class="sign-up-title">Email:</span>
            <div class="error_output">
              <?php echo $errors['email']; ?>
            </div>
          </label>
          <label for="password" class="sign-up-label">
            <input type="password" name="password" id="password" class="sign-up-input" onblur="inputHandle(this)">
            <span class="sign-up-title">Password:</span>
            <div class="error_output">
              <?php echo $errors['password']; ?>
            </div>
          </label>
        </div>
        <button type="submit" name="submit" class="btn">Sign Up</button>
      </form>
    </div>
  </div>
  <script type="text/javascript">
  function inputHandle(event) {
    if (event.value !== "") {
      event.nextElementSibling.classList = 'moveUp';
    } else {
      event.nextElementSibling.classList = 'sign-up-title';
    }
  }
  window.onload = function() {
    console.log('loaded');
  }
  </script>
<?php include "./templates/footer.php" ?>
