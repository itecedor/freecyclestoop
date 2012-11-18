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
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100%; }
  body { height: 100%; margin: 0; padding: 0; }
  #map {
    width: 100%;
    height: 100%;
  }
</style>
</head>
<body onload="init()">
<div id="map"></div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDodcEzMmV3xGrDcbtiZUI3tZnvupyHSyI&sensor=true"></script>
<script type="text/javascript">
var map;
function init() {
  navigator.geolocation.getCurrentPosition(function(location) {
    var opts = {
      center: new google.maps.LatLng(location.coords.latitude, location.coords.longitude),
      zoom: 18,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    console.log(opts);
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
        console.log('Item ' + id + ' clicked');
        map.panTo(marker.getPosition());
    });
    marker.setMap(map);
  }
</script>
</body>
</html>
