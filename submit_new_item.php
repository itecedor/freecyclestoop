<?php

  $lat = 40.753227700000004;
  $long = -73.98980209999999;
  $image = $_POST['photo'];
  $imagename = $_FILES['photo']['name'];
  $imagetype = $_FILES['photo']['type'];
  $imageerror = $_FILES['photo']['error'];
  $imagetemp = $_FILES['photo']['tmp_name'];
  $imagePath = "images/";

      if(is_uploaded_file($imagetemp)) {
          if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
              echo "Sussecfully uploaded your image.";
          }
          else {
              echo "Failed to move your image.";
          }
      }
      else {
          echo "Failed to upload your image.";
      }

  $link = mysql_connect('localhost', 'freecyclestoop', 'OH@I!PickUpFreeShitHere!');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db('freecyclestoop');
  $query = "INSERT INTO items (`photo_name`, `lat`, `long`, `available`) VALUES ('$imagename', '$lat', '$long', 1);";

  $result = mysql_query($query) ;

  if (!$result) {
    die('Invalid query: ' . mysql_error());
  }
  mysql_close($link);

  echo "item added!";