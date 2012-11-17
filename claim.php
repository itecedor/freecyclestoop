<?php

// query the DB to find available items
$link = mysql_connect('localhost', 'freecyclestoop', 'OH@I!PickUpFreeShitHere!');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('freecyclestoop');
$query = "SELECT * FROM items where available = 1;";

$result = mysql_query($query) ;

if (!$result) {
	die('Invalid query: ' . mysql_error());
}
mysql_close($link);

// logic for claiming an item
// TO DO: Needs to check that the user's current location is close enough to the item's location to allow claiming
if( isset($_POST['claim']) ) {
	$item_id = $_POST['item'];

  $link = mysql_connect('localhost', 'freecyclestoop', 'OH@I!PickUpFreeShitHere!');
  if (!$link) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db('freecyclestoop');
  $query = "UPDATE items SET available = 0 WHERE id = $item_id;";

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
</head>

<body>
<h1>Claim an Item</h1>

Available items:

<?php while($row = mysql_fetch_row($result)): ?> 
	<form method="POST">
		<input type="hidden" name="item" value="<?php echo $row[0]; ?>">
		<p>Number: <?php echo $row[0]; ?> <img src="images/<?php echo $row[3]; ?>" width="250px"> <input type="submit" name="claim" value="claim">
	</form>
<?php endwhile; ?>

</body>
</html>