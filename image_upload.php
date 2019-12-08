<?php
  function reArrayFiles(&$file_post) {

      $file_ary = array();
      $file_count = count($file_post['name']);
      $file_keys = array_keys($file_post);

      for ($i=0; $i<$file_count; $i++) {
          foreach ($file_keys as $key) {
              $file_ary[$i][$key] = $file_post[$key][$i];
          }
      }

      return $file_ary;
  }


  // echo $_SESSION['uid'] . '</br>';
  // echo $_SESSION['loggedin'] . '</br>';
  // echo $_SESSION['username'] . '</br>';


  function uploadImage() {
    $genre = $_POST['genre'];
    $phpFileUploadErrors = "";
    // $uid = $_SESSION['uid'];
    // print_r($_FILES);
    $file_array =  reArrayFiles($_FILES['file']);
    // print_r($file_array);
    for ($i=0; $i <count($file_array) ; $i++) {
      $fileName = $file_array[$i]['name'];
      $fileType = $file_array[$i]['type'];
      $fileSize = $file_array[$i]['size'];
      $fileTmpName = $file_array[$i]['tmp_name'];
      $fileError = $file_array[$i]['error'];

      $fileExt = explode('.', $fileName);
      $fileExtLower = strtolower(end($fileExt));
      $allowed = array('jpg', 'jpeg', 'png', 'pdf');

      if (in_array($fileExtLower, $allowed)) {
        if ($fileError === 0) {
          if ($fileSize <= 5000000) {
            $fileNameNew = uniqid('', true).'.'.$fileExtLower;
            $fileDestination = 'uploads/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            $conn = connectDB();
            $sql = "INSERT INTO photos (image, genre, uid) VALUES (?, ?, ?)";


            if ($stmt = mysqli_prepare($conn, $sql)) {
              mysqli_stmt_bind_param($stmt, 'ssi', $param_image, $param_genre, $param_uid);
              $param_image = $fileDestination;
              $param_genre = $genre;
              $param_uid = $_SESSION['uid'];
              if (mysqli_stmt_execute($stmt)) {
                return array(true, "There is no error, the file uploaded with sucess");
              } else {
                return array(false, "Something went wrong. Please try again later.");
              }
              mysqli_stmt_close($stmt);
            }
            mysqli_close($conn);
          } else {
            return array(false, "The size of your file should be less than 5MB.");
          }
        } else {
          return array(false, "There is an error uploading your image.");
        }
      } else {
        return array(false, "You cannot upload files of this type.");
      }
    }

  }

 ?>


    <!-- <div class="upload-background" id="upload-modal">
      <div class="upload-container">
        <div class="card upload-box p-2">
          <h3>Publish your first photos</h3>
          <span class="close" onclick="document.getElementById('login-modal').style.display='none'"><i class="fa fa-times" aria-hidden="true"></i></span>
          <div class="upload-body">
            <form class="//change this to the page that you want to send the image" action="image_upload.php" method="post" enctype="multipart/form-data">
              <div id="drop-area">
                <input type="file" name="file[]" multiple="multiple">
              </div>
              <div class="upload-bottom">
                <label for="exampleFormControlSelect1" class="genre-label">Example select</label>
                  <select class="genre-select" id="exampleFormControlSelect1" name="genre">
                    <option value="null">Choose a genre</option>
                    <?php
                      // $genres = array('Wallpapers' , 'Nature', 'Current Events', 'Architecture', 'Film', 'Animals', 'Travel', 'Fashion', 'Food & Drinke', 'Wallpapers', 'Experimental', 'People', 'Health', 'Arts & Culture', 'Spirituality');;
                      // for ($i=0; $i < count($genres); $i++) {
                      //   echo "<option>".$genres[$i]."</option>";
                      // }
                     ?>
                  </select>
                  <button type="submit" name="upload">Upload</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div> -->
    <!-- <script type="text/javascript">
      $(document).ready(function() {
        $("#drop-area").on('dragenter', function (e){
          e.preventDefault();
          $(this).css('background', '#BBD5B8');
         });
         $("#drop-area").on('dragover', function (e){
          e.preventDefault();
         });
         $("#drop-area").on('drop', function (e){
           $(this).css('background', '#D8F9D3');
           e.preventDefault();
           // var image = e.originalEvent.dataTransfer.files;
           // createFormData(image);
          });

      })
    </script> -->
