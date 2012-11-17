<?php

/* 	when you want to talk to the DB:
 *
 * 	require_once('db.php');
 * 	$link = mysql_connect('localhost', 'freecyclestoop', 'OH@I!PickUpFreeShitHere!');
   	if (!$link) {
   		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully';
 *
 *  $result = mysql_query('SELECT * WHERE 1=1');
 *	if (!$result) {
 *  	die('Invalid query: ' . mysql_error());
 *	}
 *	mysql_close($link);
 */

if(isset($_POST['submit'])) {

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
  $query = "INSERT INTO items (`photo_name`, `lat`, `long`) VALUES ('$imagename', '$lat', '$long');";

  $result = mysql_query($query) ;

  if (!$result) {
    die('Invalid query: ' . mysql_error());
  }
  mysql_close($link);

}

?>

<html>
<head>
<title>Freecycle Stoop</title>
<script>
function successHandler(location) {
    var message = document.getElementById("message"), html = [];
    html.push("<img width='256' height='256' src='http://maps.google.com/maps/api/staticmap?center=", location.coords.latitude, ",", location.coords.longitude, "&markers=size:small|color:blue|", location.coords.latitude, ",", location.coords.longitude, "&zoom=14&size=256x256&sensor=false' />");
    html.push("<p>Longitude: ", location.coords.longitude, "</p>");
    html.push("<p>Latitude: ", location.coords.latitude, "</p>");
    html.push("<p>Accuracy: ", location.coords.accuracy, " meters</p>");
    message.innerHTML = html.join("");
}
function errorHandler(error) {
    alert('Attempt to get location failed: ' + error.message);
}
navigator.geolocation.getCurrentPosition(successHandler, errorHandler);
</script>
</head>
<body>
<h1>Freecycle Stoop</h1>

<div id="message">Location unknown</div>
<form enctype="multipart/form-data" action="index.php" method="POST">
  <input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
  <input type="hidden" name="lat" value="$lat">
  <input type="hidden" name="long" value="$long">
	<input type="file" accept="image/*" capture="camera" name="photo">
  <input type="submit" name="submit">
</form>


</body>
</html>