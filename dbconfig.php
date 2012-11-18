<?php
// IVETE'S SERVER
	$link = mysql_connect('localhost', 'knitspir_curbcyc', 'OH@I!PickUpFreeShitHere!');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db('knitspir_curbcycle');

/* CAROLINE'S SERVER


	$link = mysql_connect('angelhack.keimdesign.com', 'freecyclestoop', 'OH@I!PickUpFreeShitHere!');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db('stoopme');
*/
