<?php

// grab all categories from the DB
  require("dbconfig.php");

  $categories_query = "SELECT * FROM categories;";

  $categories_result = mysql_query($categories_query) ;

  if (!$categories_result) {
    die('Invalid query: ' . mysql_error());
  }
  mysql_close($link);

  while($row = mysql_fetch_row($categories_result)) {
    $category[$row[0]] = $row[1];
  }

// pull up logged in user data

//$profile = $client->fetch('https://api.singly.com/profiles');

//print_r($profile);

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Freecycle Stoop</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
			<div class="content">
			<h1>Freecycle Stoop</h1>

    <a href="auth.php">Login or Sign Up</a>

			<div id="message"></div>
			<form id="item-entry">
			  <input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
				<input type="hidden" name="latitude" value="" id="latitude-value" /> 
				<input type="hidden" name="longitude" value="" id="longitude-value" />

        <p>Choose image:
        <input type="file" accept="image/*" capture="camera" name="photo">

        <p>Choose category:
        <select id="category">
          <?php foreach($category as $k => $v): ?>
            <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
          <?php endforeach; ?>
        </select>
				<p><a href="#" class="submit-item">Submit Item</a>
				<span class="db-response"></span>
			</form>

			</div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
