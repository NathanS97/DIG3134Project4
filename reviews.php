<?php
  include './common/start.php';
  start();
  logout();

 ?>
<?php include './templates/header.php'; ?>
    <link rel="stylesheet" href="public/style/main.css">
    <link rel="stylesheet" href="public/style/mediaquery.css">
<?php include './templates/nav.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reviews</title>
</head>
<body>
  <!--Basic markup for the reviews page, needs styling from Hongda - NS-->
  <div>
    <h1>Brooke Eden</h1>
    <time datetime="05-25-2019">May 25, 2019</time>
    <p>
      This past week, I traveled to Santorini, Greece. It exceeded far past my 
      expectations and I want to go back again. The views were breath-taking and
      the food was out of this world. I really recommend for anyone to go to 
      Greece.
    </p>
    <img src="/public/img/greece.jpg" alt="Santorini">
  </div>
  <div>
    <h1>Julia Murphy</h1>
    <time datetime="09-1-2019">September 1, 2019</time>
    <p>
      I finally made it to New Zealand to see the Hobbit Holes from Lord of the 
      Rings. This trip has been on my bucket list since I first saw the movies.
      I officially want to move there and live in them forever.
    </p>
    <img src="/public/img/newZealand.png" alt="Hobbit Hole">
  </div>
  <div>
    <h1>Nathan Snodgrass</h1>
    <time datetime="01-30-2015">January 30, 2015</time>
    <p>
      If you haven't been to Japan, well pack your bags because you need to go.
      The food was the best I've ever had and just being submerged in the 
      culture was an experience I'll never forget.
    </p>
    <img src="/public/img/japan.jpg" alt="Japanese Temple">
  </div>
  <div>
    <h1>Hongda Zheng</h1>
    <time datetime="04-4-2018">April 4, 2018</time>
    <p>
      It's official, I'm moving to Germany. The architecture is something I've 
      never seen before. I explored the Neuschwanstein Castle - and yes the one 
      that was used to build the Disney Castle. This trip was by far my favorite 
      trip yet.
    </p>
    <img src="public/img/germany.jpg" alt="German Castle">
  </div>
</body>
</html>
<?php include './templates/footer.php' ?>