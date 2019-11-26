
<?php
  include './common/start.php';
  start();
  logout();
  delAcc();

 ?>

<?php include './templates/header.php'; ?>
    <link rel="stylesheet" href="public/style/main.css">
    <link rel="stylesheet" href="public/style/mediaquery.css">
<?php include './templates/nav.php' ?>
    <div class="wrapper">
      <section class="hero">
        <div class="hero_container">
          <div class="clipper">
            <h1 class="hero_text">Find A Place <br> You Love</h1>
          </div>
          <p class="hero_content">If you’re a travel planner or researcher, get the competitive edge by learning about people’s vacation preferences.</p>
          <a href="survey.php" class="btn primary"><i class="fas fa-arrow-alt-circle-right"></i>Take a Survey</a>
        </div>
      </section>
      <section class="sidebar">
          <div class="inner_top">
            <div class="clipper">
              <h2>Feature</h2>
            </div>
            <div class="anim-pannel">
              <p>Our expert-certified vacation travel template lets you get to know your target audience better and see what factors go into planning a trip. Find out about people’s travel habits, so you can customize your services accordingly.</p>
            </div>
          </div>
          <div class="inner_bottom">
            <div class="clipper">
              <h2>Sign Up</h2>
            </div>
            <div class="anim-pannel">
              <p>Get the latest updates about this website and stuff.</p>
              <a href="signup.php" class="btn sign_up_btn"><i class="fas fa-arrow-alt-circle-right"></i>Sign Up</a>
            </div>
          </div>
      </section>
    </div>
<?php include './templates/footer.php' ?>
