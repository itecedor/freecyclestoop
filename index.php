<?php

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
			
			
        You are here:
        <div id="message">Location unknown</div>

        Add an item:
        <form enctype="multipart/form-data" action="submit_new_item.php" method="POST">
          <input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
          <input type="hidden" name="lat" value="$lat">
          <input type="hidden" name="long" value="$long">
          <input type="file" accept="image/*" capture="camera" name="photo">
          <input type="submit" name="submit">
        </form>
			</div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>