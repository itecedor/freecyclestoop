<?php
require("dbconfig.php");
$item_id = $_POST['id'];

$query = "SELECT * FROM items where id = $item_id;";

$result = mysql_query($query) ;

if (!$result) {
	die('Invalid query: ' . mysql_error());
}
mysql_close($link);

// logic for claiming an item
// TO DO: Needs to check that the user's current location is close enough to the item's location to allow claiming
if( isset($_POST['claim']) ) {

  require("dbconfig.php");

  $query = "UPDATE items SET available = 0 WHERE id = $item_id;";

  $result = mysql_query($query) ;

  if (!$result) {
    die('Invalid query: ' . mysql_error());
  }
  mysql_close($link);
 }

?>

<?php while($row = mysql_fetch_row($result)): ?> 
	<form method="POST">
		<input type="hidden" name="item" value="<?php echo $row[0]; ?>">
		<img src="http://www.mtv.com/shared/droplets/media/normalize_jpeg.jhtml?width=175&height=175&matte=true&matteColor=0xcccccc&image=<?= urlencode('http://www.keimdesign.com/stoop/images/' . $row[4]); ?>" width="175" height="175"><br /><a class="back-to-map" href="#">&#11013;</a><input type="image" name="claim" src="files/btn-claim.png">
	</form>
	<img class="mini-map" width='320' height='105' src='http://maps.google.com/maps/api/staticmap?center=<?php echo $row[2]; ?>,<?php echo $row[3]; ?>&markers=<?php echo $row[2]; ?>,<?php echo $row[3]; ?>&zoom=14&size=320x105&sensor=false' />
<?php endwhile; ?>