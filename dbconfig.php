<?php
	$link = mysql_connect('angelhack.keimdesign.com', 'freecyclestoop', 'OH@I!PickUpFreeShitHere!');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db('stoopme');
?>