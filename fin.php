<?php
  session_start();


 ?>

<?php include './templates/header.php'; ?>
    <link rel="stylesheet" href="public/style/fin.css">
<?php include './templates/nav.php' ?>
  <div class="container">
    <div class="main_session">
      <h1 class="main">Done</h1>
      <p>Thank you for submitting your survey, <?php echo $_COOKIE['userName']; ?></p>
      <p>Send this survey to learn more about people’s travel intentions. Learn where their favorite vacation destinations are, how often they use a travel agent when planning a trip, and how likely they are to go on a vacation in the next 12 months. See if there are opportunities for you to offer travel specials or create a vacation itinerary that matches their needs.</p>
    </div>
  </div>
<?php include './templates/footer.php' ?>
