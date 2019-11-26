<?php
  include './common/start.php';
  include './config/db_conn.php';
  include './common/validate.php';
  start();
  $username = $password = "";
  $errors = ["username" => '', "password" => ''];


  // $pwd = 'dig3134pass';
  // $hash = password_hash($pwd, PASSWORD_DEFAULT);
  // echo $hash;




  if (isset($_POST['login'])) {
    list($result1, $result2) = validation($_POST);

    // print_r($result1);
    $username = $result1[0];
    $errors['username'] = $result1[1];
    // print_r($result2);
    $password = $result2[0];
    // echo $password . ' from post request';
    $errors['password'] = $result2[1];



    if (!array_filter($errors)) {
      $conn = connectDB();
      $sql = "SELECT username, pword FROM account WHERE username = ?";
      if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;
        if (mysqli_stmt_execute($stmt)) {
          mysqli_stmt_store_result($stmt);
          if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $userName, $hashed_password);
            if(mysqli_stmt_fetch($stmt)) {
              if (password_verify($password, $hashed_password)) {
                $_SESSION['loggedin'] = 'success';
                $_SESSION['userName'] = $username;
                // header('Location: login.php');
              } else {
                $errors['password'] = "The password you entered was not valid.";
              }
            }
          }
          else {
            $errors['username'] = "No account found with that username.";
          }
        } else {
          echo "Something went wrong.";
        }
        mysqli_stmt_close($stmt);
      }
      mysqli_close($conn);


      // $result = mysqli_query($conn, $sql);
      // $row = mysqli_fetch_assoc($result);
      // print_r($row);
      // if (!$result) {
      //   $errors['username'] = "The username you entered doesn't belong to an account.";
      //   $errors['password'] = "Please check your password and try again.";
      // } else {
      //   $row = mysqli_fetch_assoc($result);
      //
      //   $_SESSION['loggedin'] = 'success';
      //   $_SESSION['userName'] = $username;
      //   // header('Location: login.php');
      // }
    }
  }
 ?>

<?php include './templates/header.php' ?>
<link rel="stylesheet" href="public/style/login.css">
<link rel="stylesheet" href="public/style/login_mediaquery.css">
<?php include './templates/nav.php' ?>

<div class="wrapper">
  <?php if (loggedin()) { ?>
    <section class="login-success">
      <h1 class="hero-header">Login Successfully</h1>
      <p class="hero-text">Redirecting back to homepage...</p>
      <?php header("refresh:1;url=index.php"); ?>
    </section>
    <?php  } else { ?>
      <div class="container">
      <section class="side-image">
        <div class="side-image-box">
          <h1>Welcome to VACAYELP</h1>
        </div>
      </section>
      <section class="login-section">
        <form class="login" action="login.php" method="post" >
          <div class="login-header">
            <h2>Log In to VACAYELP</h2>
          </div>
          <div class="login-container">
            <label for="username" class="login-label">
              <input type="text" name="username" id="username" class="login-input" onblur="inputHandle(this)">
              <span class="login-title">Username:</span>
              <span style="font-size: 0.8rem; color: red; padding-top: 0.5em"><?php echo $errors["username"] ?></span>
            </label>
            <label for="password" class="login-label">
              <input type="password" name="password" id="password" class="login-input" onblur="inputHandle(this)">
              <span class="login-title">Password:</span>
              <span style="font-size: 0.8rem; color: red; padding-top: 0.5em"><?php echo $errors["password"] ?></span>
            </label>
            <a href="#" class="pwd-link">Forget your password?</a>
            <button type="submit" name="login" class="btn btn-primary">Log In</button>
          </div>
          <div class="login-new-user">
            <hr>
            <h4>Don't have an account yet?</h4>
            <a href="signup.php" class="btn btn-secondary">Create your account</a>
          </div>
        </form>
      </section>
    <?php  } ?>
  </div>
</div>
<script type="text/javascript">
function inputHandle(event) {
  if (event.value !== "") {
    event.nextElementSibling.classList = 'moveUp';
  } else {
    event.nextElementSibling.classList = 'login-title';
  }
}
window.onload = function() {
  console.log('loaded');
}
</script>

<?php include './templates/footer.php' ?>
