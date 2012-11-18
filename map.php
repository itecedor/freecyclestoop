<?php
header('Access-Control-Allow-Origin: *');

require('dbconfig.php');
$query = 'SELECT `id`, `lat`, `long` FROM items WHERE available = 1;';
$result = mysql_query($query) ;

if (!$result) {
	die('Invalid query: ' . mysql_error());
}
mysql_close($link);
$items = array();
while ($row = mysql_fetch_row($result)) {
  $items[] = array('lng' => $row[2], 'lat' => $row[1], 'id' => $row[0]);
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
        <title>CurbCyle</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="stylesheet" href="css/main.css">
    </head>
	<body onload="init()">
	<div class="content">
	<h1>CurbCycle</h1>
	<div id="map"></div>
	<div id="item-details"></div>
			<div class="footer">
				<a href="index.php"><img src="files/icon_01.png" alt="Add an Item" /></a>
				<a href="claim.php"><img src="files/icon_02.png" alt="Look Around" /></a>
				<a href=""><img src="files/icon_03.png" alt="Settings" /></a>
			</div>

		</div>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
      <script src="js/plugins.js"></script>
      <script src="js/main.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDodcEzMmV3xGrDcbtiZUI3tZnvupyHSyI&sensor=true"></script>
	<script type="text/javascript">
	var map;
	var markers = {};
	function init() {
	  navigator.geolocation.getCurrentPosition(function(location) {
	    var opts = {
	      center: new google.maps.LatLng(location.coords.latitude, location.coords.longitude),
	      zoom: 18,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	    map = new google.maps.Map(document.getElementById('map'), opts);
	
	<?php foreach ($items as $item): ?>
	    addMarker(<?= $item['id'] ?>, <?= $item['lng'] ?>, <?= $item['lat'] ?>);
	<?php endforeach ?>
	
	  },
	  function(error) {
	    console.log('Error displaying map');
	  });
	}
	
	function addMarker(id, lng, lat) {
	    var position = new google.maps.LatLng(lat, lng);
	    var marker = new google.maps.Marker({position: position, title: "Curb Stuff"});
	    //marker.setIcon();
	    google.maps.event.addListener(marker, 'click', function() {
	        map.panTo(marker.getPosition());
	        events._grab_item(id);
	    });
	    markers[id] = marker; 
	    marker.setMap(map);
	  }
	  
	  function delMarker(id) {
	  	marker = markers[id]; 
    	marker.setMap(null);
	  }
	</script>
</body>
</html>
