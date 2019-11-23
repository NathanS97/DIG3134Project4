<?php
  function start() {
    return session_start();
  }

  function clearSession() {
    session_unset();
    session_destroy();
  }

  function loggedin() {
    return isset($_SESSION["loggedin"]);
  }

  function logout() {
    if (isset($_GET["signout"])) {
      if ($_GET['signout'] === 'true') {
        clearSession();
      }
    }
  }
?>
