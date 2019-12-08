<?php
  function usernameValidate($usrn) {
    $error = $username = "";
    if (empty(trim($usrn))) {
      $error = "Please enter your username";
    } else {
      $username = trim($usrn);
      // echo $username;
      if (!preg_match("/^(?=.{3,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $username)) {
          $error = "Your username is not validated";
      }
    }
    return array($username, $error);
  }
  function pwdValidate($pwd) {
    $error = $password = $encrypted_pass = "";
    if (empty($pwd)) {
      $error = "Please enter your password";
    } else {
      $password = $pwd;
      $encrypted_pass =  password_hash($password, PASSWORD_DEFAULT);
      // echo $encrypted_pass;
    }
    return array($password, $error);
  }

  function signupPassswordValidation($pwd) {
    $error = $password = "";
    if (empty(trim($pwd))) {
      $error = "Please eneter password";
    } else {
      if (strlen(trim($pwd)) < 8) {
        $error = "Your Password Must Contain At Least 8 Cahracters!";
      } elseif (!preg_match("#[0-9]+#", trim($pwd))) {
        $error = "Your Password Must Contain At Least 1 Number!";
      } elseif (!preg_match("#[a-z]+#", trim($pwd))) {
        $error = "Your Password Must Contain At Least 1 Lowercase Letter!";
      }
      $password = trim($pwd);
      return array($password, $error);
    }
  }

  function emailValidate($em) {
    $email = $error = "";
    if (empty(trim($em))) {
      $error = "An email is required";
    } else {
      $email = trim($em);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = "$email is not a valid email address";
      }
    }
    return array($email, $error);
  }

  function validation() {
    $usrn = strip_tags($_POST['username']);
    $pwd = strip_tags($_POST['password']);

    // print_r($_POST);
    // echo "from validate";
    // echo $usrn . " " . $pwd;

    $username = usernameValidate($usrn);
    // print_r($username);
    $encrypted_pass = pwdValidate($pwd);
    // print_r($encrypted_pass);

    return array($username, $encrypted_pass);
  }

  function signupValidation() {
    $usrn = strip_tags($_POST['username']);
    $pwd = strip_tags($_POST['password']);
    $em = strip_tags($_POST['email']);

    // print_r($_POST);
    // echo "from validate";
    // echo $usrn . " " . $pwd;

    $username = usernameValidate($usrn);
    // print_r($username);
    $encrypted_pass = pwdValidate($pwd);
    // print_r($encrypted_pass);
    $email = emailValidate($em);
    // print_r($email);

    return array($username, $email, $encrypted_pass);
  }
 ?>
