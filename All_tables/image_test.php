<?php
include 'images_class.php';

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

  $filename = $_FILES["image"]["name"];
  $tempname = $_FILES["image"]["tmp_name"];
  $folder = "images/".basename($filename);

  Images::set_employee_ID(1);
  Images::insert_image($filename);
  Images::update_images($filename ,'987987');

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
      $msg = "Image uploaded successfully";

    }else{
      $msg = "Failed to upload image";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<style type="text/css">
   #content{
    width: 50%;
    margin: 20px auto;
    border: 1px solid #cbcbcb;
   }
   form{
    width: 50%;
    margin: 20px auto;
   }
   form div{
    margin-top: 5px;
   }
   #img_div{
    width: 80%;
    padding: 5px;
    margin: 15px auto;
    border: 1px solid #cbcbcb;
   }
   #img_div:after{
    content: "";
    display: block;
    clear: both;
   }
   img{
    float: left;
    margin: 5px;
    width: 300px;
    height: 140px;
   }
</style>
</head>
<body>
<div id="content">
  <?php
  $db = mysqli_connect("localhost", "root", "MyNewPass2020", "newpro");
  $result = mysqli_query($db, "SELECT * FROM images");
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
        echo "<img src='images/".$row['image']."' >";
      echo "</div>";
    }
  ?>
  <form method="POST" action="image_test.php" enctype="multipart/form-data">
    <input type="hidden" name="size" value="1000000">
    <div>
      <input type="file" name="image">
    </div>
    <div>
      <textarea
        id="text"
        cols="40"
        rows="4"
        name="image_text"
        placeholder="Say something about this image..."></textarea>
    </div>
    <div>
      <button type="submit" name="upload">POST</button>
    </div>
  </form>
</div>
</body>
</html>
