<?php
require("dbconfig.php");
$item_id = $_POST['id'];

  $query = "UPDATE items SET available = 0 WHERE id = $item_id;";

  $result = mysql_query($query) ;

  if (!$result) {
    die('Invalid query: ' . mysql_error());
  }
  mysql_close($link);
?>