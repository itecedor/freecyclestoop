<?php

// grab all categories from the DB
  require("dbconfig.php");

session_start();

  $categories_query = "SELECT * FROM categories;";

  $categories_result = mysql_query($categories_query) ;

  if (!$categories_result) {
    die('Invalid query: ' . mysql_error());
  }
  mysql_close($link);

  while($row = mysql_fetch_row($categories_result)) {
    $category[$row[0]] = $row[1];
  }

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>CurbCycle</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
			<div class="content">
			<h1>CurbCycle</h1>
		<div class="home-screen">
<?php if (!isset($_SESSION['user_id'])) { ?>
		<img src="files/bg-home.png" width="250" height="235" />
    <a href="auth.php" class="btn-facebook">Login or Sign Up</a>
<?php } else { ?>
			<img src="files/bg-add.png" width="262" height="41" />
			<form id="item-entry">
			  <input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
				<input type="hidden" name="latitude" value="" id="latitude-value" /> 
				<input type="hidden" name="longitude" value="" id="longitude-value" />

        Choose image:
        <input type="file" accept="image/*" capture="camera" name="photo">

        Choose category:
        <select id="category">
          <?php foreach($category as $k => $v): ?>
            <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
          <?php endforeach; ?>
        </select>
				<a href="#" class="submit-item">Submit Item</a>
			</form>
			<div class="loading">
				<img src="files/ajax-loader.gif" width="32" height="32" class="loading-icon" />
				<span class="db-response"></span>
			</div>
<?php } ?>
			</div>
				<div class="footer">
					<a href="index.php"><img src="files/icon_01.png" alt="Add an Item" /></a>
					<a href="map.php"><img src="files/icon_02.png" alt="Look Around" /></a>
					<a href=""><img src="files/icon_03.png" alt="Settings" /></a>
				</div>

			</div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
