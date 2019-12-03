</head>
<body>
  <header>
    <a href="index.php" class="logo">VacaYelp</a>
    <nav>
      <ul>
        <li><a href="reviews.php" class="link">View all Reviews</a> </li>
        <li><a href="#" class="link">More</a></li>
      </ul>
    </nav>
    <?php  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === 'success') { ?>
      <div class="user">
          <a href="#" class="user-profile"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['userName'] ?></a>
          <div class="dropdown-content">
            <a href="index.php?signout=true">Sign out</a>
            <a href="index.php?deleteAcc=true">Delete Account</a>
          </div>
      </div>
    <?php } else { ?>
      <a href="login.php" class="login_btn">Login</a>
    <?php }?>

  </header>
