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

    <a href="auth.php">Login or Sign Up</a>

			<div id="message"></div>
			<form id="item-entry">
			  <input type="hidden" name="MAX_FILE_SIZE" value="3000000000" />
				<input type="hidden" name="latitude" value="" id="latitude-value" /> 
				<input type="hidden" name="longitude" value="" id="longitude-value" /> 
        <input type="file" accept="image/*" capture="camera" name="photo">
				<a href="#" class="submit-item">Submit Item</a>
				<span class="db-response"></span>
			</form>

			</div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
