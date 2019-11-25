<?php
  /**
   *
   */
  class Reviewcard
  {
    private $title;
    private $image;
    private $added_at;
    private $reviewId;
    private $userId;
    function __construct($title = null, $image = null, $added_at = null, $reviewId = null, $userId = null)
    {
      if ($title && $image && $added_at && $reviewId && $userId) {
        $this->title = $title;
        $this->image = $image;
        $this->added_at = $added_at;
        $this->reviewId = $reviewId;
        $this->userId = $userId;
      }
    }
    public function getTitle() {
      return "<h5 class='card-title'>" . $this->title . "</h5>";
    }

    public function getImage() {
      return "<img class='card-img-top' src='" . $this->image . "' alt='Card image cap' />";
    }

    public function getReview() {
      return "<a href='review.php?reviewId=". $this->reviewId ."' class='btn btn-primary'>More info</a>";
    }

    public function renderCard() {
        return '<div class="card" style="width: 18rem;">'.
          $this->getImage()
          .'<div class="card-body">'.
            $this->getTitle()
            .'<div>'.
              $this->getReview()
            .'</div>
          </div>
        </div>';
    }
  }
 ?>


<?php $reviewOne = new Reviewcard('London', 'https://cdn.londonandpartners.com/visit/general-london/areas/river/76709-640x360-houses-of-parliament-and-london-eye-on-thames-from-above-640.jpg', '2019-10-31', '1', '1' )?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>review card</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
     <?php echo $reviewOne->renderCard(); ?>
   </body>
 </html>
