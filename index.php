<?php

?>

<html>
<head>
<title>Freecycle Stoop</title>
<script>
function successHandler(location) {
    var message = document.getElementById("message"), html = [];
    html.push("<img width='256' height='256' src='http://maps.google.com/maps/api/staticmap?center=", location.coords.latitude, ",", location.coords.longitude, "&markers=size:small|color:blue|", location.coords.latitude, ",", location.coords.longitude, "&zoom=14&size=256x256&sensor=false' />");
    html.push("<p>Longitude: ", location.coords.longitude, "</p>");
    html.push("<p>Latitude: ", location.coords.latitude, "</p>");
    html.push("<p>Accuracy: ", location.coords.accuracy, " meters</p>");
    message.innerHTML = html.join("");
}
function errorHandler(error) {
    alert('Attempt to get location failed: ' + error.message);
}
navigator.geolocation.getCurrentPosition(successHandler, errorHandler);
</script>
</head>
<body>
<h1>Freecycle Stoop</h1>

<div id="message">Location unknown</div>
<form>
	<input type="file" accept="image/*" capture="camera">
</form>


</body>
</html>